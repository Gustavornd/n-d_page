<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servico;
use App\Models\Expediente;

class ServicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $servicos = Servico::orderBy('titulo')->get();
        $expedientes = Expediente::all();
        return view('servicos.index', compact('servicos','expedientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('servicos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dados = $request -> validate([
            'titulo' => 'required|string|max:255',
            'ativa' => 'boolean'
        ]);

        $dados['ativa'] = $request->has('ativa');

        Servico::create($dados);

        return redirect() -> route ('servicos.index') -> with('sucesso', 'Serviço criado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Servico $servico)
    {
        return view('servicos.edit', compact('servico'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Servico $servico)
    {
        $dados = $request -> validate([
            'titulo' => 'required|string|max:255',
            'ativa' => 'boolean'
        ]);

        $dados['ativa'] = $request -> has('ativa');

        $servico -> update($dados);

        return redirect()->route('servicos.index')->with('sucesso', 'Serviço atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Servico $servico)
    {
        try{
            $servico -> delete();
            return redirect()->route('servicos.index')->with('sucesso','Serviço removido com sucesso');
        }
        catch(\Illuminate\Database\QueryException $e){
            if ($e->getCode()==23000){
                return redirect()->route('servicos.index')->with('erro','Este serviço não pode ser excluído pois já possui agendamentos vinculados. Recomendamos apenas desmarcar a opção "Ativo".');
            }
            throw $e;
        }
        
    }

    public function storeExpedientes(Request $request)
    {
        // Limpa a tabela para substituir pelos novos horários selecionados
        Expediente::truncate();

        if ($request->has('dias')) {
            foreach ($request->dias as $dia => $dados) {
                // Salva apenas se o checkbox foi marcado e as horas preenchidas
                if (isset($dados['ativo']) && !empty($dados['inicio']) && !empty($dados['fim'])) {
                    Expediente::create([
                        'dia_semana' => $dia,
                        'inicio' => $dados['inicio'],
                        'fim' => $dados['fim'],
                    ]);
                }
            }
        }

        return back()->with('sucesso', 'Horários de expediente atualizados com sucesso!');
    }

}
