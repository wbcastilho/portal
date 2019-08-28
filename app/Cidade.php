<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    protected $fillable = [
        'nome', 'estado_id'
    ];

    //Retorna o estado relacionado com a tabela estados
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }
}
