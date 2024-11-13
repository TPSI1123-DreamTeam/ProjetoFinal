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
        $roles = Auth::user()->role_id; 

        switch($roles) 
        {  
            case 1:
                return $this->AdminDashboard();   
            case 2:
                return $this->ManagerDashboard();
            case 3:
                return $this->OwnerDashboard();        
            case 4:       
                return $this->ParticipantDashboard();
        }
    }


     public function AdminDashboard()
     {
        $user = Auth::user();
        $payments = "";
        return view('DashboardMaster.main')->with(['user' => $user, 'payments' => $payments]);
     }

     public function ManagerDashboard()
     {       
         $user = Auth::user();
         $payments = "";
         return view('DashboardMaster.main')->with(['user' => $user, 'payments' => $payments]);

     }

     public function OwnerDashboard()
     {
        $user = Auth::user();
        $payments = "";
        return view('DashboardMaster.main')->with(['user' => $user, 'payments' => $payments]);

     }

    public function ParticipantDashboard()
    {
        $user = Auth::user();
        $payments = "";
        return view('DashboardMaster.main')->with(['user' => $user, 'payments' => $payments]);
    }
}


