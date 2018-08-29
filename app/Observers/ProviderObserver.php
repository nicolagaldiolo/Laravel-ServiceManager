<?php

namespace App\Observers;

use App\Events\GenerateScreen;
use App\Providers;
use File;

class ProviderObserver
{

    /**
     * Handle to the domains "creating" event.
     *
     * @param  \App\Domain  $domains
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
        //event(new GenerateScreen($providers));
    }

    /**
     * Handle the providers "updated" event.
     *
     * @param  \App\Providers  $providers
     * @return void
     */
    public function updated(Providers $providers)
    {
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
