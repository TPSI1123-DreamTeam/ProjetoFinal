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
                        'name' => $event->name,
                    ],
                    'unit_amount' => $amountCents,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('checkout.success', ['session_id' => '{CHECKOUT_SESSION_ID}']),
            'cancel_url' => route('checkout.cancel')
        ]);

        // Armazena os dados do pagamento no banco de dados
        $payment = new Payment();
        $payment->stripe_id = $checkout_session->id;
        $payment->user_id = auth()->id();
        $payment->event_id = $event->id;
        $payment->name = $event->name;
        $payment->amount = $amount;
        $payment->status = false; // O pagamento ainda não foi confirmado
        $payment->date = now(); // Utiliza o método now() para obter a data atual
        $payment->save();

        // Redireciona para a página de pagamento do Stripe
        return redirect($checkout_session->url);
    }

    public function success(Request $request)
    {
        // Configura a API Key do Stripe
        \Stripe\Stripe::setApiKey(env('STRIPE_SK'));

        // Obtém o ID da sessão de checkout a partir da URL
        $sessionId = $request->input('session_id');

        try {
            // Recupera a sessão de checkout do Stripe
            $session = \Stripe\Checkout\Session::retrieve($sessionId);

            // Verifica o status do pagamento
            if ($session->payment_status === 'paid') {
                // Atualiza o status do pagamento no banco de dados
                $payment = Payment::where('stripe_id', $session->id)->first();

                if ($payment) {
                    $payment->status = true;
                    $payment->save();
                } else {
                    Log::warning('Pagamento não encontrado para a sessão: ' . $sessionId);
                }

                // Redireciona para a página de sucesso do checkout
                return redirect()->route('checkout.success')->with('message', 'Pagamento realizado com sucesso!');
            } else {
                // Redireciona para a página de cancelamento do checkout
                return redirect()->route('checkout.cancel')->with('error', 'Pagamento não foi realizado.');
            }
        } catch (\Exception $e) {
            // Trata erros durante a recuperação da sessão de checkout
            Log::error('Erro ao processar pagamento: ' . $e->getMessage());
            return redirect()->route('checkout.cancel')->with('error', 'Ocorreu um erro ao processar o pagamento.');
        }
    }
}
