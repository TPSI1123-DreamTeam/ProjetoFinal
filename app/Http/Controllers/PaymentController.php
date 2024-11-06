<?php
namespace App\Http\Controllers;

use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Payment;
use Log;

class PaymentController extends Controller
{
    public function checkout(Request $request, Event $event)
    {
        // Configura a API Key do Stripe
        \Stripe\Stripe::setApiKey(env('STRIPE_TEST_SK'));

        // Obtém o ID do evento e o valor do pagamento
        $event = Event::findOrFail($event->id);
        $amount = $event->amount;

        // Converte o valor para cêntimos
        $amountCents = $amount * 100;

        $payment = new Payment();
        $payment->stripe_id = 0;
        $payment->user_id = auth()->id();
        $payment->event_id = $event->id;
        $payment->name = $event->name;
        $payment->amount = $event->amount;
        $payment->status = false; // O pagamento ainda foi confirmado
        $payment->date = now(); // Utiliza o método now() para obter a data atual
        $payment->save();
        
        // Cria uma nova sessão de checkout
        $checkout_session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $event->name,
                    ],
                    'unit_amount' => $amountCents,
                ],
                'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('success', ['session_id' => '{CHECKOUT_SESSION_ID}', 'payment' => $payment->id]),
            'cancel_url' => route('checkout.cancel')
        ]);
        // dd($checkout_session);
        // Redireciona para a página de pagamento do Stripe
        //$paymentId = $request->input('payment');
        Payment::where('id', $payment->id)->update(['stripe_id' => $checkout_session->id]);

        return redirect($checkout_session->url);

    }

    
    public function success(Request $request)
    {
        // Obtém o ID do pagamento a partir da URL
        $paymentId = $request->input('payment');
        Payment::where('id', $paymentId)->update(['status' => true]);
        return redirect()->route('dashboard')->with('message', 'Pagamento realizado com sucesso!');
        
    }
    
}
