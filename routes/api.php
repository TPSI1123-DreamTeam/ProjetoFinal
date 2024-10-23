<?php

use App\Http\Controllers\PaymentController;

Route::post('/checkout', [PaymentController::class, 'checkout']);