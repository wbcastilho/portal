<?php

namespace App\Observers;

use App\Localizacao4;
use App\Log;

class Localizacao4Observer
{
    /**
     * Handle the localizacao4 "created" event.
     *
     * @param  \App\Localizacao4  $localizacao4
     * @return void
     */
    public function created(Localizacao4 $localizacao4)
    {
        $log = Log::create([
            'acao' => 'Create', 
            'model' => 'Localização 4',  
            'model_id' => $localizacao4->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }

    /**
     * Handle the localizacao4 "updated" event.
     *
     * @param  \App\Localizacao4  $localizacao4
     * @return void
     */
    public function updated(Localizacao4 $localizacao4)
    {
        $log = Log::create([
            'acao' => 'Update', 
            'model' => 'Localização 4',  
            'model_id' => $localizacao4->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }

    /**
     * Handle the localizacao4 "deleted" event.
     *
     * @param  \App\Localizacao4  $localizacao4
     * @return void
     */
    public function deleted(Localizacao4 $localizacao4)
    {
        $log = Log::create([
            'acao' => 'Delete', 
            'model' => 'Localização 4',  
            'model_id' => $localizacao4->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }

    /**
     * Handle the localizacao4 "restored" event.
     *
     * @param  \App\Localizacao4  $localizacao4
     * @return void
     */
    public function restored(Localizacao4 $localizacao4)
    {
        $log = Log::create([
            'acao' => 'Restore', 
            'model' => 'Localização 4',  
            'model_id' => $localizacao4->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }

    /**
     * Handle the localizacao4 "force deleted" event.
     *
     * @param  \App\Localizacao4  $localizacao4
     * @return void
     */
    public function forceDeleted(Localizacao4 $localizacao4)
    {
        $log = Log::create([
            'acao' => 'Force Delete', 
            'model' => 'Localização 4',  
            'model_id' => $localizacao4->id,             
            'user_id' => auth()->user()->id                   
        ]);
    }
}
