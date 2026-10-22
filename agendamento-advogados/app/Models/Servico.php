<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Servico extends Model
{
    use HasFactory;
    protected $fillable = ['titulo', 'ativa'];

    public function agendamentos(){
        return $this->hasMany(Agendamento::class);
    }
}
