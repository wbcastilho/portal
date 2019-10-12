<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Localizacao3 extends Model
{
    use SoftDeletes; 

    protected $table = 'localizacoes3';

    protected $fillable = [
        'nome', 'localizacao2_id', 'praca_id'
    ];

    public function localizacao2()
    {
      return $this->belongsTo('App\Localizacao2')->withTrashed(); 
    }

    public function localizacao4()
    {
      return $this->hasMany('App\Localizacao4');
    }

    public function equipamentos()
    {
         return $this->belongsToMany('App\Equipamento', 'localizacao_equipamentos', 'localizacao3_id', 'equipamento_id');
    }

    public function localizacao_equipamentos()
    {
      return $this->hasMany('App\LocalizacaoEquipamentos');
    }
}
