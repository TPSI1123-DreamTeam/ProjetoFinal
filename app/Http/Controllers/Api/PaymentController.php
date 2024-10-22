<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class PaymentController extends Controller
{
    public function checkout(Request $request)
    {
        // Configura a API Key do Stripe
        Stripe::setApiKey(env('STRIPE_SK'));

        // Cria uma nova sessão de checkout
        $checkout_session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'Produto de Exemplo',
                    ],
                    'unit_amount' => 2000000, // 2000000 euros
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => env('APP_URL') . '/success',
            'cancel_url' => env('APP_URL') . '/cancel',
        ]);

        // Retorna a URL de checkout criada pelo Stripe
        return response()->json([
            'id' => $checkout_session->id,
            'checkout_url' => $checkout_session->url,
        ]);
    }

}
