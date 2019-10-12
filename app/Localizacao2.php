<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Localizacao2 extends Model
{
    use SoftDeletes; 

    protected $table = 'localizacoes2';

    protected $fillable = [
        'nome', 'localizacao1_id', 'praca_id'
    ];

    public function localizacao1()
    {
      return $this->belongsTo('App\Localizacao1')->withTrashed();
    }

    public function localizacao3()
    {
      return $this->hasMany('App\Localizacao3');
    }

    public function equipamentos()
    {
         return $this->belongsToMany('App\Equipamento', 'localizacao_equipamentos', 'localizacao2_id', 'equipamento_id');
    }

    public function localizacao_equipamentos()
    {
      return $this->hasMany('App\LocalizacaoEquipamentos');
    }
}
