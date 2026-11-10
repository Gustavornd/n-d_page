<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agendamento extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'servico_id',
        'sede',
        'advogado_id',
        'data',
        'horario',
        'mensagem',
        'status',
    ];

    public function servico()
    {
        return $this->belongsTo(Servico::class);
    }

    public function advogado()
    {
        return $this->belongsTo(User::class, 'advogado_id');
    }

    public function getNomeSedeAttribute(): string
    {
        return match ($this->sede) {
            'montes_claros' => 'Montes Claros – MG',
            default => 'Capitão Enéas – MG',
        };
    }

    public function getEnderecoSedeAttribute(): string
    {
        return match ($this->sede) {
            'montes_claros' => 'Rua Ismael Duarte, 376, Vila Campos, Montes Claros - MG, CEP: 39403-056',
            default => 'Avenida Presidente Costa e Silva, 346 - Centro, Capitão Enéas - MG, CEP: 39472-000',
        };
    }

    public function payloadNotificacao(): array
    {
        return [
            'cliente_nome' => $this->nome,
            'cliente_telefone' => $this->telefone,
            'cliente_email' => $this->email,
            'data' => $this->data ? date('d/m/Y', strtotime($this->data)) : '',
            'horario' => $this->horario,
            'servico' => $this->servico?->titulo ?? 'Atendimento Jurídico',
            'advogado_nome' => $this->advogado?->name ?? 'Advogado Designado',
            'sede_nome' => $this->nome_sede,
            'sede_endereco' => $this->endereco_sede,
        ];
    }
}
