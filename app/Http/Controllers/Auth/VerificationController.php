<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class VerificationController extends Controller
{
    public function notice()
    {
        return view('auth.verify-email');
    }

    public function verify(Request $request, $id, $hash)
    {
        // Vérifier la signature de l'URL
        if (!URL::hasValidSignature($request)) {
            return redirect()->route('login')->with('error', 'Lien de vérification invalide ou expiré.');
        }

        $user = User::findOrFail($id);

        // Vérifier que le hash correspond à l'email de l'utilisateur
        if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            return redirect()->route('login')->with('error', 'Lien de vérification invalide.');
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('login')->with('success', 'Votre email est déjà vérifié. Vous pouvez vous connecter.');
        }

        $user->markEmailAsVerified();
        event(new \Illuminate\Auth\Events\Verified($user));

        // Connecter l'utilisateur automatiquement après vérification
        Auth::login($user);

        return redirect()->route('home')->with('success', 'Email vérifié avec succès ! Vous êtes connecté.');
    }

    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('home');
        }

        $request->user()->sendEmailVerificationNotification();
        return back()->with('success', 'Un nouveau lien de vérification a été envoyé à votre adresse email.');
    }
}
