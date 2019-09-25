<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Localizacao4 extends Model
{
    use SoftDeletes; 

    protected $table = 'localizacoes4';

    protected $fillable = [
        'nome', 'localizacao3_id', 'praca_id'
    ];

    public function localizacao3()
    {
      return $this->belongsTo('App\Localizacao3');
    }

    public function localizacao_equipamentos()
    {
      return $this->hasMany('App\LocalizacaoEquipamentos');
    }
}
