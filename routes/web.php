<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcomeH');
});

Route::get('/participants', 'App\Http\Controllers\ParticipantController@index');
Route::get('/participants/create', 'App\Http\Controllers\ParticipantController@create');
Route::post('/participants', 'App\Http\Controllers\ParticipantController@store');

Route::get('participants/export', 'App\Http\Controllers\ParticipantController@export');

Route::get('participants', 'App\Http\Controllers\ParticipantController@index')->name('participants.index');
Route::post('participants/import', 'App\Http\Controllers\ParticipantController@import')->name('participants.import');


Route::get('/participants/{participant}', 'App\Http\Controllers\ParticipantController@show');
Route::get('/participants/{participant}/edit', 'App\Http\Controllers\ParticipantController@edit');
Route::put('/participants/{participant}', 'App\Http\Controllers\ParticipantController@update');
Route::delete('/participants/{participant}', 'App\Http\Controllers\ParticipantController@destroy');
Route::delete('/participants', 'App\Http\Controllers\ParticipantController@eliminate');

//EXCEL ROUTES


