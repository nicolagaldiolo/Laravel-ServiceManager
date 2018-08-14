<?php

namespace App\Observers;

use App\Providers;
use App\Jobs\GenerateProvidersScreenshoot;
use File;

class ProviderObserver
{

    /**
     * Handle to the domains "creating" event.
     *
     * @param  \App\Domains  $domains
     * @return void
     */
    public function creating(Providers $providers)
    {
        //
    }

    /**
     * Handle to the providers "created" event.
     *
     * @param  \App\Providers  $providers
     * @return void
     */
    public function created(Providers $providers)
    {
        // Chiamo il job
        GenerateProvidersScreenshoot::dispatch($providers);
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

    public function deleting(Providers $providers)
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
        if(File::exists(public_path($providers->screenshoot))) File::delete(public_path($providers->screenshoot));
    }
}
