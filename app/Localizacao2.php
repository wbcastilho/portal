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
      return $this->belongsTo('App\Localizacao1');
    }

    public function localizacao3()
    {
      return $this->hasMany('App\Localizacao3');
    }
}
