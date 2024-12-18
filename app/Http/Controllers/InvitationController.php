<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvitationRequest;
use App\Http\Requests\UpdateInvitationRequest;
use Illuminate\Http\Request;
use App\Mail\InvitationMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\Attachment;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Event;


class InvitationController extends Controller
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
        $trueId = 0; 

        return view('pages.invitations.index', ['participants' => null, 'invitation' => null, 'events' => $events, 'trueId' => $trueId]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Invitation $invitation, $trueId)
    {

        $event  = Event::findOrFail($trueId);
        $trueId = $event->id;

        return view('pages.invitations.create',['invitation' => $invitation, 'trueId' => $trueId]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvitationRequest $request)
    {
        $event = Event::findOrFail($request->input('trueId'));

            $invitation = Invitation::create([
                'title'           => $request->title,
                'body'            => $request->body,
                'date'            => $request->date,
                'place'           => $request->place,
                'event_id'        => $request->trueId,
                ]);

            if ($request->hasFile('image')) {

                $file = $request->file('image');
                $imageName = time() . '.' . $file->extension();
                $file->move(public_path('images\invitations'), $imageName); 
                $directory = public_path('images\invitations') . DIRECTORY_SEPARATOR . $imageName;
                $invitation->image = $imageName;
            }

            $invitation->image = $directory;
            $event->invitation()->save($invitation); 

        return redirect('invitations')->with('status','Convite adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invitation $invitation)
    {
        return view('pages.invitations.show', ['invitation' => $invitation]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invitation $invitation)
    {
        return view('pages.invitations.edit', ['invitation' => $invitation]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvitationRequest $request, Invitation $invitation)
    {
        $invitation->update($request->all());
        return redirect('invitations')->with('status','Convite editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invitation $invitation)
    {
        $invitation->delete();
        return redirect('invitations')->with('status','Convite removido com sucesso!');
    }

    public function eliminate(Invitation $invitation)
    {
        Invitation::whereNotNull('id')->delete();
        return redirect('invitations')->with('status','Todos os convites apagados!');
    }


    public function pageSendEmail(Invitation $invitation)
    {
        return view('pages.invitations.email', ['invitation' => $invitation]);
    }

    public function submit(Request $request, $eventId)
    {        
        $invitation = $request->invitation;
        $trueId     = $request->event;

        $event      = Event::findOrFail($trueId);
        $invitation = Invitation::findOrFail($invitation);


        $existingParticipants = $event->users->map(function ($user) {
            return [
                'nome'        => strtolower(trim($user->name)),
                'telefone'    => strtolower(trim($user->phone)),
                'email'       => strtolower(trim($user->email)),
                'confirmação' => strtolower(trim($user->pivot->confirmation)),
            ];
        });

        $emailUsers = $existingParticipants->pluck('email')->toArray();
        $emailTest  = array_splice($emailUsers, 0, 3);

        foreach ($emailTest as $key => $email) {
            Mail::to('primetimeventstpsip@gmail.com')->send(new InvitationMail($invitation));
        }

        return redirect('invitations')->with('success', 'Convite Enviado!');
    }


    public function findEventInvitation(Request $request)
    {
        if ($request->search == "Escolha o evento para listar participantes...") {
            return redirect()->back();
        }

        $ownerId = Auth::user()->id;
        $query   = Event::query();

        $query->where('owner_id',$ownerId);

        $events       = $query->with(['users', 'invitation'])->get();
        $participants = Event::find($request->search);
        $trueId       = $participants->id;    

        // $trueId guarda o id do evento escolhido na pesquisa
        $queryI     = Invitation::query();
        $invitation = $queryI->where('event_id',$trueId)->first();

        if ($invitation != null) {
            return view('pages.invitations.index', ['invitation' => $invitation, 'participants' => $participants, 'events' => $events, 'trueId' => $trueId]);
        } else {
            return view('pages.invitations.index', ['invitation' => null, 'participants' => $participants, 'events' => $events, 'trueId' => $trueId]);
        }
    }
}