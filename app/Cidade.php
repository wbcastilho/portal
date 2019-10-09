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
        return $this->belongsTo('App\Estado', 'estado_id');
    }

    public function localizacao1()
    {
      return $this->hasMany('App\Localizacao1');
    }

    public function equipamentos()
    {
         return $this->belongsToMany('App\Equipamento', 'localizacao_equipamentos', 'cidade_id', 'equipamento_id');
    }

    public function localizacao_equipamentos()
    {
      return $this->hasMany('App\LocalizacaoEquipamentos');
    }

}
