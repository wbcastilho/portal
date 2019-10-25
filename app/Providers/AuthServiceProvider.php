<?php

namespace App\Providers;
use App\Permissao;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [              
        
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /*Gate::define('ver-setores', function ($user) {
            return $user->nivel_id == 2;
        }); */

        foreach ($this->listaPermissoes() as $permissao) {
            Gate::define($permissao->nome,function($user) use($permissao){ 
              if($user->nivel_id == 1)
              {
                return $user->nivel_id == 1;
              }
              else
              {            
                foreach($permissao->niveis as $nivel)
                {
                  return $user->nivel_id == $nivel->id;
                }
              }
            });
          }
    }

    public function listaPermissoes()
    {
      return Permissao::with('niveis')->get();
    }
}
