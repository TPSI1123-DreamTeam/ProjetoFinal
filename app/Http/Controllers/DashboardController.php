<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Payment;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $payments = Payment::where('user_id', $user->id)->get();  // Histórico de pagamentos

        return view('dashboard')->with([
            'user' => $user,
            'payments' => $payments,
        ]);
    }
}


