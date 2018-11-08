<?php

namespace App\Providers;

use App\Service;
use App\Provider;
use App\User;
use App\Observers\UserObserver;
use App\Observers\DomainObserver;
use App\Observers\ProviderObserver;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Jenssegers\Date\Date;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
        Service::observe(DomainObserver::class);
        Provider::observe(ProviderObserver::class);

        \View::composer(['layouts.app', 'dashboard.index'], function ($view){
            $servicesToPay = Auth::user()->services()->has('renewalsUnresolved')->with('renewalsUnresolved')->get();
            $feesToPay = $servicesToPay->pluck('renewalsUnresolved')->collapse();

            return $view->with('servicesToPay', $servicesToPay)
                ->with('feesToPayCount', $feesToPay->count())
                ->with('feesToPayAmount', $feesToPay->sum('amount'))
                ->with('servicesToPayCount', $servicesToPay->count());
        });

        Validator::extend('unique_date_custom', function ($attribute, $value, $parameters)
        {
            // Get the parameters passed to the rule
            list($table, $field, $field2Value, $field2, $field3, $field3Value) = $parameters;
            $value = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');

            // Check the table and return true only if there are no entries matching
            // both the first field name and the user input value as well as
            // the second field name and the second field value

            $query = DB::table($table)->whereDate($field, $value);
            if($field2Value && $field2) $query->where($field2, '<>', $field2Value);
            if($field3 && $field3Value) $query->where($field3, $field3Value);
            return $query->count() == 0;
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
