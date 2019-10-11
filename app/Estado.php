<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $fillable = [
        'nome', 'uf'
    ];

    public function cidades()
    {
        return $this->hasMany('App\Cidade');
    }

    public function localizacao1()
    {
      return $this->hasMany('App\Localizacao1');
    }

    public function localizacao_equipamentos()
    {
      return $this->hasMany('App\LocalizacaoEquipamentos');
    }

    /*public function equipamentos()
    {
         return $this->belongsToMany('App\Equipamento', 'localizacao_equipamentos', 'estado_id', 'equipamento_id');
    }*/
}
