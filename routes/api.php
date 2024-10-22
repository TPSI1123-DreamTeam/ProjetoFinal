<?php

use App\Http\Controllers\Api\PaymentController;

Route::post('/checkout', [PaymentController::class, 'checkout']);