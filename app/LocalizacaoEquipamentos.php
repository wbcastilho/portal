<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocalizacaoEquipamentos extends Model
{
    protected $table = 'localizacao_equipamentos';

    protected $fillable = [
        'data', 'observacao', 'user_id', 'equipamento_id', 'situacao_id', 'estado_id', 'cidade_id', 'localizacao1_id', 'localizacao2_id', 'localizacao3_id', 'localizacao4_id'
    ];

    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function equipamento()
    {
         return $this->belongsTo('App\Equipamento');
    }

    public function situacao()
    {
        return $this->belongsTo('App\Situacao');
    }

    public function estado()
    {
      return $this->belongsTo('App\Estado');
    }

    public function cidade()
    {
      return $this->belongsTo('App\Cidade');
    }

    public function localizacao1()
    {
      return $this->belongsTo('App\Localizacao1');
    }

    public function localizacao2()
    {
      return $this->belongsTo('App\Localizacao2');
    }

    public function localizacao3()
    {
      return $this->belongsTo('App\Localizacao3');
    }

    public function localizacao4()
    {
      return $this->belongsTo('App\Localizacao4');
    }
}
