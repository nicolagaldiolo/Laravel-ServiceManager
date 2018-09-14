<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('login/{provider}',          'Auth\SocialAccountController@redirectToProvider')->name('social.login');
Route::get('login/{provider}/callback', 'Auth\SocialAccountController@handleProviderCallback')->name('social.login.callback');

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ], function() {

    // Dashboard
    Route::get('/', 'DashboardController@index')->name('dashboard');

    // Customers
    Route::resource('customers', 'CustomerController');

    // Domains
    Route::resource('domains', 'DomainsController')->except('show');
    Route::patch('/domains/{domain}/payed', 'DomainsController@payedUpdate')->name('domains.payed.update');

    // Providers
    Route::resource('providers', 'ProvidersController')->except('show');

    // Users
    Route::resource('users', 'UserController')->except('show');
    Route::patch('/users/{user}/avatar', 'UserAvatarController@update')->name('users.avatar.update');
    Route::get('/users/{user}/changepassword', 'Auth\ChangePasswordController@edit')->name('change.password');
    Route::post('/users/{user}/updatepassword', 'Auth\ChangePasswordController@update')->name('update.password');
});
