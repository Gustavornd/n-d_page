<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agendamento;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index(Request $request){
        // Ordena por data e depois por horário para organizar melhor a lista
        $query = Agendamento::with('servico')->orderBy('data', 'asc')->orderBy('horario', 'asc');
        $hoje = Carbon::today();

        if($request->busca){
            // Se houver busca, procura em todo o banco (ignorando a data) e agrupa as cláusulas OR
            $query->where(function($q) use ($request) {
                $q->where('nome', 'like', '%' . $request->busca . '%')
                  ->orWhere('email', 'like', '%' . $request->busca . '%');
            });
        } else {
            // Se NÃO houver busca, filtra apenas agendamentos de hoje em diante
            $query->whereDate('data', '>=', $hoje);
        }

        $agendamentos = $query->paginate(15);

        $stats = [
            'pendentes' => Agendamento::where('status', 'pendente')
                                      ->whereDate('data', '>=', $hoje)
                                      ->count(),
            'concluidos' => Agendamento::where('status', 'concluido')
                                       ->whereDate('data', '>=', $hoje)
                                       ->count(),
            'cancelados' => Agendamento::where('status', 'cancelado')
                                       ->whereDate('data', '>=', $hoje)
                                       ->count(),
        ];

        return view('dashboard', compact('agendamentos', 'stats'));
    }

    public function atualizarStatus(Request $request, $id){
        $request->validate(['status' => 'required|in:pendente,concluido,cancelado']);
        $agendamento = Agendamento::findOrFail($id);
        $agendamento->update(['status' => $request->status]);

        return back()->with('sucesso', 'Status atualizado com sucesso!');
    }

}
