<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreParticipantRequest;
use App\Http\Requests\UpdateParticipantRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ParticipantsExport;
use App\Imports\ParticipantsImport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ownerId = Auth::user()->id;

        $query   = Event::query();
        $query->where('owner_id',$ownerId);
        $events = $query->get();

        return view('pages.participants.index', ['participants' => null, 'events' => $events]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Participant $participant)
    {
        return view('pages.participants.create',['participant' => $participant]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreParticipantRequest $request)
    {
       // $this->validate($request, [
         //   'name'  => 'required',
          //  'phone'  => 'required',
        //    'confirmation'  => 'required'
      //  ]);

        Participant::create($request->all());

        return redirect('participants')->with('status','Participante adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Participant $participant)
    {
        return view('pages.participants.show', ['participant' => $participant]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Participant $participant)
    {
        return view('pages.participants.edit', ['participant' => $participant]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateParticipantRequest $request, Participant $participant)
    {
        $participant->update($request->all());
        return redirect('participants')->with('status','Participante editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Participant $participant)
    {
        $participant->delete();
        return redirect('participants')->with('status','Participante removido com sucesso!');
    }

    public function eliminate(Participant $participant)
    {
        Participant::whereNotNull('id')->delete();
        return redirect('participants')->with('status','Todas os participantes foram Removidos!');
    }

    // EXCEL FUNCTIONS  //

    public function export(Request $request)
    {
        $url = $request->server('PATH_INFO'); // Encontra o número após a última barra
        if (preg_match('/\/(\d+)$/', $url, $matches)) {
            $number = (int) $matches[1];
            //echo $number;
        }


        $participants = Event::find($number);


       // dd($participants->users);
        return Excel::download(new ParticipantsExport($number), 'participants.xlsx');
    }

    public function import()
    {
        Excel::import(new ParticipantsImport, request()->file('file'));

        return redirect('participants')->with('success', 'All good!');
    }


    public function searchEvents(Request $request)
    {
        $ownerId = Auth::user()->id;
        $query   = Event::query();
        $query->where('owner_id',$ownerId);
        $events = $query->get();

        $participants = Event::find($request->search);

        return view('pages.participants.index', ['participants' => $participants, 'events' => $events]);

    }
}
