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

    public function test_admin_visualiza_todos_os_agendamentos_de_todas_as_sedes_e_advogados()
    {
        $admin = User::factory()->admin()->create(['name' => 'Admin Teste']);
        $delssi = User::factory()->advogado('capitao_eneas')->create(['name' => 'Dr. Delssi']);
        $rosevania = User::factory()->advogado('montes_claros')->create(['name' => 'Dra. Rosevania']);
        $servico = Servico::create(['titulo' => 'Direito Civil', 'ativa' => true]);

        Agendamento::create([
            'nome' => 'Cliente Capitão Enéas',
            'email' => 'capitao@teste.com',
            'telefone' => '38999991111',
            'servico_id' => $servico->id,
            'sede' => 'capitao_eneas',
            'advogado_id' => $delssi->id,
            'data' => Carbon::tomorrow()->format('Y-m-d'),
            'horario' => '10:00',
            'status' => 'pendente'
        ]);

        Agendamento::create([
            'nome' => 'Cliente Montes Claros',
            'email' => 'montes@teste.com',
            'telefone' => '38999992222',
            'servico_id' => $servico->id,
            'sede' => 'montes_claros',
            'advogado_id' => $rosevania->id,
            'data' => Carbon::tomorrow()->format('Y-m-d'),
            'horario' => '11:00',
            'status' => 'pendente'
        ]);

        $response = $this->actingAs($admin)->get(route('dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Cliente Capitão Enéas');
        $response->assertSee('Cliente Montes Claros');
        $response->assertSee('Dr. Delssi');
        $response->assertSee('Dra. Rosevania');
        $response->assertSee('Capitão Enéas – MG');
        $response->assertSee('Montes Claros – MG');
        $response->assertSee('Visão Geral do Escritório');
    }

    public function test_advogado_visualiza_apenas_seus_proprios_agendamentos()
    {
        $delssi = User::factory()->advogado('capitao_eneas')->create(['name' => 'Dr. Delssi']);
        $rosevania = User::factory()->advogado('montes_claros')->create(['name' => 'Dra. Rosevania']);
        $servico = Servico::create(['titulo' => 'Direito Civil', 'ativa' => true]);

        Agendamento::create([
            'nome' => 'Cliente Exclusivo Delssi',
            'email' => 'delssi_cliente@teste.com',
            'telefone' => '38999991111',
            'servico_id' => $servico->id,
            'sede' => 'capitao_eneas',
            'advogado_id' => $delssi->id,
            'data' => Carbon::tomorrow()->format('Y-m-d'),
            'horario' => '10:00',
            'status' => 'pendente'
        ]);

        Agendamento::create([
            'nome' => 'Cliente Exclusivo Rosevania',
            'email' => 'rosevania_cliente@teste.com',
            'telefone' => '38999992222',
            'servico_id' => $servico->id,
            'sede' => 'montes_claros',
            'advogado_id' => $rosevania->id,
            'data' => Carbon::tomorrow()->format('Y-m-d'),
            'horario' => '11:00',
            'status' => 'pendente'
        ]);

        // Delssi acessa dashboard
        $responseDelssi = $this->actingAs($delssi)->get(route('dashboard'));
        $responseDelssi->assertStatus(200);
        $responseDelssi->assertSee('Cliente Exclusivo Delssi');
        $responseDelssi->assertDontSee('Cliente Exclusivo Rosevania');
        $responseDelssi->assertSee('pauta pessoal de agendamentos');

        // Rosevania acessa dashboard
        $responseRosevania = $this->actingAs($rosevania)->get(route('dashboard'));
        $responseRosevania->assertStatus(200);
        $responseRosevania->assertSee('Cliente Exclusivo Rosevania');
        $responseRosevania->assertDontSee('Cliente Exclusivo Delssi');
        $responseRosevania->assertSee('pauta pessoal de agendamentos');
    }

    public function test_admin_pode_filtrar_por_sede_e_advogado()
    {
        $admin = User::factory()->admin()->create();
        $delssi = User::factory()->advogado('capitao_eneas')->create(['name' => 'Dr. Delssi']);
        $rosevania = User::factory()->advogado('montes_claros')->create(['name' => 'Dra. Rosevania']);
        $servico = Servico::create(['titulo' => 'Direito Civil', 'ativa' => true]);

        Agendamento::create([
            'nome' => 'Agendamento Capitão',
            'email' => 'c1@teste.com',
            'telefone' => '38999991111',
            'servico_id' => $servico->id,
            'sede' => 'capitao_eneas',
            'advogado_id' => $delssi->id,
            'data' => Carbon::tomorrow()->format('Y-m-d'),
            'horario' => '10:00',
            'status' => 'pendente'
        ]);

        Agendamento::create([
            'nome' => 'Agendamento Montes',
            'email' => 'c2@teste.com',
            'telefone' => '38999992222',
            'servico_id' => $servico->id,
            'sede' => 'montes_claros',
            'advogado_id' => $rosevania->id,
            'data' => Carbon::tomorrow()->format('Y-m-d'),
            'horario' => '11:00',
            'status' => 'pendente'
        ]);

        // Filtro por sede Montes Claros
        $resSede = $this->actingAs($admin)->get(route('dashboard', ['sede' => 'montes_claros']));
        $resSede->assertSee('Agendamento Montes');
        $resSede->assertDontSee('Agendamento Capitão');

        // Filtro por advogado Delssi
        $resAdv = $this->actingAs($admin)->get(route('dashboard', ['advogado_id' => $delssi->id]));
        $resAdv->assertSee('Agendamento Capitão');
        $resAdv->assertDontSee('Agendamento Montes');
    }

    public function test_admin_pode_reatribuir_agendamento_para_outro_advogado()
    {
        $admin = User::factory()->admin()->create();
        $delssi = User::factory()->advogado('capitao_eneas')->create(['name' => 'Dr. Delssi']);
        $gerlice = User::factory()->advogado('capitao_eneas')->create(['name' => 'Dra. Gerlice']);
        $servico = Servico::create(['titulo' => 'Direito Civil', 'ativa' => true]);

        $agendamento = Agendamento::create([
            'nome' => 'Cliente Para Reatribuir',
            'email' => 'reatribuir@teste.com',
            'telefone' => '38999991111',
            'servico_id' => $servico->id,
            'sede' => 'capitao_eneas',
            'advogado_id' => $delssi->id,
            'data' => Carbon::tomorrow()->format('Y-m-d'),
            'horario' => '10:00',
            'status' => 'pendente'
        ]);

        $response = $this->actingAs($admin)->patch(route('agendamentos.reatribuir', $agendamento->id), [
            'advogado_id' => $gerlice->id,
        ]);

        $response->assertSessionHas('sucesso');
        $this->assertEquals($gerlice->id, $agendamento->fresh()->advogado_id);
    }

    public function test_advogado_nao_pode_reatribuir_agendamento()
    {
        $delssi = User::factory()->advogado('capitao_eneas')->create();
        $gerlice = User::factory()->advogado('capitao_eneas')->create();
        $servico = Servico::create(['titulo' => 'Direito Civil', 'ativa' => true]);

        $agendamento = Agendamento::create([
            'nome' => 'Cliente Reatribuir Bloqueado',
            'email' => 'bloq@teste.com',
            'telefone' => '38999991111',
            'servico_id' => $servico->id,
            'sede' => 'capitao_eneas',
            'advogado_id' => $delssi->id,
            'data' => Carbon::tomorrow()->format('Y-m-d'),
            'horario' => '10:00',
            'status' => 'pendente'
        ]);

        $response = $this->actingAs($delssi)->patch(route('agendamentos.reatribuir', $agendamento->id), [
            'advogado_id' => $gerlice->id,
        ]);

        $response->assertStatus(403);
        $this->assertEquals($delssi->id, $agendamento->fresh()->advogado_id);
    }

    public function test_advogado_nao_pode_atualizar_status_de_agendamento_de_outro_advogado()
    {
        $delssi = User::factory()->advogado('capitao_eneas')->create();
        $rosevania = User::factory()->advogado('montes_claros')->create();
        $servico = Servico::create(['titulo' => 'Direito Civil', 'ativa' => true]);

        $agendamento = Agendamento::create([
            'nome' => 'Cliente Rosevania',
            'email' => 'rose@teste.com',
            'telefone' => '38999991111',
            'servico_id' => $servico->id,
            'sede' => 'montes_claros',
            'advogado_id' => $rosevania->id,
            'data' => Carbon::tomorrow()->format('Y-m-d'),
            'horario' => '10:00',
            'status' => 'pendente'
        ]);

        // Delssi tenta atualizar o status do agendamento da Rosevania
        $response = $this->actingAs($delssi)->patch(route('agendamentos.status', $agendamento->id), [
            'status' => 'concluido',
        ]);

        $response->assertStatus(403);
        $this->assertEquals('pendente', $agendamento->fresh()->status);
    }

    public function test_admin_nao_pode_reatribuir_agendamento_para_advogado_com_conflito_de_horario()
    {
        $admin = User::factory()->admin()->create();
        $delssi = User::factory()->advogado('capitao_eneas')->create(['name' => 'Dr. Delssi']);
        $gerlice = User::factory()->advogado('capitao_eneas')->create(['name' => 'Dra. Gerlice']);
        $servico = Servico::create(['titulo' => 'Direito Civil', 'ativa' => true]);

        $data = Carbon::tomorrow()->format('Y-m-d');

        // Gerlice já tem agendamento às 10:00
        Agendamento::create([
            'nome' => 'Cliente Gerlice Existente',
            'email' => 'gerlice_cli@teste.com',
            'telefone' => '38999990001',
            'servico_id' => $servico->id,
            'sede' => 'capitao_eneas',
            'advogado_id' => $gerlice->id,
            'data' => $data,
            'horario' => '10:00',
            'status' => 'pendente'
        ]);

        // Agendamento do Delssi também às 10:00
        $agendamentoDelssi = Agendamento::create([
            'nome' => 'Cliente Delssi',
            'email' => 'delssi_cli@teste.com',
            'telefone' => '38999990002',
            'servico_id' => $servico->id,
            'sede' => 'capitao_eneas',
            'advogado_id' => $delssi->id,
            'data' => $data,
            'horario' => '10:00',
            'status' => 'pendente'
        ]);

        // Admin tenta reatribuir o agendamento de Delssi para Gerlice (conflito de horário)
        $response = $this->actingAs($admin)->patch(route('agendamentos.reatribuir', $agendamentoDelssi->id), [
            'advogado_id' => $gerlice->id,
        ]);

        $response->assertSessionHasErrors(['advogado_id']);
        $this->assertEquals($delssi->id, $agendamentoDelssi->fresh()->advogado_id);
    }

    public function test_admin_reatribui_agendamento_e_atualiza_sede_para_sede_padrao_do_novo_advogado()
    {
        $admin = User::factory()->admin()->create();
        $delssi = User::factory()->advogado('capitao_eneas')->create(['name' => 'Dr. Delssi']);
        $rosevania = User::factory()->advogado('montes_claros')->create(['name' => 'Dra. Rosevania']);
        $servico = Servico::create(['titulo' => 'Direito Civil', 'ativa' => true]);

        $agendamento = Agendamento::create([
            'nome' => 'Cliente Transferido',
            'email' => 'transf@teste.com',
            'telefone' => '38999990003',
            'servico_id' => $servico->id,
            'sede' => 'capitao_eneas',
            'advogado_id' => $delssi->id,
            'data' => Carbon::tomorrow()->format('Y-m-d'),
            'horario' => '14:00',
            'status' => 'pendente'
        ]);

        // Reatribui para Rosevania (Montes Claros)
        $response = $this->actingAs($admin)->patch(route('agendamentos.reatribuir', $agendamento->id), [
            'advogado_id' => $rosevania->id,
        ]);

        $response->assertSessionHas('sucesso');
        $fresh = $agendamento->fresh();
        $this->assertEquals($rosevania->id, $fresh->advogado_id);
        $this->assertEquals('montes_claros', $fresh->sede);
    }

    public function test_user_model_role_helpers_e_relacionamento_agendamentos()
    {
        $admin = User::factory()->admin()->create();
        $advogado = User::factory()->advogado('capitao_eneas')->create();

        $this->assertTrue($admin->isAdmin());
        $this->assertFalse($admin->isAdvogado());

        $this->assertFalse($advogado->isAdmin());
        $this->assertTrue($advogado->isAdvogado());

        $servico = Servico::create(['titulo' => 'Civil', 'ativa' => true]);
        $agendamento = Agendamento::create([
            'nome' => 'Cliente Relação',
            'email' => 'rel@teste.com',
            'telefone' => '38999990004',
            'servico_id' => $servico->id,
            'sede' => 'capitao_eneas',
            'advogado_id' => $advogado->id,
            'data' => Carbon::tomorrow()->format('Y-m-d'),
            'horario' => '15:00',
            'status' => 'pendente'
        ]);

        $this->assertTrue($advogado->agendamentos->contains($agendamento));
        $this->assertEquals($advogado->id, $agendamento->advogado->id);
    }

    public function test_agendamento_model_accessors_e_payload_notificacao()
    {
        $rosevania = User::factory()->advogado('montes_claros')->create(['name' => 'Dra. Rosevania']);
        $servico = Servico::create(['titulo' => 'Direito do Servidor', 'ativa' => true]);

        $agendamento = Agendamento::create([
            'nome' => 'Mariana Lima',
            'email' => 'mariana@teste.com',
            'telefone' => '38999995555',
            'servico_id' => $servico->id,
            'sede' => 'montes_claros',
            'advogado_id' => $rosevania->id,
            'data' => '2026-12-01',
            'horario' => '09:00',
            'status' => 'pendente'
        ]);

        $this->assertEquals('Montes Claros – MG', $agendamento->nome_sede);
        $this->assertStringContainsString('Montes Claros', $agendamento->endereco_sede);

        $payload = $agendamento->payloadNotificacao();
        $this->assertEquals('Mariana Lima', $payload['cliente_nome']);
        $this->assertEquals('01/12/2026', $payload['data']);
        $this->assertEquals('09:00', $payload['horario']);
        $this->assertEquals('Direito do Servidor', $payload['servico']);
        $this->assertEquals('Dra. Rosevania', $payload['advogado_nome']);
        $this->assertEquals('Montes Claros – MG', $payload['sede_nome']);
        $this->assertStringContainsString('Montes Claros', $payload['sede_endereco']);
    }
}