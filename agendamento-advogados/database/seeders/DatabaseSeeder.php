<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Executa a criação dos serviços
        $this->call([ServicoSeeder::class, AgendamentoSeeder::class]);

        // Cria o usuário administrador para acesso ao painel
        User::create([
            'name' => 'Admin',
            'email' => 'admin@nuneseduraes.com.br',
            'password' => bcrypt('password'),
        ]);
    }
}
