<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Rota para o método checkout do PaymentController
Route::get('/checkout', [PaymentController::class, 'checkout']);

Route::get('/checkout/success', function () {
    return 'Pagamento efetuado com sucesso!';
})->name('checkout.success');

Route::get('/checkout/cancel', function () {
    return 'Pagamento cancelado!';
})->name('checkout.cancel');

Route::get('/checkoutest', function () {
    return view('checkoutest');
})->name('checkoutest');


// Rota para o método checkout do PaymentController


///// ::::: LOGIN :::::: ///////
Route::get('/login', function () {
    return view('login.login');
});

Route::get('/register', function (Request $request) {
    return view('register.register');
});

///// ::::: LOGIN :::::: ///////

Route::get('/admin', function () {
    return view('admin');
})->middleware(['auth', 'verified'])->name('admin');

Route::get('/users', function () {
    return view('users');
})->middleware(['auth', 'verified'])->name('users');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


///// ::::: PARTICIPANTS :::::: ///////

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
