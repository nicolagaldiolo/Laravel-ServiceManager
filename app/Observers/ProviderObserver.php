<?php

namespace App\Observers;

use App\Providers;
use Spatie\Browsershot\Browsershot;

class ProviderObserver
{
    /**
     * Handle to the providers "created" event.
     *
     * @param  \App\Providers  $providers
     * @return void
     */
    public function created(Providers $providers)
    {
        //Browsershot::url($providers->website)->windowSize(1920, 1080)->fit('fill', 640, 480)->save(public_path() . '/storage/providers/' . $providers->id . '.png');
    }

    /**
     * Handle the providers "updated" event.
     *
     * @param  \App\Providers  $providers
     * @return void
     */
    public function updated(Providers $providers)
    {
        //
    }

    /**
     * Handle the providers "deleted" event.
     *
     * @param  \App\Providers  $providers
     * @return void
     */
    public function deleted(Providers $providers)
    {
        //
    }
}
