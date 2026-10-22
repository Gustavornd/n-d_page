<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Expediente;

class AdminExpedienteTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_pode_salvar_expedientes()
    {
        $user = User::factory()->create();
        
        $response = $this->actingAs($user)->post(route('expedientes.store'), [
            'dias' => [
                1 => ['ativo' => '1', 'inicio' => '07:00', 'fim' => '14:00'], // Segunda
                2 => ['ativo' => '1', 'inicio' => '07:00', 'fim' => '18:00'], // Terça
            ]
        ]);
        
        $response->assertRedirect();
        $response->assertSessionHas('sucesso');
        
        // Valida se limpou a tabela antiga e salvou os 2 dias corretamente
        $this->assertDatabaseCount('expedientes', 2);
        $this->assertDatabaseHas('expedientes', [
            'dia_semana' => 1,
            'inicio' => '07:00',
            'fim' => '14:00'
        ]);
    }
}