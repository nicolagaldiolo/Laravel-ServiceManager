<?php

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

if (! function_exists('redirect_user_lang')) {
    function redirect_user_lang($locale, $redirectUrl)
    {
        $path = route($redirectUrl);
        if(array_key_exists($locale,LaravelLocalization::getSupportedLocales())){
            //\Illuminate\Support\Facades\App::setLocale($locale);
            $path = LaravelLocalization::getLocalizedURL($locale, route($redirectUrl));
        }

        return $path;
    }
}

if (! function_exists('amount_format')) {
    function amount_format($money, $currency = true)
    {
        $currency = ($currency) ? "€ " : '';
        return $currency . number_format($money, 2, ',', '.');
    }
}


