<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipamento extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'apelido', 'numeroserie', 'patrimonio', 'descricao', 'modelo_id', 'setor_id', 'praca_id'
    ];

    protected $dates = ['deleted_at'];

    public function modelo()
    {
      return $this->belongsTo('App\Modelo')->withTrashed();     
    }

    public function setor()
    {
      return $this->belongsTo('App\Setor')->withTrashed(); 
    }

    public function praca()
    {
      return $this->belongsTo('App\Praca')->withTrashed(); 
    }

    public function localizacao_equipamentos()
    {
      return $this->hasMany('App\LocalizacaoEquipamentos');
    }

    public function estado()
    {
        return $this->hasManyThrough('App\Estado', 'App\LocalizacaoEquipamentos');
    }

    /*public function estados()
    {
         return $this->belongsToMany('App\Estado', 'localizacao_equipamentos', 'equipamento_id', 'estado_id');
    }

    public function cidades()
    {
         return $this->belongsToMany('App\Cidade', 'localizacao_equipamentos', 'equipamento_id', 'cidade_id');
    }

    public function localizacoes1()
    {
         return $this->belongsToMany('App\Localizacao1', 'localizacao_equipamentos', 'equipamento_id', 'localizacao1_id');
    }

    public function localizacoes2()
    {
         return $this->belongsToMany('App\Localizacao2', 'localizacao_equipamentos', 'equipamento_id', 'localizacao2_id');
    }

    public function localizacoes3()
    {
         return $this->belongsToMany('App\Localizacao3', 'localizacao_equipamentos', 'equipamento_id', 'localizacao3_id');
    }

    public function localizacoes4()
    {
         return $this->belongsToMany('App\Localizacao4', 'localizacao_equipamentos', 'equipamento_id', 'localizacao4_id');
    }*/
}
