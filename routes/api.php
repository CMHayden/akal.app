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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/calendar', 'CalendarController')->middleware('auth:api');

Route::apiResource('/temperature', 'TemperatureController')->middleware('auth:api');
Route::post('/temperature/updateTemperatures', 'TemperatureController@updateTemperatures')->middleware('auth:api');

Route::get('/weather/{lat},{long}', "WeatherController@index");

Route::get('/patientdetails', 'PatientDetailsController@index')->middleware('auth:api');

Route::get('/alert/{temp}', 'NotificationController@alertTemperature')->middleware('auth:api');