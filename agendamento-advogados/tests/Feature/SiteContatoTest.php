<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Contato;
use App\Models\Servico;

class SiteContatoTest extends TestCase
{
    use RefreshDatabase;

    public function test_landing_page_exibe_todos_os_elementos_dark_luxury()
    {
        Servico::create(['titulo' => 'Direito Tributário', 'ativa' => true]);

        $response = $this->get(route('home'));

        $response->assertStatus(200);

        // Header
        $response->assertSee('MTD ADVOGADOS');
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
        $response->assertSee('E SEUS');
        $response->assertSee('DIREITOS');
        $response->assertSee('Atendimento personalizado, ético e focado em resultados');
        $response->assertSee('Atendimento Especializado &amp; Exclusivo', false);
        $response->assertSee('Confidencialidade e Segurança Absoluta');
        $response->assertSee('Compromisso com o seu Caso');

        // Formulário Card
        $response->assertSee('Fale com um Especialista');
        $response->assertSee('Preencha o formulário e nossa equipe entrará em contato brevemente');
        $response->assertSee('Nome Completo');
        $response->assertSee('E-mail');
        $response->assertSee('Telefone');
        $response->assertSee('Mensagem');
        $response->assertSee('ENVIAR MENSAGEM →');

        // Footer
        $response->assertSee('M/T/D');
        $response->assertSee('mtd.contato@email.com');
        $response->assertSee('© 2026 MTD Advogados. Todos os direitos reservados.');
    }

    public function test_visitante_pode_enviar_mensagem_de_contato()
    {
        $dadosContato = [
            'nome' => 'Dr. Roberto Silveira',
            'email' => 'roberto@exemplo.com',
            'telefone' => '(11) 98765-4321',
            'mensagem' => 'Gostaria de agendar uma reunião sobre planejamento sucessório e patrimonial.',
        ];

        $response = $this->post(route('contato'), $dadosContato);

        $response->assertSessionHas('sucesso');
        $this->assertDatabaseHas('contatos', [
            'nome' => 'Dr. Roberto Silveira',
            'email' => 'roberto@exemplo.com',
            'telefone' => '(11) 98765-4321',
        ]);
    }

    public function test_contato_valida_campos_obrigatorios()
    {
        $response = $this->post(route('contato'), []);

        $response->assertSessionHasErrors(['nome', 'email', 'telefone', 'mensagem']);
        $this->assertDatabaseCount('contatos', 0);
    }

    public function test_contato_rejeita_email_invalido_e_limites_excedidos()
    {
        $response = $this->post(route('contato'), [
            'nome' => str_repeat('A', 256),
            'email' => 'email-invalido-sem-arroba',
            'telefone' => str_repeat('9', 26),
            'mensagem' => str_repeat('X', 3001),
        ]);

        $response->assertSessionHasErrors(['nome', 'email', 'telefone', 'mensagem']);
        $this->assertDatabaseCount('contatos', 0);
    }

    public function test_contato_aceita_caracteres_especiais_e_mensagem_extensa()
    {
        $mensagemExtensa = str_repeat('Necessito de consultoria tributária de alto padrão. ', 40); // ~2080 chars

        $response = $this->post(route('contato'), [
            'nome' => 'Dr. João d\'Ávila & Associados',
            'email' => 'joao.davila@dominio.com.br',
            'telefone' => '+55 (11) 99999-8888',
            'mensagem' => $mensagemExtensa,
        ]);

        $response->assertSessionHas('sucesso');
        $this->assertDatabaseHas('contatos', [
            'email' => 'joao.davila@dominio.com.br',
            'nome' => 'Dr. João d\'Ávila & Associados',
        ]);
    }
}
