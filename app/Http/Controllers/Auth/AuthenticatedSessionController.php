<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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
    
            // Regenera a sessão para segurança
            $request->session()->regenerate();
    
            // Adiciona mensagem de sucesso à sessão
            session()->flash('success', 'Login efetuado com sucesso!');
    
            // Redireciona para a página desejada
            return redirect()->intended(url('/event/public'));

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Adiciona mensagem de erro à sessão
            session()->flash('error', 'Credenciais inválidas. Por favor, tente novamente.');
    
            // Redireciona de volta para a página de login
            return redirect()->route('login')->withErrors([
                'email' => trans('auth.failed'),
            ]);
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
