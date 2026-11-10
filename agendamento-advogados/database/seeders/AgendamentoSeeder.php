<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Agendamento;
use App\Models\Servico;
use App\Models\User;
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

        $advogadosCapitao = User::where('role', 'advogado')->where('sede_padrao', 'capitao_eneas')->pluck('id')->toArray();
        $advogadosMontes = User::where('role', 'advogado')->where('sede_padrao', 'montes_claros')->pluck('id')->toArray();

        // Status permitidos pela migration
        $statusDisponiveis = ['pendente', 'concluido', 'cancelado'];

        $mensagensExemplo = [
            'Gostaria de orientação sobre rescisão indireta do contrato de trabalho e cálculo de verbas rescisórias.',
            'Preciso de análise urgente sobre revisão de benefício previdenciário junto ao INSS.',
            'Tenho dúvidas sobre inventário extrajudicial e partilha de bens familiares.',
            'Solicito consultoria referente a processo administrativo disciplinar (PAD) no serviço público.',
            'Fui cobrado indevidamente e tive meu nome negativado. Desejo ingressar com ação indenizatória.',
            'Preciso de acompanhamento jurídico em audiência de conciliação na área cível.',
            'Gostaria de avaliar a possibilidade de revisão contratual e defesa em execução.',
            'Necessito de orientação sobre guarda compartilhada e regulamentação de pensão alimentícia.',
            'Busco assessoria jurídica para defesa trabalhista e apuração de horas extras não pagas.',
            'Preciso de atendimento para análise de recurso em processo judicial em andamento.',
        ];

        for ($i = 0; $i < 50; $i++) {
            $sede = $faker->randomElement(['capitao_eneas', 'montes_claros']);
            $advogadoId = null;
            if ($sede === 'capitao_eneas' && !empty($advogadosCapitao)) {
                $advogadoId = $faker->randomElement($advogadosCapitao);
            } elseif ($sede === 'montes_claros' && !empty($advogadosMontes)) {
                $advogadoId = $faker->randomElement($advogadosMontes);
            }

            Agendamento::create([
                'nome' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'telefone' => $faker->phoneNumber,
                'servico_id' => $faker->randomElement($servicosIds),
                'sede' => $sede,
                'advogado_id' => $advogadoId,
                'data' => $faker->dateTimeBetween('-1 month', '+2 months')->format('Y-m-d'),
                'horario' => $faker->time('H:i'),
                'mensagem' => $faker->randomElement($mensagensExemplo),
                'status' => $faker->randomElement($statusDisponiveis),
            ]);
        }
    }
}