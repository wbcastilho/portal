<?php

namespace App\Observers;

use App\Setor;
use App\Log;

class SetorObserver
{
    /**
     * Handle the setor "created" event.
     *
     * @param  \App\Setor  $setor
     * @return void
     */
    public function created(Setor $setor)
    {
        $log = Log::create([
            'acao' => 'Create', 
            'model' => 'Setores',  
            'model_id' => $setor->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }

    /**
     * Handle the setor "updated" event.
     *
     * @param  \App\Setor  $setor
     * @return void
     */
    public function updated(Setor $setor)
    {
        $log = Log::create([
            'acao' => 'Update', 
            'model' => 'Setores',  
            'model_id' => $setor->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }

    /**
     * Handle the setor "deleted" event.
     *
     * @param  \App\Setor  $setor
     * @return void
     */
    public function deleted(Setor $setor)
    {
        $log = Log::create([
            'acao' => 'Delete', 
            'model' => 'Setores',  
            'model_id' => $setor->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }

    /**
     * Handle the setor "restored" event.
     *
     * @param  \App\Setor  $setor
     * @return void
     */
    public function restored(Setor $setor)
    {
        $log = Log::create([
            'acao' => 'Restore', 
            'model' => 'Setores',  
            'model_id' => $setor->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }

    /**
     * Handle the setor "force deleted" event.
     *
     * @param  \App\Setor  $setor
     * @return void
     */
    public function forceDeleted(Setor $setor)
    {
        $log = Log::create([
            'acao' => 'Force Delete', 
            'model' => 'Setores',  
            'model_id' => $setor->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }
}
