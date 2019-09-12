<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Localizacao1 extends Model
{
    use SoftDeletes; 

    protected $table = 'localizacoes1';

    protected $fillable = [
        'nome', 'estado_id', 'cidade_id', 'praca_id'
    ];

    protected $dates = ['deleted_at'];

    public function estado()
    {
      return $this->belongsTo('App\Estado');
    }

    public function cidade()
    {
      return $this->belongsTo('App\Cidade');
    }

    public function praca()
    {
      return $this->belongsTo('App\Praca');
    }   

    public function localizacao2()
    {
      return $this->hasMany('App\Localizacao2');
    }
}
