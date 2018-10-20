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
    Route::delete('customers/delete/all', 'CustomerController@destroyAll')->name('customers.destroy-all');

    // Services
    Route::resource('services', 'ServicesController');
    Route::delete('services/delete/all', 'ServicesController@destroyAll')->name('services.destroy-all');


    // ServiceRenewals
    Route::group(
        [
            'middleware' => ['onlyAjax']
        ], function(){
        Route::resource('services.renewals', 'ServiceRenewalsController')->except('index', 'show');
        Route::patch('services/{service}/renewals/{renewal}/{transition}', 'ServiceRenewalsController@transition')->name('services.renewals.transition');
        Route::delete('services/{service}/renewals/delete/all', 'ServiceRenewalsController@destroyAll')->name('services.renewals.destroy-all');
    });

    // ServiceTypes
    Route::resource('service-types', 'ServiceTypesController')->except('show');
    Route::delete('service-types/delete/all', 'ServiceTypesController@destroyAll')->name('service-types.destroy-all');

    // RenewalFrequencies
    Route::resource('renewal-frequencies', 'RenewalFrequencyController')->except('show');
    Route::delete('renewal-frequencies/delete/all', 'RenewalFrequencyController@destroyAll')->name('renewal-frequencies.destroy-all');

    // Providers
    Route::resource('providers', 'ProvidersController');
    Route::delete('providers/delete/all', 'ProvidersController@destroyAll')->name('providers.destroy-all');

    // Users
    Route::resource('users', 'UserController')->except('show');
    Route::patch('/users/{user}/avatar', 'UserAvatarController@update')->name('users.avatar.update');
    Route::get('/users/{user}/changepassword', 'Auth\ChangePasswordController@edit')->name('change.password');
    Route::post('/users/{user}/updatepassword', 'Auth\ChangePasswordController@update')->name('update.password');
    Route::delete('users/delete/all', 'UserController@destroyAll')->name('users.destroy-all');
});
