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

        $users = User::all();
        return view('pages.dashboard.admin', ['users' => $users]);
     }

     public function ManagerDashboard()
     {
         // Lista de eventos para gestão e ações específicas para manager
        $user      = Auth::user();
        $events    = Event::all();
        $suppliers = Supplier::all();

        return view('pages.dashboard.manager')->with([
            'user'      => $user,
            'events'    => $events,
            'suppliers' => $suppliers,
        ]);

     }

     public function OwnerDashboard()
     {
         // Lista de participantes e eventos com permissões completas para o proprietário do evento
        $user      = Auth::user();
        $events    = Event::all();
        $suppliers = Supplier::all();
        $payments  = Payment::all(); 
        
        // Histórico e gestão de pagamentos
        return view('pages.dashboard.owner')->with([
            'user'      => $user,          
            'events'    => $events,
            'suppliers' => $suppliers,
            'payments'  => $payments,
        ]);

     }

    public function ParticipantDashboard()
    {
        $user = Auth::user();
        return view('pages.dashboard.participant')->with([
            'user' => $user,       
        ]);
    }
}


