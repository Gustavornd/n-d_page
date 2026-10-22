<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Servico;

class AgendamentoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'telefone' => fake()->phoneNumber(),
            'servico_id' => Servico::factory(),
            'data' => fake()->dateTimeBetween('+1 days', '+1 month')->format('Y-m-d'),
            'horario' => fake()->numberBetween(8, 17) . ':00',
            'status' => 'pendente',
        ];
    }
}
