<?php

namespace App\Observers;

use App\Localizacao3;
use App\Log;

class Localizacao3Observer
{
    /**
     * Handle the localizacao3 "created" event.
     *
     * @param  \App\Localizacao3  $localizacao3
     * @return void
     */
    public function created(Localizacao3 $localizacao3)
    {
        $log = Log::create([
            'acao' => 'Create', 
            'model' => 'Localização 3',  
            'model_id' => $localizacao3->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }

    /**
     * Handle the localizacao3 "updated" event.
     *
     * @param  \App\Localizacao3  $localizacao3
     * @return void
     */
    public function updated(Localizacao3 $localizacao3)
    {
        $log = Log::create([
            'acao' => 'Update', 
            'model' => 'Localização 3',  
            'model_id' => $localizacao3->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }

    /**
     * Handle the localizacao3 "deleted" event.
     *
     * @param  \App\Localizacao3  $localizacao3
     * @return void
     */
    public function deleted(Localizacao3 $localizacao3)
    {
        $log = Log::create([
            'acao' => 'Delete', 
            'model' => 'Localização 3',  
            'model_id' => $localizacao3->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }

    /**
     * Handle the localizacao3 "restored" event.
     *
     * @param  \App\Localizacao3  $localizacao3
     * @return void
     */
    public function restored(Localizacao3 $localizacao3)
    {
        $log = Log::create([
            'acao' => 'Restore', 
            'model' => 'Localização 3',  
            'model_id' => $localizacao3->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }

    /**
     * Handle the localizacao3 "force deleted" event.
     *
     * @param  \App\Localizacao3  $localizacao3
     * @return void
     */
    public function forceDeleted(Localizacao3 $localizacao3)
    {
        $log = Log::create([
            'acao' => 'Force Delete', 
            'model' => 'Localização 3',  
            'model_id' => $localizacao3->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }
}
