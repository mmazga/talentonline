<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
});

Route::group(['middleware' => 'is_auth'], function() {
    Route::group(['prefix' => 'product'], function () {
        Route::get('/', 'ProductController@index');
        Route::get('/{id}', 'ProductController@edit');
        Route::put('/{id}', 'ProductController@update');
        Route::delete('/{id}', 'ProductController@destroy');
        Route::post('/', 'ProductController@store');
    });

    Route::group(['prefix' => 'address'], function () {
        Route::get('/', 'AddressController@index');
        Route::put('/{id}', 'AddressController@update');
        Route::get('/{id}', 'AddressController@edit');
        Route::delete('/{id}', 'AddressController@destroy');
        Route::post('/', 'AddressController@store');
    });

    Route::group(['prefix' => 'order'], function () {
        Route::post('/', 'OrderController@store');
        Route::get('/', 'OrderController@index');
        Route::delete('cancel/{id}', 'OrderController@cancelOrder');
    });
});


