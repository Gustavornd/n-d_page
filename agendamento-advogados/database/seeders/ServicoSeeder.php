<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Servico;

class ServicoSeeder extends Seeder
{
    public function run(): void
    {
        Servico::create(['titulo' => 'Consultoria Trabalhista', 'ativa' => true]);
        Servico::create(['titulo' => 'Direito Civil e Família', 'ativa' => true]);
        Servico::create(['titulo' => 'Defesa do Consumidor', 'ativa' => true]);
    }
}