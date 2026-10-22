<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agendamento extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'email','telefone', 'servico_id', 'data', 'horario', 'status'];

    public function servico()
    {
        return $this->belongsTo(Servico::class);
    }
}
