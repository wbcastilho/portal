<?php

namespace App\Observers;

use App\Localizacao1;
use App\Log;

class Localizacao1Observer
{
    /**
     * Handle the localizacao1 "created" event.
     *
     * @param  \App\Localizacao1  $localizacao1
     * @return void
     */
    public function created(Localizacao1 $localizacao1)
    {
        $log = Log::create([
            'acao' => 'Create', 
            'model' => 'Localização 1',  
            'model_id' => $localizacao1->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }

    /**
     * Handle the localizacao1 "updated" event.
     *
     * @param  \App\Localizacao1  $localizacao1
     * @return void
     */
    public function updated(Localizacao1 $localizacao1)
    {
        $log = Log::create([
            'acao' => 'Update', 
            'model' => 'Localização 1',  
            'model_id' => $localizacao1->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }

    /**
     * Handle the localizacao1 "deleted" event.
     *
     * @param  \App\Localizacao1  $localizacao1
     * @return void
     */
    public function deleted(Localizacao1 $localizacao1)
    {
        $log = Log::create([
            'acao' => 'Delete', 
            'model' => 'Localização 1',  
            'model_id' => $localizacao1->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }

    /**
     * Handle the localizacao1 "restored" event.
     *
     * @param  \App\Localizacao1  $localizacao1
     * @return void
     */
    public function restored(Localizacao1 $localizacao1)
    {
        $log = Log::create([
            'acao' => 'Restore', 
            'model' => 'Localização 1',  
            'model_id' => $localizacao1->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }

    /**
     * Handle the localizacao1 "force deleted" event.
     *
     * @param  \App\Localizacao1  $localizacao1
     * @return void
     */
    public function forceDeleted(Localizacao1 $localizacao1)
    {
        $log = Log::create([
            'acao' => 'Force Delete', 
            'model' => 'Localização 1',  
            'model_id' => $localizacao1->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }
}
