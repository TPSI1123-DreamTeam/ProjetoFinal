<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Payment;
use App\Models\Event;
use App\Models\Profile;
use App\Models\Participant;
use App\Models\Invitation;
use App\Models\Supplier;
use App\Models\Role;

use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{

    public function index()
    {
        switch (Auth::user()->role) 
        {
            case 'admin':
                return $this->AdminDashboard();
            case 'manager':
                return $this->ManagerDashboard();
            case 'owner':
                return $this->OwnerDashboard();
            default:
                return $this->UserDashboard();
        }
    }


     public function AdminDashboard()
     {
         $user = Auth::user();
         $payments = Payment::where('user_id', $user->id)->get();
         return view('pages.dashboard.admin')->with(['user' => $user, 'payments' => $payments]);
     }

     public function ManagerDashboard()
     {
         $user = Auth::user();
         $payments = Payment::where('user_id', $user->id)->get();
         return view('pages.dashboard.manager')->with(['user' => $user, 'payments' => $payments]);

     }

     public function OwnerDashboard()
     {
         $user = Auth::user();
         $payments = Payment::where('user_id', $user->id)->get();
         return view('pages.dashboard.owner')->with(['user' => $user, 'payments' => $payments]);

     }

    public function UserDashboard()
    {
        $user = Auth::user();
        $payments = Payment::where('user_id', $user->id)->get();
        return view('pages.dashboard.user')->with(['user' => $user, 'payments' => $payments]);
        
    }
}


