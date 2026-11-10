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

        // Cria ou atualiza o usuário administrador para acesso ao painel
        User::updateOrCreate(
            ['email' => 'admin@nuneseduraes.com.br'],
            [
                'name' => 'Administrador Geral',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]
        );

        // Cria ou atualiza os 3 advogados com suas respectivas sedes e credenciais
        User::updateOrCreate(
            ['email' => 'delssi@nuneseduraes.com.br'],
            [
                'name' => 'Dr. Delssi Durães Oliveira',
                'password' => bcrypt('password'),
                'role' => 'advogado',
                'sede_padrao' => 'capitao_eneas',
                'oab' => 'OAB/MG 129.637',
            ]
        );

        User::updateOrCreate(
            ['email' => 'gerlice@nuneseduraes.com.br'],
            [
                'name' => 'Dra. Gerlice Correia Nunes Oliveira',
                'password' => bcrypt('password'),
                'role' => 'advogado',
                'sede_padrao' => 'capitao_eneas',
                'oab' => 'OAB/MG 188.944',
            ]
        );

        User::updateOrCreate(
            ['email' => 'rosevania@nuneseduraes.com.br'],
            [
                'name' => 'Dra. Rosevania Correia Nunes da Mata',
                'password' => bcrypt('password'),
                'role' => 'advogado',
                'sede_padrao' => 'montes_claros',
                'oab' => 'OAB/MG 202.752',
            ]
        );

        // Executa a criação dos serviços e agendamentos
        $this->call([ServicoSeeder::class, AgendamentoSeeder::class]);
    }
}
