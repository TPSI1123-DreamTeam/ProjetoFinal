<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        try {
            
            $request->authenticate();
    
            $request->session()->regenerate();
    
            session()->flash('success', 'Login efetuado com sucesso!');
    
            return redirect()->intended(url('/event/public'));

        } catch (\Illuminate\Validation\ValidationException $e) {

            
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                // Email não registado
                session()->flash('error', 'O email fornecido não está registado. Por favor, registe-se.');
                return redirect()->route('login')->withInput($request->only('email'));
            }
        
                 // Palavra-passe incorreta
                session()->flash('error', 'A palavra-passe está incorreta. Por favor, tente novamente.');
                return redirect()->route('login')->withInput($request->only('email'));
            }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
