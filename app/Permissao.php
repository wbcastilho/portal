<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permissao extends Model
{
    protected $table = 'permissoes';

    protected $fillable = [
        'nome', 'descricao'
    ];

    public function niveis()
    {
         return $this->belongsToMany('App\Nivel', 'nivel_permissoes', 'permissao_id', 'nivel_id');
    }
}
