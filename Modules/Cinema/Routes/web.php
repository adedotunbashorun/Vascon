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

Route::prefix('cinema')->group(function() {
    Route::get('/', 'CinemaController@index')->name('cinema');
    Route::get('/get-details', 'CinemaController@edit')->name('cinema.editInfo');
    Route::put('/update', 'CinemaController@update')->name('cinema.update');
    Route::get('/delete/{id?}', 'CinemaController@destroy')->name('cinema.delete');
    Route::post('/store', 'CinemaController@store')->name('cinema.store');
});
