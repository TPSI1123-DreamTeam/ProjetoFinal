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

    public function index(User $user, Payment $payment, Event $event)
    {
        switch (Auth::user()->role) 
            {
                case 'admin':
                return $this->AdminDashboard();
                break;
                case 'manager':
                return $this->ManagerDashboard();
                break;
                case 'owner':
                return $this->OwnerDashboard();
                break;
                default:
                return $this->UserDashboard();
                break;
            }
    }   


     public function AdminDashboard()
     {
         $user = Auth::user();
         $payments = Payment::where('user_id', $user->id)->get();
         return view('pages.dashboard.user')->with(['user' => $user,'payments' => $payments,]);

     }

     public function ManagerDashboard()
     {
         $user = Auth::user();
         $payments = Payment::where('user_id', $user->id)->get();
         return view('pages.dashboard.user')->with(['user' => $user,'payments' => $payments,]);
     }

     public function OwnerDashboard()
     {
         $user = Auth::user();
         $payments = Payment::where('user_id', $user->id)->get();
         return view('pages.dashboard.user')->with(['user' => $user,'payments' => $payments,]);
     }

    public function UserDashboard()
    {
        $user = Auth::user();
        $payments = Payment::where('user_id', $user->id)->get();
        return view('pages.dashboard.user')->with(['user' => $user,'payments' => $payments,]);
    }
}


