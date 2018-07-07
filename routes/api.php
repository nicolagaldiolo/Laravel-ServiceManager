<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::post('login', 'LoginController@Login')->name('login');
Route::get('me', 'MeController@Me')->name('me')->middleware('jwt.auth');
Route::resource('domains', 'DomainsController')->except('create', 'edit')->middleware('jwt.auth');
Route::resource('providers', 'ProvidersController')->except('create', 'edit')->middleware('jwt.auth');
