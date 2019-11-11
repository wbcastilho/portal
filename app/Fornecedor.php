<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fornecedor extends Model
{
    use SoftDeletes;

    protected $table = 'fornecedores';
    
    protected $fillable = [
        'nome', 
        'ie', 
        'cnpj', 
        'estado_id', 
        'cidade_id', 
        'endereco', 
        'numero', 
        'bairro', 
        'telefone', 
        'celular', 
        'email', 
        'descricao'
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
}
