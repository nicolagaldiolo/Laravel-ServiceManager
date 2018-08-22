<?php

namespace App\Providers;

use App\Domains;
use App\Providers;
use App\User;
use App\Observers\UserObserver;
use App\Observers\DomainObserver;
use App\Observers\ProviderObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Domains::observe(DomainObserver::class);
        Providers::observe(ProviderObserver::class);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
