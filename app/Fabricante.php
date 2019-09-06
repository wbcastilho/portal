<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fabricante extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'nome', 'site', 'telefone'
    ];

    protected $dates = ['deleted_at'];

    public function modelo()
    {     
      return $this->hasMany('App\Modelo');
    }
}
