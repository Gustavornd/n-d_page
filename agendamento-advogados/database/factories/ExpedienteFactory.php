<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ExpedienteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'dia_semana' => fake()->unique()->numberBetween(1, 5),
            'inicio' => '08:00',
            'fim' => '18:00',
        ];
    }
}
