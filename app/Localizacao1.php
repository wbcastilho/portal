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
      return $this->belongsTo('App\Praca')->withTrashed(); 
    }   

    public function localizacao2()
    {
      return $this->hasMany('App\Localizacao2');
    }

    /*public function equipamentos()
    {
         return $this->belongsToMany('App\Equipamento', 'localizacao_equipamentos', 'localizacao1_id', 'equipamento_id');
    }*/

    public function localizacao_equipamentos()
    {
      return $this->hasMany('App\LocalizacaoEquipamentos');
    }
}
