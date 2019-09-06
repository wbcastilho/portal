<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modelo extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nome', 'imagem', 'fabricante_id', 'tipo_id'
    ];

    protected $dates = ['deleted_at'];


    public function fabricante()
    {
      return $this->belongsTo('App\Fabricante');     
    }

    public function tipo()
    {
      return $this->belongsTo('App\Tipo');
    }
}
