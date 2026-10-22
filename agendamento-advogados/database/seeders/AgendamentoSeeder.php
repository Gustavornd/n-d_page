<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Agendamento;
use App\Models\Servico;
use Faker\Factory as Faker;

class AgendamentoSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('pt_BR');

        // Busca os IDs dos serviços para preencher a chave estrangeira
        $servicosIds = Servico::pluck('id')->toArray();

        // Se a tabela de serviços estiver vazia, executa o ServicoSeeder primeiro
        if (empty($servicosIds)) {
            $this->call(ServicoSeeder::class);
            $servicosIds = Servico::pluck('id')->toArray();
        }

        // Status permitidos pela migration
        $statusDisponiveis = ['pendente', 'concluido', 'cancelado'];

        for ($i = 0; $i < 50; $i++) {
            Agendamento::create([
                'nome' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'telefone' => $faker->phoneNumber,
                'servico_id' => $faker->randomElement($servicosIds),
                'data' => $faker->dateTimeBetween('-1 month', '+2 months')->format('Y-m-d'),
                'horario' => $faker->time('H:i'),
                'status' => $faker->randomElement($statusDisponiveis),
            ]);
        }
    }
}