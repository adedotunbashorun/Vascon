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

Route::prefix('showtime')->group(function() {
    Route::get('/', 'ShowtimeController@index')->name('showtime');
    Route::get('/get-details', 'ShowtimeController@edit')->name('showtime.editInfo');
    Route::put('/update', 'ShowtimeController@update')->name('showtime.update');
    Route::get('/delete/{id?}', 'ShowtimeController@destroy')->name('showtime.delete');
    Route::post('/store', 'ShowtimeController@store')->name('showtime.store');
});
