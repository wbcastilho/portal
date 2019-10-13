<?php

namespace App\Observers;

use App\Localizacao2;
use App\Log;

class Localizacao2Observer
{
    /**
     * Handle the localizacao2 "created" event.
     *
     * @param  \App\Localizacao2  $localizacao2
     * @return void
     */
    public function created(Localizacao2 $localizacao2)
    {
        $log = Log::create([
            'acao' => 'Create', 
            'model' => 'Localização 2',  
            'model_id' => $localizacao2->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }

    /**
     * Handle the localizacao2 "updated" event.
     *
     * @param  \App\Localizacao2  $localizacao2
     * @return void
     */
    public function updated(Localizacao2 $localizacao2)
    {
        $log = Log::create([
            'acao' => 'Update', 
            'model' => 'Localização 2',  
            'model_id' => $localizacao2->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }

    /**
     * Handle the localizacao2 "deleted" event.
     *
     * @param  \App\Localizacao2  $localizacao2
     * @return void
     */
    public function deleted(Localizacao2 $localizacao2)
    {
        $log = Log::create([
            'acao' => 'Delete', 
            'model' => 'Localização 2',  
            'model_id' => $localizacao2->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }

    /**
     * Handle the localizacao2 "restored" event.
     *
     * @param  \App\Localizacao2  $localizacao2
     * @return void
     */
    public function restored(Localizacao2 $localizacao2)
    {
        $log = Log::create([
            'acao' => 'Restore', 
            'model' => 'Localização 2',  
            'model_id' => $localizacao2->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }

    /**
     * Handle the localizacao2 "force deleted" event.
     *
     * @param  \App\Localizacao2  $localizacao2
     * @return void
     */
    public function forceDeleted(Localizacao2 $localizacao2)
    {
        $log = Log::create([
            'acao' => 'Force Delete', 
            'model' => 'Localização 2',  
            'model_id' => $localizacao2->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }
}
