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
        $response->assertSee('(11) 99999-9999');

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
        $response->assertSee('name="mensagem"', false);
        $response->assertSee('placeholder="Como podemos ajudar você?"', false);
        $response->assertSee('ENVIAR MENSAGEM →');

        // Footer
        $response->assertSee('N / D');
        $response->assertSee('contato@nuneseduraes.com.br');
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
}
