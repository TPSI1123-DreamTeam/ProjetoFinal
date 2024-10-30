<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreParticipantRequest;
use App\Http\Requests\UpdateParticipantRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ParticipantsExport;
use App\Imports\ParticipantsImport;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $participants = Participant::orderBy('id')->paginate(15);
        return view('pages.participants.index', ['participants' => $participants]);
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
        return redirect('participants')->with('status','Apagou TUTO!');
    }

    // EXCEL FUNCTIONS  //

    public function export()
    {
        return Excel::download(new ParticipantsExport, 'participants.xlsx');
    }

    public function import()
    {
        Excel::import(new ParticipantsImport, request()->file('file'));

        return redirect('participants')->with('success', 'All good!');
    }
}
