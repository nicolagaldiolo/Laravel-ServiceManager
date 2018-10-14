<?php

namespace App\Providers;

use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Service'       => 'App\Policies\ServicesPolicy',
        'App\ServiceType'   => 'App\Policies\ServiceTypesPolicy',
        'App\Provider'      => 'App\Policies\ProvidersPolicy',
        'App\Customer'      => 'App\Policies\CustomerPolicy',
        'App\User'          => 'App\Policies\UserPolicy',
        'App\Renewal'       => 'App\Policies\RenewalsPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Gate::define('delete-all-customers', function(User $user, $ids){
        //    return count(array_intersect($ids, $user->customers()->pluck('id')->toArray() )) == count($ids);
        //});

    }
}
