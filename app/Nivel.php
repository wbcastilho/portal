<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    protected $table = 'niveis';

    protected $fillable = [
        'nome', 'descricao'
    ];

    public function users()
    {
      return $this->hasMany('App\User');
    }

    public function permissoes()
    {
         return $this->belongsToMany('App\Permissao', 'nivel_permissoes', 'nivel_id', 'permissao_id');
    }

    public function adicionaPermissao($permissao)
    {
        if (is_string($permissao)) {
            $permissao = Permissao::where('nome','=',$permissao)->firstOrFail();
        }

        if($this->existePermissao($permissao)){
            return false;
        }

      $this->permissoes()->attach($permissao);

      return true;
    }
    
    public function existePermissao($permissao)
    {
        if (is_string($permissao)) {
            $permissao = Permissao::where('nome','=',$permissao)->firstOrFail();
        }

        return (boolean) $this->permissoes()->find($permissao->id);
    }

    /*public function removePermissao($permissao)
    {
        if (is_string($permissao)) {
            $permissao = Permissao::where('nome','=',$permissao)->firstOrFail();
        }

        return $this->permissoes()->detach($permissao);
    }*/

    public function removePermissao($permissao_id)
    {       
        return $this->permissoes()->detach($permissao_id);
    }
}
