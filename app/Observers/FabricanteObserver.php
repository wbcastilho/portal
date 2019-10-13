<?php

namespace App\Observers;

use App\Fabricante;
use App\Log;

class FabricanteObserver
{
    /**
     * Handle the fabricante "created" event.
     *
     * @param  \App\Fabricante  $fabricante
     * @return void
     */
    public function created(Fabricante $fabricante)
    {
        $log = Log::create([
            'acao' => 'Create', 
            'model' => 'Fabricantes',  
            'model_id' => $fabricante->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }

    /**
     * Handle the fabricante "updated" event.
     *
     * @param  \App\Fabricante  $fabricante
     * @return void
     */
    public function updated(Fabricante $fabricante)
    {
        $log = Log::create([
            'acao' => 'Update', 
            'model' => 'Fabricantes',  
            'model_id' => $fabricante->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }

    /**
     * Handle the fabricante "deleted" event.
     *
     * @param  \App\Fabricante  $fabricante
     * @return void
     */
    public function deleted(Fabricante $fabricante)
    {
        $log = Log::create([
            'acao' => 'Delete', 
            'model' => 'Fabricantes',  
            'model_id' => $fabricante->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }

    /**
     * Handle the fabricante "restored" event.
     *
     * @param  \App\Fabricante  $fabricante
     * @return void
     */
    public function restored(Fabricante $fabricante)
    {
        $log = Log::create([
            'acao' => 'Restore', 
            'model' => 'Fabricantes',  
            'model_id' => $fabricante->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }

    /**
     * Handle the fabricante "force deleted" event.
     *
     * @param  \App\Fabricante  $fabricante
     * @return void
     */
    public function forceDeleted(Fabricante $fabricante)
    {
        $log = Log::create([
            'acao' => 'Force Delete', 
            'model' => 'Fabricantes',  
            'model_id' => $fabricante->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }
}
