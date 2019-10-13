<?php

namespace App\Observers;

use App\Equipamento;
use App\Log;

class EquipamentoObserver
{
    /**
     * Handle the equipamento "created" event.
     *
     * @param  \App\Equipamento  $equipamento
     * @return void
     */
    public function created(Equipamento $equipamento)
    {
        $log = Log::create([
            'acao' => 'Create', 
            'model' => 'Equipamentos',  
            'model_id' => $equipamento->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }

    /**
     * Handle the equipamento "updated" event.
     *
     * @param  \App\Equipamento  $equipamento
     * @return void
     */
    public function updated(Equipamento $equipamento)
    {
        $log = Log::create([
            'acao' => 'Update', 
            'model' => 'Equipamentos',  
            'model_id' => $equipamento->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }

    /**
     * Handle the equipamento "deleted" event.
     *
     * @param  \App\Equipamento  $equipamento
     * @return void
     */
    public function deleted(Equipamento $equipamento)
    {
        $log = Log::create([
            'acao' => 'Delete', 
            'model' => 'Equipamentos',  
            'model_id' => $equipamento->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }

    /**
     * Handle the equipamento "restored" event.
     *
     * @param  \App\Equipamento  $equipamento
     * @return void
     */
    public function restored(Equipamento $equipamento)
    {
        $log = Log::create([
            'acao' => 'Restore', 
            'model' => 'Equipamentos',  
            'model_id' => $equipamento->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }

    /**
     * Handle the equipamento "force deleted" event.
     *
     * @param  \App\Equipamento  $equipamento
     * @return void
     */
    public function forceDeleted(Equipamento $equipamento)
    {
        $log = Log::create([
            'acao' => 'Force Delete', 
            'model' => 'Equipamentos',  
            'model_id' => $equipamento->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }
}
