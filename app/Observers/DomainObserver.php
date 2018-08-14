<?php

namespace App\Observers;

use App\Domains;
use App\Jobs\GenerateDomainsScreenshoot;
use File;

class DomainObserver
{

    /**
     * Handle to the domains "creating" event.
     *
     * @param  \App\Domains  $domains
     * @return void
     */
    public function creating(Domains $domains)
    {
        //
    }

    /**
     * Handle to the domains "created" event.
     *
     * @param  \App\Domains  $domains
     * @return void
     */
    public function created(Domains $domains)
    {
        // Chiamo il job
        GenerateDomainsScreenshoot::dispatch($domains);
    }

    /**
     * Handle the domains "updated" event.
     *
     * @param  \App\Domains  $domains
     * @return void
     */

    public function updated(Domains $domains)
    {
        //
    }

    public function deleting(Domains $domains)
    {
        //
    }

    /**
     * Handle the domains "deleted" event.
     *
     * @param  \App\Domains  $domains
     * @return void
     */
    public function deleted(Domains $domains)
    {
        if(File::exists(public_path($domains->screenshoot))) File::delete(public_path($domains->screenshoot));
    }
}
