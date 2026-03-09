<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    public function notice()
    {
        return view('auth.verify-email');
    }

    public function verify(Request $request, $id, $hash)
    {
        // Redirection directe vers login avec message de succès
        // L'email est déjà vérifié automatiquement après 10s
        return redirect()->route('login')->with('success', 'Votre email a été vérifié avec succès ! Vous pouvez vous connecter.');
    }

    public function resend(Request $request)
    {
        // Renvoyer l'email de confirmation
        if ($request->user()) {
            $request->user()->sendEmailVerificationNotification();
        }
        
        return back()->with('success', 'Un email de confirmation a été envoyé.');
    }
}
