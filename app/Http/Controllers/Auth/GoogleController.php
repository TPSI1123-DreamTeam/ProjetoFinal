<?php

namespace App\Http\Controllers\Auth;

use Google\Client as GoogleClient;
use Google\Service\PeopleService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback()
    {
        // Get user information from Google
        $user = Socialite::driver('google')->stateless()->user();

        // Check if the user exists in your database
        $existingUser = User::where('google_id', $user->id)->first();

        if ($existingUser) {
            // Log in the existing user
            auth()->login($existingUser);
        } else {
            // Create a new user
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'google_id' => $user->id,
                'password'=> 12345678,
            ]);

            // Log in the new user
            auth()->login($newUser);
        }

        return redirect()->route('user.dob');
    }
    public function showDobForm()
    {
        return view('auth.dob'); // meter a view aqui gil
    }

    public function storeDob(Request $request)
    {
        // Validate the date of birth input
        $request->validate([
            'date_of_birth' => 'required|date',
        ]);

        // Get the logged-in user
        $user = Auth::user();
        dd($user);
        // Update the user's date of birth
        $user->date_of_birth = $request->input('date_of_birth');
        $user->save();

        return redirect()->intended('dashboard');
    }
}
