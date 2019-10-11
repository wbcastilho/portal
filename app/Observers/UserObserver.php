<?php

namespace App\Observers;

use App\User;
use App\Log;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $log = Log::create([
            'acao' => 'Create', 
            'model' => 'User', 
            'user_id' => $user->id                    
        ]);
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        $log = Log::create([
            'acao' => 'Update', 
            'model' => 'User', 
            'user_id' => $user->id                    
        ]);
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        $log = Log::create([
            'acao' => 'Delete', 
            'model' => 'User', 
            'user_id' => $user->id                    
        ]);
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        $log = Log::create([
            'acao' => 'Restore', 
            'model' => 'User', 
            'user_id' => $user->id                    
        ]);
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        $log = Log::create([
            'acao' => 'Force Delete', 
            'model' => 'User', 
            'user_id' => $user->id                    
        ]);
    }
}
