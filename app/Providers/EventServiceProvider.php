<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

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
        'App\Events\ExpiringDomainsAlert' => [
            'App\Listeners\ExpiringDomainsAlertListener',
        ],

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
