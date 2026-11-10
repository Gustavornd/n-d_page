<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Servico;
use App\Models\Expediente;
use App\Models\Agendamento;
use App\Models\User;
use Carbon\Carbon;

class SiteLandingPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_landing_page_renders_with_dark_luxury_layout_and_elements(): void
    {
        $servico = Servico::create(['titulo' => 'Direito Empresarial', 'ativa' => true]);

        $response = $this->get(route('home'));

        $response->assertStatus(200);

        // Layout integration
        $response->assertSee('<!DOCTYPE html>', false);
        $response->assertSee('Nunes & Durães Advocacia');

        // Header / Navigation
        $response->assertSee('assets/logo_nd_gold.png');
        $response->assertSee('NUNES &amp; DURÃES', false);
        $response->assertSee('ADVOCACIA');
        $response->assertSee('Início');
        $response->assertSee('Sobre Nós');
        $response->assertSee('Áreas de Atuação');
        $response->assertSee('Contato');
        $response->assertSee('(38) 99841-4101');

        // Hero Section
        $response->assertSee('ESCRITÓRIO DE ADVOCACIA');
        $response->assertSee('SOLUÇÕES JURÍDICAS');
        $response->assertSee('ALTO PADRÃO');
        $response->assertSee('PROTEGER SEU');
        $response->assertSee('PATRIMÔNIO');
        $response->assertSee('DIREITOS');
        $response->assertSee('Atendimento personalizado, ético e focado em resultados.');
        $response->assertSee('Atendimento Especializado &amp; Exclusivo', false);
        $response->assertSee('Confidencialidade e Segurança Absoluta');
        $response->assertSee('Compromisso com o seu Caso');

        // Form Card
        $response->assertSee('Fale com um Especialista');
        $response->assertSee('Preencha o formulário e nossa equipe entrará em contato brevemente.');
        $response->assertSee('name="nome"', false);
        $response->assertSee('placeholder="Ex: João Silva"', false);
        $response->assertSee('name="email"', false);
        $response->assertSee('placeholder="Ex: contato@email.com"', false);
        $response->assertSee('name="telefone"', false);
        $response->assertSee('placeholder="Ex: (11) 99999-9999"', false);
        $response->assertSee('name="servico_id"', false);
        $response->assertSee('Direito Empresarial');
        $response->assertSee('name="data"', false);
        $response->assertSee('name="horario"', false);
        $response->assertSee('Descreva seu caso (Opcional).');
        $response->assertSee('<textarea id="mensagem" name="mensagem" rows="3" placeholder="Como podemos ajudar você?"', false);
        $response->assertSee('name="mensagem"', false);
        $response->assertSee('placeholder="Como podemos ajudar você?"', false);
        $response->assertSee('ENVIAR MENSAGEM →');

        // Sobre Nós Section
        $response->assertSee('id="sobre-nos"', false);
        $response->assertSee('ATUAÇÃO ESTRATÉGICA &amp; EXCELÊNCIA JURÍDICA', false);
        $response->assertDontSee('Tradição Familiar');
        $response->assertDontSee('TRADIÇÃO FAMILIAR');
        $response->assertDontSee('tradição jurídica familiar');
        $response->assertSee('Sobre a Nunes &amp; Durães Advocacia', false);
        $response->assertSee('Capitão Enéas – MG');
        $response->assertSee('Montes Claros – MG');
        $response->assertSee('filler.jpeg', false);
        $response->assertSee('<!-- TODO: Substituir filler.jpeg pela foto oficial do(a) advogado(a) -->', false);

        // Lawyer 1: Dr. Delssi Durães Oliveira
        $response->assertSee('alt="Dr. Delssi Durães Oliveira - Nunes & Durães Advocacia"', false);
        $response->assertSee('Dr. Delssi Durães Oliveira');
        $response->assertSee('OAB/MG 129.637');
        $response->assertSee('Direito Civil');
        $response->assertSee('Direito Criminal');
        $response->assertSee('Direito Público e Eleitoral');
        $response->assertSee('Ex-Procurador-Geral do Município de Francisco Sá/MG');

        // Lawyer 2: Dra. Gerlice Correia Nunes Oliveira
        $response->assertSee('alt="Dra. Gerlice Correia Nunes Oliveira - Nunes & Durães Advocacia"', false);
        $response->assertSee('Dra. Gerlice Correia Nunes Oliveira');
        $response->assertSee('OAB/MG 188.944');
        $response->assertSee('Direito Trabalhista');
        $response->assertSee('Direito Previdenciário');
        $response->assertSee('Aprovada no XXIV Exame de Ordem Unificado');

        // Lawyer 3: Dra. Rosevania Correia Nunes da Mata
        $response->assertSee('alt="Dra. Rosevania Correia Nunes da Mata - Nunes & Durães Advocacia"', false);
        $response->assertSee('Dra. Rosevania Correia Nunes da Mata');
        $response->assertSee('OAB/MG 202.752');
        $response->assertSee('Direitos dos Servidores Públicos');
        $response->assertSee('Direito Administrativo');
        $response->assertSee('Inscrita na 11ª Subseção da OAB/MG após aprovação no XXIX Exame de Ordem');

        // Office Locations, Phones & Schedule
        $response->assertSee('Avenida Presidente Costa e Silva, 346 - Centro, Capitão Enéas - MG, CEP: 39472-000');
        $response->assertSee('Rua Ismael Duarte, 376, Vila Campos, Montes Claros - MG, CEP: 39403-056');
        $response->assertSee('(38) 99841-4101');
        $response->assertSee('(38) 99852-7655');
        $response->assertSee('(38) 99939-3133');
        $response->assertSee('Segunda a Quinta-feira, das 08h00 às 17h00');

        // Footer & Email Removal
        $response->assertSee('N / D');
        $response->assertDontSee('contato@nuneseduraes.com');
        $response->assertDontSee('contato@nuneseduraes.com.br');
        $response->assertSee('Todos os direitos reservados.');
    }

    public function test_form_submission_with_mensagem_succeeds_and_creates_agendamento(): void
    {
        $servico = Servico::create(['titulo' => 'Consultoria Jurídica', 'ativa' => true]);
        Expediente::create(['dia_semana' => 1, 'inicio' => '08:00', 'fim' => '18:00']);

        $proximaSegunda = Carbon::now()->next(Carbon::MONDAY)->format('Y-m-d');

        $response = $this->from(route('home'))->post(route('agendar'), [
            'nome' => 'Carlos Pereira',
            'email' => 'carlos@exemplo.com',
            'telefone' => '(11) 98765-4321',
            'servico_id' => $servico->id,
            'data' => $proximaSegunda,
            'horario' => '10:00',
            'mensagem' => 'Gostaria de avaliar um contrato empresarial de grande porte.'
        ]);

        $response->assertRedirect(route('home'));
        $response->assertSessionHas('sucesso', 'Sua Solicitação foi enviada com Sucesso!');

        $this->assertDatabaseHas('agendamentos', [
            'nome' => 'Carlos Pereira',
            'email' => 'carlos@exemplo.com',
            'servico_id' => $servico->id,
            'data' => $proximaSegunda,
            'horario' => '10:00',
            'mensagem' => 'Gostaria de avaliar um contrato empresarial de grande porte.',
        ]);
    }

    public function test_form_submission_without_mensagem_succeeds_and_stores_null(): void
    {
        $servico = Servico::create(['titulo' => 'Direito Previdenciário', 'ativa' => true]);
        Expediente::create(['dia_semana' => 1, 'inicio' => '08:00', 'fim' => '18:00']);

        $proximaSegunda = Carbon::now()->next(Carbon::MONDAY)->format('Y-m-d');

        $response = $this->from(route('home'))->post(route('agendar'), [
            'nome' => 'Ana Souza',
            'email' => 'ana@exemplo.com',
            'telefone' => '(38) 99111-2222',
            'servico_id' => $servico->id,
            'data' => $proximaSegunda,
            'horario' => '11:00',
            'mensagem' => '',
        ]);

        $response->assertRedirect(route('home'));
        $response->assertSessionHas('sucesso', 'Sua Solicitação foi enviada com Sucesso!');

        $this->assertDatabaseHas('agendamentos', [
            'nome' => 'Ana Souza',
            'email' => 'ana@exemplo.com',
            'servico_id' => $servico->id,
            'data' => $proximaSegunda,
            'horario' => '11:00',
            'mensagem' => null,
        ]);

        // Also test when 'mensagem' key is omitted completely (null)
        $responseOmitted = $this->from(route('home'))->post(route('agendar'), [
            'nome' => 'Lucas Martins',
            'email' => 'lucas@exemplo.com',
            'telefone' => '(38) 99333-4444',
            'servico_id' => $servico->id,
            'data' => $proximaSegunda,
            'horario' => '15:00',
        ]);

        $responseOmitted->assertRedirect(route('home'));
        $responseOmitted->assertSessionHas('sucesso', 'Sua Solicitação foi enviada com Sucesso!');

        $this->assertDatabaseHas('agendamentos', [
            'nome' => 'Lucas Martins',
            'email' => 'lucas@exemplo.com',
            'servico_id' => $servico->id,
            'data' => $proximaSegunda,
            'horario' => '15:00',
            'mensagem' => null,
        ]);
    }

    public function test_form_validation_errors_render_properly_with_visual_feedback_and_old_input(): void
    {
        $servico = Servico::create(['titulo' => 'Direito Civil', 'ativa' => true]);

        $response = $this->from(route('home'))
            ->followingRedirects()
            ->post(route('agendar'), [
                'nome' => 'Maria Silva',
                'email' => 'email-invalido',
                'telefone' => '(11) 91234-5678',
                'servico_id' => 99999,
                'data' => '2020-01-01',
                'horario' => '',
                'mensagem' => 'Texto da mensagem de teste preservada.'
            ]);

        $response->assertStatus(200);

        // Old inputs preserved
        $response->assertSee('value="Maria Silva"', false);
        $response->assertSee('Texto da mensagem de teste preservada.');

        // Visual error indicators and error messages present
        $response->assertSee('border-red-500', false);
    }

    public function test_form_submission_on_non_business_day_is_rejected(): void
    {
        $servico = Servico::create(['titulo' => 'Direito Trabalhista', 'ativa' => true]);
        // Only Monday has business hours
        Expediente::create(['dia_semana' => 1, 'inicio' => '08:00', 'fim' => '18:00']);

        // Pick next Sunday (dia_semana = 0)
        $proximoDomingo = Carbon::now()->next(Carbon::SUNDAY)->format('Y-m-d');

        $response = $this->from(route('home'))->post(route('agendar'), [
            'nome' => 'Roberto Costa',
            'email' => 'roberto@exemplo.com',
            'telefone' => '(11) 98888-7777',
            'servico_id' => $servico->id,
            'data' => $proximoDomingo,
            'horario' => '10:00',
            'mensagem' => 'Consulta urgente.'
        ]);

        $response->assertRedirect(route('home'));
        $response->assertSessionHasErrors(['data']);
    }

    public function test_form_submission_with_mensagem_exceeding_1000_chars_is_rejected(): void
    {
        $servico = Servico::create(['titulo' => 'Direito Trabalhista', 'ativa' => true]);
        Expediente::create(['dia_semana' => 1, 'inicio' => '08:00', 'fim' => '18:00']);

        $proximaSegunda = Carbon::now()->next(Carbon::MONDAY)->format('Y-m-d');

        $response = $this->from(route('home'))->post(route('agendar'), [
            'nome' => 'Pedro Santos',
            'email' => 'pedro@exemplo.com',
            'telefone' => '(38) 98888-7777',
            'servico_id' => $servico->id,
            'data' => $proximaSegunda,
            'horario' => '14:00',
            'mensagem' => str_repeat('A', 1001),
        ]);

        $response->assertRedirect(route('home'));
        $response->assertSessionHasErrors(['mensagem']);
    }

    public function test_landing_page_exibe_selecao_de_sede_e_advogados(): void
    {
        User::factory()->advogado('capitao_eneas', 'OAB/MG 129.637')->create(['name' => 'Dr. Delssi Durães Oliveira']);
        User::factory()->advogado('capitao_eneas', 'OAB/MG 188.944')->create(['name' => 'Dra. Gerlice Correia Nunes Oliveira']);
        User::factory()->advogado('montes_claros', 'OAB/MG 202.752')->create(['name' => 'Dra. Rosevania Correia Nunes da Mata']);
        Servico::create(['titulo' => 'Direito Civil', 'ativa' => true]);

        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertSee('name="sede"', false);
        $response->assertSee('Capitão Enéas – MG (Centro)');
        $response->assertSee('Montes Claros – MG (Vila Campos)');
        $response->assertSee('name="advogado_id"', false);
        $response->assertSee('Sem preferência (Qualquer profissional disponível)');
        $response->assertSee('Sem preferência / Dra. Rosevania Correia Nunes da Mata');
        $response->assertSee('Dr. Delssi Durães Oliveira');
        $response->assertSee('Dra. Gerlice Correia Nunes Oliveira');
        $response->assertSee('Dra. Rosevania Correia Nunes da Mata');
        $response->assertSee('Nossa equipe atua de forma integrada: o atendimento inicial ocorre presencialmente na sede escolhida, sem necessidade de deslocamento entre cidades.');
    }

    public function test_agendamento_com_advogado_especifico_em_capitao_eneas(): void
    {
        $delssi = User::factory()->advogado('capitao_eneas')->create(['name' => 'Dr. Delssi']);
        $servico = Servico::create(['titulo' => 'Direito Civil', 'ativa' => true]);
        Expediente::create(['dia_semana' => 1, 'inicio' => '08:00', 'fim' => '18:00']);

        $proximaSegunda = Carbon::now()->next(Carbon::MONDAY)->format('Y-m-d');

        $response = $this->from(route('home'))->post(route('agendar'), [
            'nome' => 'Marcos Lima',
            'email' => 'marcos@teste.com',
            'telefone' => '38999990001',
            'servico_id' => $servico->id,
            'sede' => 'capitao_eneas',
            'advogado_id' => $delssi->id,
            'data' => $proximaSegunda,
            'horario' => '10:00',
        ]);

        $response->assertRedirect(route('home'));
        $response->assertSessionHas('sucesso');

        $this->assertDatabaseHas('agendamentos', [
            'nome' => 'Marcos Lima',
            'sede' => 'capitao_eneas',
            'advogado_id' => $delssi->id,
            'horario' => '10:00',
        ]);
    }

    public function test_agendamento_sem_preferencia_em_montes_claros_atribui_rosevania(): void
    {
        $rosevania = User::factory()->advogado('montes_claros')->create(['name' => 'Dra. Rosevania']);
        $servico = Servico::create(['titulo' => 'Direito Civil', 'ativa' => true]);
        Expediente::create(['dia_semana' => 1, 'inicio' => '08:00', 'fim' => '18:00']);

        $proximaSegunda = Carbon::now()->next(Carbon::MONDAY)->format('Y-m-d');

        $response = $this->from(route('home'))->post(route('agendar'), [
            'nome' => 'Beatriz Santos',
            'email' => 'beatriz@teste.com',
            'telefone' => '38999990002',
            'servico_id' => $servico->id,
            'sede' => 'montes_claros',
            'advogado_id' => '',
            'data' => $proximaSegunda,
            'horario' => '14:00',
        ]);

        $response->assertRedirect(route('home'));
        $response->assertSessionHas('sucesso');

        $this->assertDatabaseHas('agendamentos', [
            'nome' => 'Beatriz Santos',
            'sede' => 'montes_claros',
            'advogado_id' => $rosevania->id,
        ]);
    }

    public function test_agendamento_sem_preferencia_em_capitao_eneas_atribui_advogado_disponivel(): void
    {
        $delssi = User::factory()->advogado('capitao_eneas')->create(['name' => 'Dr. Delssi']);
        $gerlice = User::factory()->advogado('capitao_eneas')->create(['name' => 'Dra. Gerlice']);
        $servico = Servico::create(['titulo' => 'Direito Civil', 'ativa' => true]);
        Expediente::create(['dia_semana' => 1, 'inicio' => '08:00', 'fim' => '18:00']);

        $proximaSegunda = Carbon::now()->next(Carbon::MONDAY)->format('Y-m-d');

        // Delssi já está ocupado às 10:00
        Agendamento::create([
            'nome' => 'Cliente Ocupante',
            'email' => 'ocupante@teste.com',
            'telefone' => '38999990003',
            'servico_id' => $servico->id,
            'sede' => 'capitao_eneas',
            'advogado_id' => $delssi->id,
            'data' => $proximaSegunda,
            'horario' => '10:00',
            'status' => 'pendente'
        ]);

        // Novo cliente agenda às 10:00 com "Sem preferência"
        $response = $this->from(route('home'))->post(route('agendar'), [
            'nome' => 'Novo Cliente',
            'email' => 'novo@teste.com',
            'telefone' => '38999990004',
            'servico_id' => $servico->id,
            'sede' => 'capitao_eneas',
            'data' => $proximaSegunda,
            'horario' => '10:00',
        ]);

        $response->assertRedirect(route('home'));
        $response->assertSessionHas('sucesso');

        // Deve ter sido atribuído à Gerlice (que estava livre)
        $this->assertDatabaseHas('agendamentos', [
            'nome' => 'Novo Cliente',
            'sede' => 'capitao_eneas',
            'advogado_id' => $gerlice->id,
            'horario' => '10:00',
        ]);
    }

    public function test_agendamento_sem_preferencia_em_capitao_eneas_balanceia_pela_menor_quantidade_de_pendentes(): void
    {
        $delssi = User::factory()->advogado('capitao_eneas')->create(['name' => 'Dr. Delssi']);
        $gerlice = User::factory()->advogado('capitao_eneas')->create(['name' => 'Dra. Gerlice']);
        $servico = Servico::create(['titulo' => 'Direito Civil', 'ativa' => true]);
        Expediente::create(['dia_semana' => 1, 'inicio' => '08:00', 'fim' => '18:00']);

        $proximaSegunda = Carbon::now()->next(Carbon::MONDAY)->format('Y-m-d');

        // Delssi tem 2 agendamentos pendentes nessa data (em outros horários)
        Agendamento::create([
            'nome' => 'C1', 'email' => 'c1@t.com', 'telefone' => '1', 'servico_id' => $servico->id,
            'sede' => 'capitao_eneas', 'advogado_id' => $delssi->id, 'data' => $proximaSegunda, 'horario' => '08:00', 'status' => 'pendente'
        ]);
        Agendamento::create([
            'nome' => 'C2', 'email' => 'c2@t.com', 'telefone' => '2', 'servico_id' => $servico->id,
            'sede' => 'capitao_eneas', 'advogado_id' => $delssi->id, 'data' => $proximaSegunda, 'horario' => '09:00', 'status' => 'pendente'
        ]);

        // Gerlice tem 0 agendamentos nessa data.
        // Novo agendamento para 14:00 (ambos livres) com "Sem preferência":
        $response = $this->from(route('home'))->post(route('agendar'), [
            'nome' => 'Cliente Balanceado',
            'email' => 'bal@teste.com',
            'telefone' => '38999990005',
            'servico_id' => $servico->id,
            'sede' => 'capitao_eneas',
            'data' => $proximaSegunda,
            'horario' => '14:00',
        ]);

        $response->assertRedirect(route('home'));
        $response->assertSessionHas('sucesso');

        // Deve atribuir para Gerlice por balanceamento
        $this->assertDatabaseHas('agendamentos', [
            'nome' => 'Cliente Balanceado',
            'advogado_id' => $gerlice->id,
        ]);
    }

    public function test_dois_clientes_podem_agendar_no_mesmo_horario_com_advogados_diferentes(): void
    {
        $delssi = User::factory()->advogado('capitao_eneas')->create(['name' => 'Dr. Delssi']);
        $gerlice = User::factory()->advogado('capitao_eneas')->create(['name' => 'Dra. Gerlice']);
        $servico = Servico::create(['titulo' => 'Direito Civil', 'ativa' => true]);
        Expediente::create(['dia_semana' => 1, 'inicio' => '08:00', 'fim' => '18:00']);

        $proximaSegunda = Carbon::now()->next(Carbon::MONDAY)->format('Y-m-d');

        // Primeiro cliente agenda com Delssi às 10:00
        $response1 = $this->from(route('home'))->post(route('agendar'), [
            'nome' => 'Cliente 1',
            'email' => 'cli1@teste.com',
            'telefone' => '38999990006',
            'servico_id' => $servico->id,
            'sede' => 'capitao_eneas',
            'advogado_id' => $delssi->id,
            'data' => $proximaSegunda,
            'horario' => '10:00',
        ]);
        $response1->assertSessionHas('sucesso');

        // Segundo cliente agenda com Gerlice no MESMO horário (10:00)
        $response2 = $this->from(route('home'))->post(route('agendar'), [
            'nome' => 'Cliente 2',
            'email' => 'cli2@teste.com',
            'telefone' => '38999990007',
            'servico_id' => $servico->id,
            'sede' => 'capitao_eneas',
            'advogado_id' => $gerlice->id,
            'data' => $proximaSegunda,
            'horario' => '10:00',
        ]);
        $response2->assertSessionHas('sucesso');

        // Ambos agendamentos devem existir
        $this->assertEquals(2, Agendamento::where('data', $proximaSegunda)->where('horario', '10:00')->count());
    }

    public function test_mesmo_advogado_nao_pode_ter_dois_agendamentos_no_mesmo_horario(): void
    {
        $delssi = User::factory()->advogado('capitao_eneas')->create(['name' => 'Dr. Delssi']);
        $servico = Servico::create(['titulo' => 'Direito Civil', 'ativa' => true]);
        Expediente::create(['dia_semana' => 1, 'inicio' => '08:00', 'fim' => '18:00']);

        $proximaSegunda = Carbon::now()->next(Carbon::MONDAY)->format('Y-m-d');

        // Primeiro agendamento para Delssi
        Agendamento::create([
            'nome' => 'Cliente Delssi 1',
            'email' => 'delssi1@teste.com',
            'telefone' => '38999990008',
            'servico_id' => $servico->id,
            'sede' => 'capitao_eneas',
            'advogado_id' => $delssi->id,
            'data' => $proximaSegunda,
            'horario' => '10:00',
            'status' => 'pendente',
        ]);

        // Tentativa de segundo agendamento com mesmo advogado no mesmo dia e horário
        $response = $this->from(route('home'))->post(route('agendar'), [
            'nome' => 'Cliente Delssi 2',
            'email' => 'delssi2@teste.com',
            'telefone' => '38999990009',
            'servico_id' => $servico->id,
            'sede' => 'capitao_eneas',
            'advogado_id' => $delssi->id,
            'data' => $proximaSegunda,
            'horario' => '10:00',
        ]);

        $response->assertRedirect(route('home'));
        $response->assertSessionHasErrors(['horario']);
    }

    public function test_advogado_nao_pode_ser_agendado_em_sede_diferente(): void
    {
        $delssi = User::factory()->advogado('capitao_eneas')->create(['name' => 'Dr. Delssi']);
        $servico = Servico::create(['titulo' => 'Direito Civil', 'ativa' => true]);
        Expediente::create(['dia_semana' => 1, 'inicio' => '08:00', 'fim' => '18:00']);

        $proximaSegunda = Carbon::now()->next(Carbon::MONDAY)->format('Y-m-d');

        // Tenta marcar Delssi (Capitão Enéas) na sede de Montes Claros
        $response = $this->from(route('home'))->post(route('agendar'), [
            'nome' => 'Cliente Sede Errada',
            'email' => 'errada@teste.com',
            'telefone' => '38999990010',
            'servico_id' => $servico->id,
            'sede' => 'montes_claros',
            'advogado_id' => $delssi->id,
            'data' => $proximaSegunda,
            'horario' => '10:00',
        ]);

        $response->assertRedirect(route('home'));
        $response->assertSessionHasErrors(['advogado_id']);
    }

    public function test_ambos_advogados_ocupados_em_capitao_eneas_rejeita_agendamento_sem_preferencia(): void
    {
        $delssi = User::factory()->advogado('capitao_eneas')->create(['name' => 'Dr. Delssi']);
        $gerlice = User::factory()->advogado('capitao_eneas')->create(['name' => 'Dra. Gerlice']);
        $servico = Servico::create(['titulo' => 'Direito Civil', 'ativa' => true]);
        Expediente::create(['dia_semana' => 1, 'inicio' => '08:00', 'fim' => '18:00']);

        $proximaSegunda = Carbon::now()->next(Carbon::MONDAY)->format('Y-m-d');

        // Ocupa ambos os advogados às 10:00
        Agendamento::create([
            'nome' => 'Ocupante 1', 'email' => 'o1@t.com', 'telefone' => '1', 'servico_id' => $servico->id,
            'sede' => 'capitao_eneas', 'advogado_id' => $delssi->id, 'data' => $proximaSegunda, 'horario' => '10:00', 'status' => 'pendente'
        ]);
        Agendamento::create([
            'nome' => 'Ocupante 2', 'email' => 'o2@t.com', 'telefone' => '2', 'servico_id' => $servico->id,
            'sede' => 'capitao_eneas', 'advogado_id' => $gerlice->id, 'data' => $proximaSegunda, 'horario' => '10:00', 'status' => 'pendente'
        ]);

        // Tentativa de marcar às 10:00 sem preferência
        $response = $this->from(route('home'))->post(route('agendar'), [
            'nome' => 'Terceiro Cliente',
            'email' => 'o3@teste.com',
            'telefone' => '38999990011',
            'servico_id' => $servico->id,
            'sede' => 'capitao_eneas',
            'data' => $proximaSegunda,
            'horario' => '10:00',
        ]);

        $response->assertRedirect(route('home'));
        $response->assertSessionHasErrors(['horario']);
    }

    public function test_advogada_ocupada_em_montes_claros_rejeita_agendamento_sem_preferencia(): void
    {
        $rosevania = User::factory()->advogado('montes_claros')->create(['name' => 'Dra. Rosevania']);
        $servico = Servico::create(['titulo' => 'Direito Administrativo', 'ativa' => true]);
        Expediente::create(['dia_semana' => 1, 'inicio' => '08:00', 'fim' => '18:00']);

        $proximaSegunda = Carbon::now()->next(Carbon::MONDAY)->format('Y-m-d');

        // Ocupa Rosevania às 14:00
        Agendamento::create([
            'nome' => 'Cliente Existente Montes',
            'email' => 'existente_montes@teste.com',
            'telefone' => '38999990012',
            'servico_id' => $servico->id,
            'sede' => 'montes_claros',
            'advogado_id' => $rosevania->id,
            'data' => $proximaSegunda,
            'horario' => '14:00',
            'status' => 'pendente'
        ]);

        // Novo cliente tenta agendar sem preferência no mesmo horário em Montes Claros
        $response = $this->from(route('home'))->post(route('agendar'), [
            'nome' => 'Cliente Novo Montes',
            'email' => 'novo_montes@teste.com',
            'telefone' => '38999990013',
            'servico_id' => $servico->id,
            'sede' => 'montes_claros',
            'advogado_id' => '',
            'data' => $proximaSegunda,
            'horario' => '14:00',
        ]);

        $response->assertRedirect(route('home'));
        $response->assertSessionHasErrors(['horario' => 'Não há profissionais disponíveis neste horário para a sede selecionada. Escolha outro horário.']);
    }
}
