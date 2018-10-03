<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use SM\Event\SMEvents;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */

    protected $listen = [
        'App\Events\UserRegister' => [
            'App\Listeners\UserRegisterListener'
        ],
        'App\Events\GenerateScreen' => [
            'App\Listeners\GenerateScreenListener'
        ],
        'App\Events\CheckServiceStatus' => [
            'App\Listeners\CheckServiceStatusListener',
        ],
        'App\Events\ToPayDomainsAlert' => [
            'App\Listeners\ToPayDomainsAlertListener',
        ],
        SMEvents::POST_TRANSITION => [
            'App\Listeners\StateHistoryManager@postTransition'
        ]

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
