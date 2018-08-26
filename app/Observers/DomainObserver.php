<?php

namespace App\Observers;

use App\Domains;
use App\Events\GenerateScreen;
use Carbon\Carbon;
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
        event(new GenerateScreen($domains));
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

    /**
     * Handle the domains "saving" event.
     *
     * @param  \App\Domains  $domains
     * @return void
     */

    public function saving(Domains $domains)
    {
        if( $domains->deadline->lte(Carbon::now()->endOfMonth()) && $domains->payed == 1){
            $years_gab = Carbon::now()->endOfMonth()->diffInYears($domains->deadline->endOfMonth());
            $domains->deadline = $domains->deadline->addYear($years_gab + 1);
        }
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
