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
}