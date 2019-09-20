<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setor extends Model
{
    use SoftDeletes;

    protected $table = 'setores';

    protected $fillable = [
        'nome'
    ];

    protected $dates = ['deleted_at'];

    public function equipamento()
    {     
      return $this->hasMany('App\Equipamento');
    }
}
