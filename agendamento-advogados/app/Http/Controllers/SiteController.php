<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servico;
use App\Models\Agendamento;
use Carbon\Carbon;
use App\Models\Expediente;

class SiteController extends Controller
{
    public function index(){
        $servicos = Servico::where('ativa',true)->get();
        return view('welcome', compact('servicos'));
    }

    public function store(Request $request){
    $dadosValidados = $request->validate([
        'nome' => 'required|string|max:255',
        'email' => 'required|email',
        'telefone' => 'required|string|max:20',
        'servico_id' => 'required|exists:servicos,id',
        'data' => 'required|date|after_or_equal:today',
        'horario' => 'required'
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

    // 3. Impede que dois clientes marquem no mesmo horário no mesmo dia
    $conflito = Agendamento::where('data', $dadosValidados['data'])
        ->where('horario', $horarioEscolhido)
        ->where('status', '!=', 'cancelado') // Se foi cancelado, libera a vaga
        ->exists();

    if ($conflito) {
        return back()->withErrors(['horario' => 'Este horário já está ocupado por outro agendamento. Escolha outro.'])->withInput();
    }

    Agendamento::create($dadosValidados);
    
    return back()->with('sucesso', 'Sua Solicitação foi enviada com Sucesso!');
    }
}
