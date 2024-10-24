<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class PaymentController extends Controller
{
    public function checkout(Request $request)
    {
    // Configura a API Key do Stripe
    \Stripe\Stripe::setApiKey(env('STRIPE_SK'));

    // Recebe o valor do formulário e converte para inteiro (em cêntimos)
    $amount = (int) $request->input('amount');

    // Cria uma nova sessão de checkout
    $checkout_session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                    'name' => 'Bilhete de Concerto',
                ],
                'unit_amount' => $amount, // Valor em cêntimos
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => route('checkout.success'),
        'cancel_url' => route('checkout.cancel'),
    ]);

    // Retorna a URL de checkout criada pelo Stripe
    return redirect()->away($checkout_session->url);
    }
}
