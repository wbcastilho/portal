<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Praca extends Model
{
    protected $fillable = [
        'nome'
    ];

    public function users()
    {
      return $this->hasMany('App\User');
    }

    public function localizacao1()
    {
      return $this->hasMany('App\Localizacao1');
    }
}
