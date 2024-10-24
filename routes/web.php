<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

Route::get('/quimbarreiros', function () {
    return view('quim_barreiros');
})->name('quimbarreiros');


// Rota para o método checkout do PaymentController

Route::get('/checkout', [PaymentController::class, 'checkout']);

Route::get('/checkout/success', function () {
    return 'Pagamento efetuado com sucesso!';
})->name('checkout.success');

Route::get('/checkout/cancel', function () {
    return 'Pagamento cancelado!';
})->name('checkout.cancel');


