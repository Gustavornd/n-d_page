<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servico;
use App\Models\Agendamento;
use App\Models\Expediente;
use App\Models\User;
use Carbon\Carbon;

class SiteController extends Controller
{
    public function index()
    {
        $servicos = Servico::where('ativa', true)->get();
        $advogados = User::where('role', 'advogado')->get();

        return view('welcome', compact('servicos', 'advogados'));
    }

    public function store(Request $request)
    {
        if (!$request->filled('sede')) {
            $request->merge(['sede' => 'capitao_eneas']);
        }

        $dadosValidados = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email',
            'telefone' => 'required|string|max:20',
            'servico_id' => 'required|exists:servicos,id',
            'sede' => 'required|in:capitao_eneas,montes_claros',
            'advogado_id' => 'nullable|exists:users,id',
            'data' => 'required|date|after_or_equal:today',
            'horario' => 'required',
            'mensagem' => 'nullable|string|max:1000',
        ]);

        $dataEscolhida = Carbon::parse($dadosValidados['data']);
        $diaSemana = $dataEscolhida->dayOfWeek; // 0 (Domingo) a 6 (Sábado)
        $horarioEscolhido = $dadosValidados['horario'];

        // 1. Verifica se o dia possui expediente cadastrado
        $expediente = Expediente::where('dia_semana', $diaSemana)->first();

        if (!$expediente) {
            return back()->withErrors(['data' => 'Não realizamos atendimentos neste dia da semana.'])->withInput();
        }

        // 2. Verifica se o horário está dentro do range de atendimento
        if ($horarioEscolhido < $expediente->inicio || $horarioEscolhido > $expediente->fim) {
            return back()->withErrors(['horario' => 'O horário escolhido está fora do expediente ('.$expediente->inicio.' às '.$expediente->fim.').'])->withInput();
        }

        // 3. Determina o advogado responsável
        $advogadoIdFinal = null;

        if (!empty($dadosValidados['advogado_id'])) {
            $advogado = User::where('role', 'advogado')->find($dadosValidados['advogado_id']);
            if (!$advogado || $advogado->sede_padrao !== $dadosValidados['sede']) {
                return back()->withErrors(['advogado_id' => 'O advogado selecionado não atende na sede escolhida.'])->withInput();
            }
            $advogadoIdFinal = $advogado->id;
        } else {
            // "Sem preferência" (ou não informado) para a sede escolhida
            $advogadosSede = User::where('role', 'advogado')
                ->where('sede_padrao', $dadosValidados['sede'])
                ->get();

            if ($advogadosSede->isNotEmpty()) {
                $disponiveis = $advogadosSede->filter(function ($adv) use ($dadosValidados, $horarioEscolhido) {
                    return !Agendamento::where('data', $dadosValidados['data'])
                        ->where('horario', $horarioEscolhido)
                        ->where('advogado_id', $adv->id)
                        ->where('status', '!=', 'cancelado')
                        ->exists();
                });

                if ($disponiveis->isEmpty()) {
                    return back()->withErrors(['horario' => 'Não há profissionais disponíveis neste horário para a sede selecionada. Escolha outro horário.'])->withInput();
                }

                if ($disponiveis->count() === 1) {
                    $advogadoIdFinal = $disponiveis->first()->id;
                } else {
                    // Múltiplos disponíveis (ex: Capitão Enéas): balanceamento por menor quantidade de pendentes na data
                    $advogadoIdFinal = $disponiveis->sortBy(function ($adv) use ($dadosValidados) {
                        return Agendamento::where('advogado_id', $adv->id)
                            ->where('data', $dadosValidados['data'])
                            ->where('status', 'pendente')
                            ->count();
                    })->first()->id;
                }
            }
        }

        // 4. Validação de conflito de horário para o advogado selecionado/atribuído
        if ($advogadoIdFinal !== null) {
            $conflito = Agendamento::where('data', $dadosValidados['data'])
                ->where('horario', $horarioEscolhido)
                ->where('advogado_id', $advogadoIdFinal)
                ->where('status', '!=', 'cancelado')
                ->exists();

            if ($conflito) {
                return back()->withErrors(['horario' => 'Este horário já está ocupado para o profissional selecionado. Escolha outro.'])->withInput();
            }
        } else {
            // Fallback para testes sem advogados cadastrados
            $conflito = Agendamento::where('data', $dadosValidados['data'])
                ->where('horario', $horarioEscolhido)
                ->where('status', '!=', 'cancelado')
                ->exists();

            if ($conflito) {
                return back()->withErrors(['horario' => 'Este horário já está ocupado por outro agendamento. Escolha outro.'])->withInput();
            }
        }

        $dadosValidados['advogado_id'] = $advogadoIdFinal;
        Agendamento::create($dadosValidados);

        return back()->with('sucesso', 'Sua Solicitação foi enviada com Sucesso!');
    }
}
