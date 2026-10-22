<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Servico;
use App\Models\Expediente;
use App\Models\Agendamento;

class SiteAgendamentoTest extends TestCase
{
    use RefreshDatabase;

    public function test_pagina_inicial_carrega_servicos_ativos()
    {
        Servico::create(['titulo' => 'Ativo', 'ativa' => true]);
        Servico::create(['titulo' => 'Inativo', 'ativa' => false]);

        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertSee('Ativo');
        $response->assertDontSee('Inativo');
    }

    public function test_cliente_nao_pode_agendar_fora_do_expediente()
    {
        $servico = Servico::create(['titulo' => 'Consulta', 'ativa' => true]);
        
        // Define expediente na segunda-feira (1) das 08:00 às 18:00
        Expediente::create(['dia_semana' => 1, 'inicio' => '08:00', 'fim' => '18:00']);

        // Data dinâmica da próxima segunda-feira
        $proximaSegunda = \Carbon\Carbon::now()->next(\Carbon\Carbon::MONDAY)->format('Y-m-d');

        // Tenta agendar para uma segunda-feira às 20:00 (fora do horário)
        $response = $this->post(route('agendar'), [
            'nome' => 'Cliente Teste',
            'email' => 'cliente@teste.com',
            'telefone' => '3899999999',
            'servico_id' => $servico->id,
            'data' => $proximaSegunda,
            'horario' => '20:00'
        ]);

        $response->assertSessionHasErrors('horario');
        $this->assertDatabaseCount('agendamentos', 0);
    }
}
