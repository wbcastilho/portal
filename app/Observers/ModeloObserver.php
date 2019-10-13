<?php

namespace App\Observers;

use App\Modelo;
use App\Log;

class ModeloObserver
{
    /**
     * Handle the modelo "created" event.
     *
     * @param  \App\Modelo  $modelo
     * @return void
     */
    public function created(Modelo $modelo)
    {
        $log = Log::create([
            'acao' => 'Create', 
            'model' => 'Modelos',  
            'model_id' => $modelo->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }

    /**
     * Handle the modelo "updated" event.
     *
     * @param  \App\Modelo  $modelo
     * @return void
     */
    public function updated(Modelo $modelo)
    {
        $log = Log::create([
            'acao' => 'Update', 
            'model' => 'Modelos',  
            'model_id' => $modelo->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }

    /**
     * Handle the modelo "deleted" event.
     *
     * @param  \App\Modelo  $modelo
     * @return void
     */
    public function deleted(Modelo $modelo)
    {
        $log = Log::create([
            'acao' => 'Delete', 
            'model' => 'Modelos',  
            'model_id' => $modelo->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }

    /**
     * Handle the modelo "restored" event.
     *
     * @param  \App\Modelo  $modelo
     * @return void
     */
    public function restored(Modelo $modelo)
    {
        $log = Log::create([
            'acao' => 'Restore', 
            'model' => 'Modelos',  
            'model_id' => $modelo->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }

    /**
     * Handle the modelo "force deleted" event.
     *
     * @param  \App\Modelo  $modelo
     * @return void
     */
    public function forceDeleted(Modelo $modelo)
    {
        $log = Log::create([
            'acao' => 'Force Delete', 
            'model' => 'Modelos',  
            'model_id' => $modelo->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }
}
