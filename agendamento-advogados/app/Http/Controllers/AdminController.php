<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agendamento;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Agendamento::with(['servico', 'advogado'])->orderBy('data', 'asc')->orderBy('horario', 'asc');
        $hoje = Carbon::today();

        if (!$user->isAdmin()) {
            // Advogado visualiza somente os agendamentos atribuídos a ele
            $query->where('advogado_id', $user->id);
        } else {
            // Admin pode filtrar por advogado e por sede se quiser
            if ($request->filled('advogado_id')) {
                $query->where('advogado_id', $request->advogado_id);
            }
            if ($request->filled('sede')) {
                $query->where('sede', $request->sede);
            }
        }

        if ($request->filled('busca')) {
            $termoBusca = trim((string) $request->busca);
            // Se houver busca, procura em todo o banco (ignorando a data) e agrupa as cláusulas OR
            $query->where(function ($q) use ($termoBusca) {
                $q->where('nome', 'like', '%' . $termoBusca . '%')
                  ->orWhere('email', 'like', '%' . $termoBusca . '%')
                  ->orWhere('mensagem', 'like', '%' . $termoBusca . '%');
            });
        } else {
            // Se NÃO houver busca, filtra apenas agendamentos de hoje em diante
            $query->whereDate('data', '>=', $hoje);
        }

        $agendamentos = $query->paginate(15)->withQueryString();

        // Estatísticas respeitando o escopo do usuário autenticado
        $statsQuery = Agendamento::whereDate('data', '>=', $hoje);
        if (!$user->isAdmin()) {
            $statsQuery->where('advogado_id', $user->id);
        }

        $stats = [
            'pendentes' => (clone $statsQuery)->where('status', 'pendente')->count(),
            'concluidos' => (clone $statsQuery)->where('status', 'concluido')->count(),
            'cancelados' => (clone $statsQuery)->where('status', 'cancelado')->count(),
        ];

        $advogados = User::where('role', 'advogado')->orderBy('name')->get();

        return view('dashboard', compact('agendamentos', 'stats', 'advogados'));
    }

    public function atualizarStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:pendente,concluido,cancelado']);
        $agendamento = Agendamento::findOrFail($id);

        $user = Auth::user();
        if (!$user->isAdmin() && $agendamento->advogado_id !== $user->id) {
            abort(403, 'Ação não autorizada para este agendamento.');
        }

        $agendamento->update(['status' => $request->status]);

        return back()->with('sucesso', 'Status atualizado com sucesso!');
    }

    public function reatribuirAdvogado(Request $request, $id)
    {
        $user = Auth::user();
        if (!$user->isAdmin()) {
            abort(403, 'Apenas administradores podem reatribuir agendamentos.');
        }

        $request->validate([
            'advogado_id' => 'required|exists:users,id',
        ]);

        $agendamento = Agendamento::findOrFail($id);
        $novoAdvogado = User::where('role', 'advogado')->find($request->advogado_id);

        if (!$novoAdvogado) {
            return back()->withErrors(['advogado_id' => 'O usuário selecionado não é um advogado válido.'])->withInput();
        }

        // Validação de conflito de horário para o novo advogado
        if (!empty($agendamento->horario)) {
            $conflito = Agendamento::where('id', '!=', $agendamento->id)
                ->where('data', $agendamento->data)
                ->where('horario', $agendamento->horario)
                ->where('advogado_id', $novoAdvogado->id)
                ->where('status', '!=', 'cancelado')
                ->exists();

            if ($conflito) {
                return back()->withErrors(['advogado_id' => 'O advogado selecionado já possui um agendamento neste mesmo dia e horário.'])->withInput();
            }
        }

        $agendamento->update([
            'advogado_id' => $novoAdvogado->id,
            'sede' => $novoAdvogado->sede_padrao ?? $agendamento->sede,
        ]);

        return back()->with('sucesso', 'Advogado reatribuído com sucesso!');
    }
}
