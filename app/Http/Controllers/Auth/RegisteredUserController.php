<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {   
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'birthdate' => ['required', 'date'],
        ]);
    
        // Verifica se a senha atende aos requisitos adicionais
        if (!preg_match('/[A-Z]/', $request->password) || 
        !preg_match('/[0-9]/', $request->password) || 
        !preg_match('/[\W_]/', $request->password) || 
        strlen($request->password) < 8) 
        {
        
            session()->flash('notification', [
                'type' => 'error',
                'message' => 'Requisitos da password não cumpridos. Tente novamente.',
            ]);
            return redirect()->back()->withInput();
        }

        $existingUser = User::where('email', $request->email)->first();

        if ($existingUser) {
            return redirect()
                ->route('login') 
                ->withInput(['email' => $request->email]) // Passar o email para a sessão
                ->with('error', 'Email já registado. Por favor, faça login ou utilize outro email para registo.');
        } else{
        

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'image' => 'noimageuser.png',
                'password' => Hash::make($request->password),
                'birthdate' => $request->birthdate,
            ]);
        
            $user->roles()->attach(3);

            event(new Registered($user));

            Auth::login($user);
        }


        return redirect(route('index', absolute: false))->with('success', 'Registo efetuado com sucesso! Bem-vindo(a) à PRIME TIME EVENTS!');
    
    }
}
