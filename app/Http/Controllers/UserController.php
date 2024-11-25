<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id')->paginate(5);
        return view('pages.users.index', ['users' => $users]);
    }

    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role_id' => 'required|integer|in:1,2,3,4'
        ]);

        $user = User::findOrFail($id);
        $user->role_id = $request->input('role_id');
        $user->save();

        return redirect()->back()->with('status', 'Função atualizada com sucesso!')->with('class', 'alert-success');
    }

    public function resetPassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|min:8',
        ]);

        $user = User::find($id);

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('status', 'Password atualizada com sucesso!')->with('class', 'alert-success');
    }

}
