<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $fillable = [
        'nome', 'uf'
    ];

    public function cidades()
    {
        return $this->hasMany(Cidade::class);
    }
}
