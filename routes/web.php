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

    // Services
    Route::resource('services', 'ServicesController');

    // ServiceRenewals
    Route::group(
        [
            'middleware' => ['onlyAjax']
        ], function(){
            Route::resource('services.renewals', 'ServiceRenewalsController')->except('index', 'show');
            Route::patch('services/{service}/renewals/{renewal}/{transition}', 'ServiceRenewalsController@transition')->name('services.renewals.transition');
    });

    // ServiceTypes
    Route::resource('service-types', 'ServiceTypesController')->except('show');

    // Providers
    Route::resource('providers', 'ProvidersController');

    // Users
    Route::resource('users', 'UserController')->except('show');
    //Route::get('users/delete-users', 'UserController@destroyAll')->name('users.destroy-all');
    Route::get('users/delete-users', 'UserController@destroyAll')->name('users.destroy-all');
    Route::patch('/users/{user}/avatar', 'UserAvatarController@update')->name('users.avatar.update');
    Route::get('/users/{user}/changepassword', 'Auth\ChangePasswordController@edit')->name('change.password');
    Route::post('/users/{user}/updatepassword', 'Auth\ChangePasswordController@update')->name('update.password');
});
