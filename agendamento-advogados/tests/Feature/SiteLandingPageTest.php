<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Servico;
use App\Models\Expediente;
use App\Models\Agendamento;
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
}
