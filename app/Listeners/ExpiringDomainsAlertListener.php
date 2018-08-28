<?php

namespace App\Listeners;

use App\User;
use App\Events\ExpiringDomainsAlert;
use App\Jobs\ExpiringDomains;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ExpiringDomainsAlertListener
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
     * @param  ExpiringDomainsAlert  $event
     * @return void
     */
    public function handle(ExpiringDomainsAlert $event)
    {
        User::domainsExpiring()->get()
            ->each(function($item){
                ExpiringDomains::dispatch($item);
            });
    }
}
