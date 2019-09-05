<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modelo extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nome', 'imagem', 'fabricantes_id', 'tipos_id'
    ];

    protected $dates = ['deleted_at'];

    public function fabricante()
    {
      return $this->belongsToMany('App\Fabricante');
    }

    public function tipo()
    {
      return $this->belongsToMany('App\Tipo');
    }
}
