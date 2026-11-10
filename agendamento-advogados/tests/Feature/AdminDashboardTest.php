<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Agendamento;
use App\Models\Servico;
use Carbon\Carbon;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_visitantes_nao_podem_acessar_dashboard()
    {
        $response = $this->get(route('dashboard'));
        $response->assertRedirect('/login');
    }

    public function test_dashboard_lista_apenas_agendamentos_futuros_por_padrao()
    {
        $user = User::factory()->create();
        $servico = Servico::create(['titulo' => 'Consulta', 'ativa' => true]);

        // Agendamento no passado
        Agendamento::create([
            'nome' => 'Passado', 'email' => 'a@a.com', 'telefone' => '1', 'servico_id' => $servico->id,
            'data' => Carbon::yesterday()->format('Y-m-d'), 'horario' => '10:00', 'status' => 'pendente'
        ]);

        // Agendamento futuro
        Agendamento::create([
            'nome' => 'Futuro', 'email' => 'b@b.com', 'telefone' => '2', 'servico_id' => $servico->id,
            'data' => Carbon::tomorrow()->format('Y-m-d'), 'horario' => '10:00', 'status' => 'pendente'
        ]);

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertSee('Futuro');
        $response->assertDontSee('Passado');
    }

    public function test_busca_no_dashboard_retorna_agendamentos_passados()
    {
        $user = User::factory()->create();
        $servico = Servico::create(['titulo' => 'Consulta', 'ativa' => true]);

        Agendamento::create([
            'nome' => 'Passado Buscado', 'email' => 'a@a.com', 'telefone' => '1', 'servico_id' => $servico->id,
            'data' => Carbon::yesterday()->format('Y-m-d'), 'horario' => '10:00', 'status' => 'pendente'
        ]);

        $response = $this->actingAs($user)->get(route('dashboard', ['busca' => 'Passado Buscado']));

        $response->assertSee('Passado Buscado');
    }

    public function test_dashboard_exibe_mensagem_do_cliente_quando_preenchida()
    {
        $user = User::factory()->create();
        $servico = Servico::create(['titulo' => 'Direito Civil', 'ativa' => true]);

        Agendamento::create([
            'nome' => 'Cliente Com Mensagem',
            'email' => 'msg@teste.com',
            'telefone' => '38998414101',
            'servico_id' => $servico->id,
            'data' => Carbon::tomorrow()->format('Y-m-d'),
            'horario' => '09:00',
            'mensagem' => 'Relato detalhado do caso jurídico para análise.',
            'status' => 'pendente'
        ]);

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertStatus(200);
        $response->assertSee('<th class="py-3 px-6 text-left">Mensagem</th>', false);
        $response->assertSee('Cliente Com Mensagem');
        $response->assertSee('Relato detalhado do caso jurídico para análise.');
    }

    public function test_dashboard_exibe_indicador_sem_mensagem_quando_vazia()
    {
        $user = User::factory()->create();
        $servico = Servico::create(['titulo' => 'Direito Trabalhista', 'ativa' => true]);

        Agendamento::create([
            'nome' => 'Cliente Sem Mensagem',
            'email' => 'semmsg@teste.com',
            'telefone' => '38998414101',
            'servico_id' => $servico->id,
            'data' => Carbon::tomorrow()->format('Y-m-d'),
            'horario' => '11:00',
            'mensagem' => null,
            'status' => 'pendente'
        ]);

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Cliente Sem Mensagem');
        $response->assertSee('Sem mensagem');
    }

    public function test_busca_no_dashboard_encontra_agendamento_pelo_conteudo_da_mensagem()
    {
        $user = User::factory()->create();
        $servico = Servico::create(['titulo' => 'Direito Previdenciário', 'ativa' => true]);

        Agendamento::create([
            'nome' => 'Carlos Silveira',
            'email' => 'carlos@teste.com',
            'telefone' => '38999990000',
            'servico_id' => $servico->id,
            'data' => Carbon::yesterday()->format('Y-m-d'),
            'horario' => '15:00',
            'mensagem' => 'Aposentadoria especial com tempo rural pendente no INSS.',
            'status' => 'pendente'
        ]);

        $response = $this->actingAs($user)->get(route('dashboard', ['busca' => 'Aposentadoria especial']));

        $response->assertStatus(200);
        $response->assertSee('Carlos Silveira');
        $response->assertSee('Aposentadoria especial com tempo rural pendente no INSS.');
    }

    public function test_fluxo_completo_agendamento_cliente_aparece_com_mensagem_no_dashboard_do_advogado()
    {
        $user = User::factory()->create();
        $servico = Servico::create(['titulo' => 'Direito Administrativo', 'ativa' => true]);
        \App\Models\Expediente::create(['dia_semana' => 1, 'inicio' => '08:00', 'fim' => '18:00']);

        $proximaSegunda = Carbon::now()->next(Carbon::MONDAY)->format('Y-m-d');

        $this->post(route('agendar'), [
            'nome' => 'Fernanda Oliveira',
            'email' => 'fernanda@exemplo.com',
            'telefone' => '(38) 99841-4101',
            'servico_id' => $servico->id,
            'data' => $proximaSegunda,
            'horario' => '10:00',
            'mensagem' => 'Preciso de defesa técnica em Processo Administrativo Disciplinar (PAD).'
        ])->assertSessionHas('sucesso');

        $dashboardResponse = $this->actingAs($user)->get(route('dashboard'));
        $dashboardResponse->assertStatus(200);
        $dashboardResponse->assertSee('Fernanda Oliveira');
        $dashboardResponse->assertSee('Preciso de defesa técnica em Processo Administrativo Disciplinar (PAD).');
    }

    public function test_busca_no_dashboard_funciona_com_termo_zero_e_mensagens_longas()
    {
        $user = User::factory()->create();
        $servico = Servico::create(['titulo' => 'Direito Civil', 'ativa' => true]);

        $mensagemLonga = str_repeat('X', 1000);

        Agendamento::create([
            'nome' => 'Processo 0',
            'email' => 'proc@teste.com',
            'telefone' => '38998414101',
            'servico_id' => $servico->id,
            'data' => Carbon::yesterday()->format('Y-m-d'),
            'horario' => '09:00',
            'mensagem' => 'Autos nº 0 em andamento.',
            'status' => 'pendente'
        ]);

        Agendamento::create([
            'nome' => 'Outro Futuro',
            'email' => 'outro@teste.com',
            'telefone' => '38998414101',
            'servico_id' => $servico->id,
            'data' => Carbon::tomorrow()->format('Y-m-d'),
            'horario' => '10:00',
            'mensagem' => $mensagemLonga,
            'status' => 'pendente'
        ]);

        // Busca pelo termo '0' deve encontrar o registro passado com '0' e não listar registros sem '0'
        $searchZeroResponse = $this->actingAs($user)->get(route('dashboard', ['busca' => '0']));
        $searchZeroResponse->assertStatus(200);
        $searchZeroResponse->assertSee('Processo 0');
        $searchZeroResponse->assertSee('Autos nº 0 em andamento.');
        $searchZeroResponse->assertDontSee('Outro Futuro');

        // Dashboard padrão exibe mensagem longa de 1000 caracteres com classes de quebra de linha
        $defaultResponse = $this->actingAs($user)->get(route('dashboard'));
        $defaultResponse->assertStatus(200);
        $defaultResponse->assertSee($mensagemLonga);
        $defaultResponse->assertSee('whitespace-pre-line break-words', false);
    }
}