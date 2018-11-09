<?php

namespace App\Observers;

use App\Service;
use App\Events\CheckServiceStatus;
use App\Events\GenerateScreen;
use File;

class DomainObserver
{

    /**
     * Handle to the domains "creating" event.
     *
     * @param  \App\Service  $domains
     * @return void
     */
    public function creating(Service $domains)
    {
        //
    }

    /**
     * Handle to the domains "created" event.
     *
     * @param  \App\Service  $domains
     * @return void
     */
    public function created(Service $domains)
    {
        event(new GenerateScreen($domains));
        event(new CheckServiceStatus($domains));
    }

    /**
     * Handle the domains "updated" event.
     *
     * @param  \App\Service  $domains
     * @return void
     */

    public function updated(Service $domains)
    {
        //
    }

    /**
     * Handle the domains "saving" event.
     *
     * @param  \App\Service  $domains
     * @return void
     */

    public function saving(Service $domains)
    {
        //
    }

    public function deleting(Service $domains)
    {
        //
    }

    /**
     * Handle the domains "deleted" event.
     *
     * @param  \App\Service  $domains
     * @return void
     */
    public function deleted(Service $domains)
    {
        if(File::exists(public_path($domains->screenshoot))) File::delete(public_path($domains->screenshoot));
    }
}
