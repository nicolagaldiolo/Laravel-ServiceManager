<?php

namespace App\Providers;

use App\Domain;
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
        Domain::observe(DomainObserver::class);
        Providers::observe(ProviderObserver::class);

        \View::composer(['layouts.app', 'dashboard.index'], function ($view){
            $domainsToPay = Auth()->user()->domains()->toPay()->orderBy('deadline')->get();
            $domainsToPayCount = $domainsToPay->count();
            return $view->with('domainsToPay', $domainsToPay)
                ->with('domainsToPayCount', $domainsToPayCount);
        });

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
