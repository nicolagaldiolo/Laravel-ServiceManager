<?php

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

if (! function_exists('redirect_user_lang')) {
    function redirect_user_lang($locale, $redirectUrl)
    {
        $path = array_key_exists($locale,LaravelLocalization::getSupportedLocales()) ?
            LaravelLocalization::getLocalizedURL($locale, route($redirectUrl)) :
            route($redirectUrl);

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


