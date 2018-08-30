<?php

namespace App\Listeners;

use App\Events\UserRegister;
use App\Jobs\UserRegisterAlert;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegisterListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserRegister  $event
     * @return void
     */
    public function handle(UserRegister $event)
    {

        User::admin()->each(function($admin) use($event){
            UserRegisterAlert::dispatch($admin, $event->user);
        });

    }
}
