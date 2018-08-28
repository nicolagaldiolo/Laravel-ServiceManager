<?php

namespace App\Listeners;

use App\Events\CheckServiceStatus;
use App\Jobs\CheckService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CheckServiceStatusListener
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
     * @param  CheckServiceStatus  $event
     * @return void
     */
    public function handle(CheckServiceStatus $event)
    {
        CheckService::dispatch($event->domains);
    }
}
