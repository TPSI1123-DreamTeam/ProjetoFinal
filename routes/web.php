<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/success', function () {
    return 'Pagamento realizado com sucesso!';
});

Route::get('/cancel', function () {
    return 'O pagamento foi cancelado.';
});

Route::get('/login', function () {
    return view('login.login');
});

Route::get('/register', function (Request $request) {

    
    return view('register.register');
});

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
