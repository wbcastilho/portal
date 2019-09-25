<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Situacao extends Model
{
    protected $table = 'situacoes';

    protected $fillable = [
        'nome', 'site', 'telefone'
    ];

    public function localizacao_equipamentos()
    {
      return $this->hasMany('App\LocalizacaoEquipamentos');
    }
}
