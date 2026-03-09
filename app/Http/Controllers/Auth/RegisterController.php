<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Jobs\VerifyEmailJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'min:3', 'max:30', 'unique:users,username', 'regex:/^[a-zA-Z0-9_]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)->max(24)->mixedCase()->numbers()],
            'date_naissance' => ['required', 'date', 'before:-16 years'],
            'terms' => ['accepted'],
        ], [
            'username.regex' => 'Le nom d\'utilisateur ne peut contenir que des lettres, chiffres et underscores.',
            'date_naissance.before' => 'Vous devez avoir au moins 16 ans pour vous inscrire.',
            'password.min' => 'Le mot de passe doit contenir entre 8 et 24 caractères.',
        ]);

        $user = User::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'date_naissance' => $validated['date_naissance'],
        ]);
        
        // Envoyer l'email de confirmation (cosmétique)
        $user->sendEmailVerificationNotification();
        
        // Dispatch le job pour vérifier l'email après 10 secondes (après la réponse HTTP)
        VerifyEmailJob::dispatchAfterResponse($user->id);

        return redirect()->route('login')->with('success', 'Inscription réussie ! Un email de confirmation vous a été envoyé.');
    }
}
