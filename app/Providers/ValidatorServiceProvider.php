<?php namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;

class ValidatorServiceProvider extends ServiceProvider {

    public function boot()
    {
        $this->app['validator']->extend('passwordCheck', function ($attribute, $value, $parameters)
        {
            if ((Hash::check($value, Auth::user()->password))) {
                return true;
            }
            return false;
        });
    }

    public function register()
    {
        //
    }
}