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
      return $this->belongsTo('App\Localizacao2');
    }

    public function localizacao4()
    {
      return $this->hasMany('App\Localizacao4');
    }

    public function localizacao_equipamentos()
    {
      return $this->hasMany('App\LocalizacaoEquipamentos');
    }
}
