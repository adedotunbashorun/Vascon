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

Route::prefix('movies')->group(function() {
    Route::get('/', 'MoviesController@index')->name('movies');
    Route::get('/get-details', 'MoviesController@edit')->name('movies.editInfo');
    Route::put('/update', 'MoviesController@update')->name('movies.update');
    Route::get('/delete/{id?}', 'MoviesController@destroy')->name('movies.delete');
    Route::post('/store', 'MoviesController@store')->name('movies.store');
});
