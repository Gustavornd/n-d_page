<?php

namespace Database\Seeders;

use App\Models\Expediente;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Cadastra expediente padrão (Segunda a Sexta, 08:00 às 18:00) caso não exista
        if (Expediente::count() === 0) {
            foreach ([1, 2, 3, 4, 5] as $dia) {
                Expediente::create([
                    'dia_semana' => $dia,
                    'inicio' => '08:00',
                    'fim' => '18:00',
                ]);
            }
        }

        // Executa a criação dos serviços e agendamentos
        $this->call([ServicoSeeder::class, AgendamentoSeeder::class]);

        // Cria o usuário administrador para acesso ao painel
        User::firstOrCreate(
            ['email' => 'admin@nuneseduraes.com.br'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
            ]
        );
    }
}
