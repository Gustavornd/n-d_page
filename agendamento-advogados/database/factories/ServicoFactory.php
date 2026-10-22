<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ServicoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'titulo' => fake()->word() . ' Jurídico',
            'ativa' => true,
        ];
    }
}