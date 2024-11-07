<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvitationRequest;
use App\Http\Requests\UpdateInvitationRequest;
use Illuminate\Http\Request;
use App\Mail\InvitationMail;
use Illuminate\Support\Facades\Mail;

class InvitationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invitations = Invitation::orderBy('id')->paginate(15);
        return view('pages.invitations.index', ['invitations' => $invitations]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Invitation $invitation)
    {
        return view('pages.invitations.create',['invitation' => $invitation]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvitationRequest $request)
    {
        Invitation::create($request->all());

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

    public function submit(Request $request)
    {
        // Simulação de envio de Convite para os Participantes
        // variavél $messages contêm os campos do convite [Por agora o envio requer todos os campos, embora mais
        // tarde não irá ser necessário, visto que os campos são NULLABLE. Necessário inserir validações para
        // os campos que não têm dados!!]

        $messages = [
            'title.required' => 'Introduza um título!',
            'body.required' => 'Introduza descrição do convite!',
            'image.email' => 'Introduza uma imagem!',
            'date.email' => 'Introduza a data do evento!',
            'place.required' => 'Introduza o nome do local do evento!',
        ];

        // Capture and validate the data

        $validatedData = $request->validate([
            'title' => 'required|min:3|max:255',
           'body' => 'required|min:3|max:255',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif',
            'date' => 'required|min:3|max:255',
            'place' => 'required|min:3|max:255',
       ], $messages);

        // Process the data (e.g., validation, sending email)

        Mail::to('Vasco.Sousa.T0127548@edu.atec.pt')->send(new InvitationMail($validatedData));
        // Here you will handle the form submission, like validating input and sending emails.
        return redirect('invitations')->with('success', 'Convite Enviado!');
    }
}
