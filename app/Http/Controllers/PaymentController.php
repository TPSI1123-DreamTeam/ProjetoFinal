<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use App\Http\Controllers\EventController;
use App\Models\Event;

class PaymentController extends Controller
{
    public function checkout(Request $request, Event $event)
    {
    // Configura a API Key do Stripe
    \Stripe\Stripe::setApiKey(env('STRIPE_SK'));

    // Obtém o ID do evento e o valor do pagamento
    $event = Event::findOrFail($event->id);
    $amount = $event->amount;

    // Converte o valor para cêntimos
    $amountCents = $amount * 100;

    // Cria uma nova sessão de checkout
    $checkout_session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                    'name' => $event->name, // Utiliza o nome do evento
                ],
                'unit_amount' => $amountCents, // Valor em cêntimos
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
