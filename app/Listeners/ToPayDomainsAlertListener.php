<?php

namespace App\Listeners;

use App\User;
use App\Events\ToPayDomainsAlert;
use App\Jobs\ToPayDomains;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ToPayDomainsAlertListener
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
     * @param  ToPayDomainsAlert  $event
     * @return void
     */
    public function handle(ToPayDomainsAlert $event)
    {
        User::domainsExpiring()->each(function($item){
            ToPayDomains::dispatch($item);
        });
    }
}
