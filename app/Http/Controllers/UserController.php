<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;

class UserController extends Controller
{
    public function index()
    {        
        $users = User::orderBy('id')->paginate(15);
        return view('pages.users.index', ['users' => $users]);
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
    public function store(StoreUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('pages.users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('pages.users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $update            = User::find($user->id);
        $update->name      = $request->name;
        $update->email     = $request->email;
        //$update->image     = $request->image;
        $update->save();

        return redirect('users')->with('status','Item edited successfully!')->with('class', 'alert-success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $user = User::findOrFail($user->id);
            $user->delete();
            $user->roles()->detach();
            return redirect('users')->with('status','Deleted successfully!')->with('class', 'alert-success');
        } catch (ModelNotFoundException $exception) {
            return redirect('users')->with('status','Not Founded!')->with('class', 'alert-danger');
        } catch (Exception $exception) {
            return redirect('users')->with('status','Error!')->with('class', 'alert-danger');
        }
    }
}
