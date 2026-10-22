<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Servico;
use App\Models\Agendamento;

class AdminServicoTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_pode_criar_servico()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post(route('servicos.store'), [
            'titulo' => 'Novo Serviço de Teste',
            'ativa' => true
        ]);
        
        $response->assertRedirect(route('servicos.index'));
        $this->assertDatabaseHas('servicos', ['titulo' => 'Novo Serviço de Teste']);
    }

    public function test_nao_deleta_servico_com_agendamento_vinculado()
    {
        $user = User::factory()->create();
        $servico = Servico::factory()->create();
        Agendamento::factory()->create(['servico_id' => $servico->id]);

        $response = $this->actingAs($user)->delete(route('servicos.destroy', $servico->id));
        
        $response->assertRedirect(route('servicos.index'));
        // Verifica se a trava de integridade relacional agiu e gerou a mensagem esperada
        $response->assertSessionHas('erro', 'Este serviço não pode ser excluído pois já possui agendamentos vinculados. Recomendamos apenas desmarcar a opção "Ativo".');
        $this->assertDatabaseHas('servicos', ['id' => $servico->id]);
    }
}