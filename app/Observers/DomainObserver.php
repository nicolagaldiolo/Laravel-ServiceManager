<?php

namespace App\Observers;

use App\Domains;
use Spatie\Browsershot\Browsershot;

class DomainObserver
{
    /**
     * Handle to the domains "created" event.
     *
     * @param  \App\Domains  $domains
     * @return void
     */
    public function created(Domains $domains)
    {
        //"Fit should be one of `contain`, `max`, `fill`, `stretch`, `crop`"

        //Browsershot::url($domains->url)->windowSize(1920, 1080)->fit('fill', 640, 480)->save(public_path() . '/storage/domains/' . $domains->id . '.png');
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
     * Handle the domains "deleted" event.
     *
     * @param  \App\Domains  $domains
     * @return void
     */
    public function deleted(Domains $domains)
    {
        //
    }
}
