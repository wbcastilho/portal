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
      return $this->belongsTo('App\Modelo');     
    }

    public function setor()
    {
      return $this->belongsTo('App\Setor');
    }

    public function praca()
    {
      return $this->belongsTo('App\Praca');
    }
}
