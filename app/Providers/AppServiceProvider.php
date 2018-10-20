<?php

namespace App\Providers;

use App\Service;
use App\Provider;
use App\User;
use App\Observers\UserObserver;
use App\Observers\DomainObserver;
use App\Observers\ProviderObserver;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
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

        Blade::directive('amount', function ($arguments) {
            list($money, $currency) = array_pad(explode(',', str_replace(" ", '', $arguments), 2), 2, null);
            $currency = ($currency == null || filter_var($currency,FILTER_VALIDATE_BOOLEAN)) ? "'&euro; '" : "''";
            return "<?php echo $currency . number_format($money, 2, ',', '.'); ?>";
        });

        \View::composer(['layouts.app', 'dashboard.index'], function ($view){

            $servicesToPay = Auth::user()->services()->has('renewalsUnresolved')->with('renewalsUnresolved')->get();
            $feesToPay = $servicesToPay->pluck('renewalsUnresolved')->collapse();

            return $view->with('servicesToPay', $servicesToPay)
                ->with('feesToPayCount', $feesToPay->count())
                ->with('feesToPayAmount', $feesToPay->sum('amount'))
                ->with('servicesToPayCount', $servicesToPay->count());

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
