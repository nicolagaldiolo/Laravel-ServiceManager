<?php

namespace App\Observers;

use App\Domain;
use App\Events\CheckServiceStatus;
use App\Events\ExpiringDomainsWriteTable;
use App\Events\GenerateScreen;
use App\ExpiringDomain;
use Carbon\Carbon;
use File;

class DomainObserver
{

    /**
     * Handle to the domains "creating" event.
     *
     * @param  \App\Domain  $domains
     * @return void
     */
    public function creating(Domain $domains)
    {
        //
    }

    /**
     * Handle to the domains "created" event.
     *
     * @param  \App\Domain  $domains
     * @return void
     */
    public function created(Domain $domains)
    {

        //event(new GenerateScreen($domains));
        //event(new CheckServiceStatus($domains));
    }

    /**
     * Handle the domains "updated" event.
     *
     * @param  \App\Domain  $domains
     * @return void
     */

    public function updated(Domain $domains)
    {
        //
    }

    /**
     * Handle the domains "saving" event.
     *
     * @param  \App\Domain  $domains
     * @return void
     */

    public function saving(Domain $domains)
    {
        //
    }

    public function deleting(Domain $domains)
    {
        //
    }

    /**
     * Handle the domains "deleted" event.
     *
     * @param  \App\Domain  $domains
     * @return void
     */
    public function deleted(Domain $domains)
    {
        if(File::exists(public_path($domains->screenshoot))) File::delete(public_path($domains->screenshoot));
    }
}
