<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    protected $table = 'niveis';

    protected $fillable = [
        'nome'
    ];

    public function users()
    {
      return $this->hasMany('App\User');
    }
}
