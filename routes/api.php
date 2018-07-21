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


Route::post('register', 'AuthController@register')->name('register');
Route::post('recover', 'AuthController@recover')->name('recover');



Route::post('login', 'AuthController@login')->name('login');
Route::get('me', 'AuthController@me')->name('me')->middleware('jwt.auth');
Route::get('refresh', 'AuthController@refresh')->name('refresh')->middleware('jwt.refresh');
Route::get('logout', 'AuthController@logout')->name('logout')->middleware('jwt.auth');



Route::resource('domains', 'DomainsController')->except('create', 'edit')->middleware('jwt.auth');
Route::resource('providers', 'ProvidersController')->except('create', 'edit')->middleware('jwt.auth');
