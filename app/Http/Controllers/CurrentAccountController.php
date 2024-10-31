<?php

namespace App\Http\Controllers;

use App\Models\CurrentAccount;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCurrentAccountRequest;
use App\Http\Requests\UpdateCurrentAccountRequest;

class CurrentAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCurrentAccountRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CurrentAccount $currentAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CurrentAccount $currentAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCurrentAccountRequest $request, CurrentAccount $currentAccount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CurrentAccount $currentAccount)
    {
        //
    }
}
