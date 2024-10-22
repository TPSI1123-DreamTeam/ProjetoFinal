<?php

use Illuminate\Support\Facades\Route;

Route::get('/success', function () {
    return 'Pagamento realizado com sucesso!';
});

Route::get('/cancel', function () {
    return 'O pagamento foi cancelado.';
});
