<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvitationRequest;
use App\Http\Requests\UpdateInvitationRequest;

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
}
