<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcomeH');
});

Route::get('/participants', 'App\Http\Controllers\ParticipantController@index');
Route::get('/participants/create', 'App\Http\Controllers\ParticipantController@create');
Route::post('/participants', 'App\Http\Controllers\ParticipantController@store');
Route::get('/participants/{participant}', 'App\Http\Controllers\ParticipantController@show');
Route::get('/participants/{participant}/edit', 'App\Http\Controllers\ParticipantController@edit');
Route::put('/participants/{participant}', 'App\Http\Controllers\ParticipantController@update');
Route::delete('/participants/{participant}', 'App\Http\Controllers\ParticipantController@destroy');
Route::delete('/participants', 'App\Http\Controllers\ParticipantController@eliminate');
