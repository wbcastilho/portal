<?php

namespace App\Observers;

use App\Tipo;
use App\Log;

class TipoObserver
{
    /**
     * Handle the tipo "created" event.
     *
     * @param  \App\Tipo  $tipo
     * @return void
     */
    public function created(Tipo $tipo)
    {
        $log = Log::create([
            'acao' => 'Create', 
            'model' => 'Tipos',  
            'model_id' => $tipo->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }

    /**
     * Handle the tipo "updated" event.
     *
     * @param  \App\Tipo  $tipo
     * @return void
     */
    public function updated(Tipo $tipo)
    {
        $log = Log::create([
            'acao' => 'Update', 
            'model' => 'Tipos',  
            'model_id' => $tipo->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }

    /**
     * Handle the tipo "deleted" event.
     *
     * @param  \App\Tipo  $tipo
     * @return void
     */
    public function deleted(Tipo $tipo)
    {
        $log = Log::create([
            'acao' => 'Delete', 
            'model' => 'Tipos',  
            'model_id' => $tipo->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }

    /**
     * Handle the tipo "restored" event.
     *
     * @param  \App\Tipo  $tipo
     * @return void
     */
    public function restored(Tipo $tipo)
    {
        $log = Log::create([
            'acao' => 'Restore', 
            'model' => 'Tipos',  
            'model_id' => $tipo->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }

    /**
     * Handle the tipo "force deleted" event.
     *
     * @param  \App\Tipo  $tipo
     * @return void
     */
    public function forceDeleted(Tipo $tipo)
    {
        $log = Log::create([
            'acao' => 'Force Delete', 
            'model' => 'Tipos',  
            'model_id' => $tipo->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }
}
