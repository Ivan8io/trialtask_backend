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


Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::apiResource('tariffs', 'TariffsController')->except(['show', 'destroy']);
    Route::apiResource('residents', 'ResidentsController')->except(['show']);

    Route::post('/pump-meters', 'PumpMetersController@store');
    Route::get('/pump-meters/get-last-month-record', 'PumpMetersController@getLastMonthRecord');

});
