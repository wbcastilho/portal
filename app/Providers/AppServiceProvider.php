<?php

namespace App\Providers;

use App\User;
use App\Setor;
use App\Fabricante;
use App\Tipo;
use App\Modelo;
use App\Localizacao1;
use App\Localizacao2;
use App\Localizacao3;
use App\Localizacao4;
use App\Equipamento;
use App\Observers\UserObserver;
use App\Observers\SetorObserver;
use App\Observers\FabricanteObserver;
use App\Observers\TipoObserver;
use App\Observers\ModeloObserver;
use App\Observers\Localizacao1Observer;
use App\Observers\Localizacao2Observer;
use App\Observers\Localizacao3Observer;
use App\Observers\Localizacao4Observer;
use App\Observers\EquipamentoObserver;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Illuminate\Support\Facades\Schema::defaultStringLength(191);
        User::observe(UserObserver::class);
        Setor::observe(SetorObserver::class);
        Fabricante::observe(FabricanteObserver::class);
        Tipo::observe(TipoObserver::class);
        Modelo::observe(ModeloObserver::class);
        Localizacao1::observe(Localizacao1Observer::class);
        Localizacao2::observe(Localizacao2Observer::class);
        Localizacao3::observe(Localizacao3Observer::class);
        Localizacao4::observe(Localizacao4Observer::class);
        Equipamento::observe(EquipamentoObserver::class);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
