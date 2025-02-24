<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tipo extends Model
{
    use SoftDeletes;    

    protected $fillable = [
        'nome'
    ];

    protected $dates = ['deleted_at'];

    public function modelo()
    {
      return $this->hasMany('App\Modelo');
    }
}
