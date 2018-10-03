<?php

namespace App\Observers;

use App\Events\GenerateScreen;
use App\Provider;
use File;

class ProviderObserver
{

    /**
     * Handle to the domains "creating" event.
     *
     * @param  \App\Service  $domains
     * @return void
     */
    public function creating(Provider $providers)
    {
        //
    }

    /**
     * Handle to the providers "created" event.
     *
     * @param  \App\Provider  $providers
     * @return void
     */
    public function created(Provider $providers)
    {
        //event(new GenerateScreen($providers));
    }

    /**
     * Handle the providers "updated" event.
     *
     * @param  \App\Provider  $providers
     * @return void
     */
    public function updated(Provider $providers)
    {
    }

    public function deleting(Provider $providers)
    {
        //
    }

    /**
     * Handle the providers "deleted" event.
     *
     * @param  \App\Provider  $providers
     * @return void
     */
    public function deleted(Provider $providers)
    {
        if(File::exists(public_path($providers->screenshoot))) File::delete(public_path($providers->screenshoot));
    }
}
