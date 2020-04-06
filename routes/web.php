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

Route::get('/welcome', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/patientDetails', function() {
    return view('patientDetails');
})->name('patient-details');

Route::get('/userDetails', function() {
    return "yolo";
})->name('user-details');

Route::get('/', 'HomeController@index')->name('home');

Route::get('/debug-sentry', function () {
    throw new Exception('My first Sentry error!');
});

Route::post('image-upload', 'ImageUploadController@store')->name('image.upload.post');