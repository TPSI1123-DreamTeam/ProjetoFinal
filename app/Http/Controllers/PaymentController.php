<?php
namespace App\Http\Controllers;

use Log;
use Stripe\Stripe;
use App\Models\User;
use App\Models\Event;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\Checkout\Session as StripeSession;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PaymentsExport;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function list()
    {

        $user      = auth()->user();
        $payments  = Payment::where('user_id', $user->id)->paginate(10);
        $allEvents = Payment::where('user_id', $user->id)->paginate(10);

        return view('pages.payments.index', ['payments' => $payments, 'user' => $user, 'allEvents' => $allEvents]);
    }

    public function checkout(Request $request, Event $event)
    {
        // API Key do Stripe
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        // event id and value to pay
        $user   = auth()->user();
        $event  = Event::findOrFail($event->id);
        $amount = $event->ticket_amount;

        // Change value in cents
        $amountCents = $amount * 100;

        // Create a new payment request
        $payment            = new Payment();
        $payment->stripe_id = 0;
        $payment->user_id   = $user->id;
        $payment->name      = $event->name;
        $payment->amount    = $event->ticket_amount;
        $payment->status    = false; // payment not yet completed
        $payment->date      = now();
        $payment->save();

        // NEW CHECKOUT SESSION
        try {
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
                'success_url' => route('success', ['payment' => $payment->id, 'session_id' => '{CHECKOUT_SESSION_ID}']),
                'cancel_url' => route('cancel')
            ]);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            // Captura o erro e regista
            \Log::error('Stripe Error: ' . $e->getMessage());
            return back()->withErrors('Erro no pagamento. Por favor, tente novamente.');
        }

        $paymentId = $request->input('payment');
        Payment::where('id', $payment->id)->update(['stripe_id' => $checkout_session->id]);


        // ASSOCIATE USER TO THE EVENT
        $usersToAssoc = User::find($user->id);
        $event->users()->attach($usersToAssoc);

        // CONFIRMATION OF ATTENDING THE EVENT
        DB::table('event_user')
            ->where('event_id', $event->id)
            ->where('user_id', $usersToAssoc->id)
            ->update([
                'confirmation' => true

        ]);

        return redirect($checkout_session->url);
    }


    public function success(Request $request)
    {
        // Obtém o ID do pagamento a partir da URL para armazenar o ID da sessão
        $paymentId = $request->input('payment');
        Payment::where('id', $paymentId)->update(['status' => true]);
        session()->flash('success', 'Pagamento efetuado com sucesso!');

        return view('welcome');
    }

    public function cancel(Request $request)
    {
        $paymentId = $request->input('payment');
        $payment = Payment::find($paymentId);
    
        if ($payment) {
            $eventId = DB::table('event_user')
                ->where('user_id', $payment->user_id)
                ->where('confirmation', true)
                ->value('event_id');
    
            if ($eventId) {
                // Desassociar o utilizador do evento
                DB::table('event_user')
                    ->where('event_id', $eventId)
                    ->where('user_id', $payment->user_id)
                    ->delete();
            }
    
            // Apagar o pagamento
            $payment->delete();
        }
    
        session()->flash('error', 'Pagamento cancelado e associação ao evento removida!');
        return redirect()->route('events.public');
    }

    public function searchPayments(Request $request)
    {
        $user      = auth()->user();
        $allEvents = Payment::where('user_id', $user->id)->paginate(10);
        $name      = $request->search;
        $startDate = $request->datepicker1;
        $endDate   = $request->datepicker2;

       if(($startDate == null && $endDate == null) && $name == null) {

            $paySearch = ['user_id' => $user->id];
            $payments = Payment::where($paySearch)->paginate(10);

            return view('pages.payments.index', ['payments' => $payments, 'user' => $user, 'allEvents' => $allEvents]);

        } elseif (($startDate == null && $endDate == null)) {

            $paySearch = ['user_id' => $user->id, 'name' => $name];
            $payments = Payment::where($paySearch)->paginate(10);

            return view('pages.payments.index', ['payments' => $payments, 'user' => $user, 'allEvents' => $allEvents]);

        } elseif (($startDate != null || $endDate != null) && $name != null) {

            if($startDate == null) {
                $paySearch = ['user_id' => $user->id, 'name' => $name, 'date' => $endDate];
            } else {
                $paySearch = ['user_id' => $user->id, 'name' => $name, 'date' => $startDate];
            }

            $payments = Payment::where($paySearch)->paginate(10);
            return view('pages.payments.index', ['payments' => $payments, 'user' => $user, 'allEvents' => $allEvents]);

        } elseif (($startDate != null || $endDate != null) && $name == null) {

            if($startDate == null) {
                $paySearch = ['user_id' => $user->id, 'date' => $endDate];
            } else {
                $paySearch = ['user_id' => $user->id, 'date' => $startDate];
            }

            $payments = Payment::where($paySearch)->paginate(10);
            return view('pages.payments.index', ['payments' => $payments, 'user' => $user, 'allEvents' => $allEvents]);
        }
    }

    public function downloadPaymentList(Request $request)
    {
        $AuthUser = Auth::user();
        if ($AuthUser->role_id === 4 || $AuthUser->role_id === 3) {

            // Obter os IDs dos pagamentos
            $paymentIdsArray = explode(',', $request->payment_ids);
            $payments = Payment::whereIn('id', $paymentIdsArray)->get();

            // Cabeçalhos do Excel
            $excelArray = [];
            $excelArray[0] = [
                "ID" => "ID",
                "Nome do Evento" => "Nome do Evento",
                "Preço" => "Preço",
                "Data" => "Data",
                "Estado" => "Estado"
            ];

            // Preenchendo os dados
            $key = 1;
            foreach ($payments as $payment) {
                $excelArray[$key] = [
                    "ID" => $payment->id,
                    "Nome do Evento" => $payment->name ?? 'Não definido',
                    "Preço" => number_format($payment->amount, 2, ',', '.') . ' €',
                    "Data" => date('Y-m-d H:i:s', strtotime($payment->date)),
                    "Estado" => $payment->status == 1 ? 'Pago' : 'Pendente'
                ];
                $key++;
            }

            // Fazer o download
            return Excel::download(new PaymentsExport($excelArray), 'PaymentsList.xlsx');
        }

        return redirect()->back()->with('error', 'Acesso negado.');
    }

    public function checkoutevent(Request $request, Event $event)
    {
        // API Key do Stripe
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        // event id and value to pay
        $user   = auth()->user();
        $event  = Event::findOrFail($event->id);
        $amount = $event->amount;

        // Change value in cents
        $amountCents = $amount * 100;

        // Create a new payment request
        $payment             = new Payment();
        $payment->stripe_id  = 0;
        $payment->user_id    = $user->id;
        $payment->name       = $event->name;
        $payment->amount     = $event->amount;
        $payment->status     = false;
        $payment->type       = 'event_payment';
        $payment->date       = now();
        $payment->created_at = now();
        $payment->save();

        // NEW CHECKOUT SESSION
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
                'mode'        => 'payment',
                'success_url' => route('successevent', ['payment' => $payment->id, 'session_id' => '{CHECKOUT_SESSION_ID}', 'event_id' => $event->id]),
                'cancel_url'  => route('checkout.cancel')
        ]);

        $paymentId = $request->input('payment');
        Payment::where('id', $payment->id)->update(['stripe_id' => $checkout_session->id]);

        DB::table('current_accounts')
            ->where('event_id', $event->id)
            ->update([
                'amount_paid' => $event->amount,
                'payment_id'  => $payment->id,
                'status'      => true,
                'updated_at'  => now()
        ]);

        return redirect($checkout_session->url);
    }

    public function successevent(Request $request)
    {
        $paymentId = $request->input('payment');
        $eventId   = $request->input('event_id');
        Payment::where('id', $paymentId)->update(['status' => true]);
        session()->flash('success', 'Pagamento efetuado com sucesso!');

        DB::table('events')
            ->where('id', $eventId)
            ->update([
                'event_status' => 'aprovado',
        ]);

        return redirect('/events/owner/'. $eventId.'/edit')->with('status','Pagamento realizado com sucesso!')->with('class', 'alert-success');
    }
}
