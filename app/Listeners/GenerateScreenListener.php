<?php

namespace App\Listeners;

use App\Events\GenerateScreen;
use App\Jobs\GetScreenshoot;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GenerateScreenListener
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
     * @param  GenerateScreen  $event
     * @return void
     */
    public function handle(GenerateScreen $event)
    {
        GetScreenshoot::dispatch($event->object);
    }
}