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
}
