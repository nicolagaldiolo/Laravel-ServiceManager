<?php

namespace App\Listeners;

use App\User;
use App\Events\ToPayServicesAlert;
use App\Jobs\ToPayServices;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ToPayServicesAlertListener
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
     * @param  ToPayServicesAlert  $event
     * @return void
     */
    public function handle(ToPayServicesAlert $event)
    {
        User::servicesExpiring()->get()->each(function($item){
            ToPayServices::dispatch($item);
        });
    }
}
