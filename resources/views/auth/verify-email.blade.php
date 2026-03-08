@extends('layouts.app')
@section('title', 'Vérifiez votre email - KEYZONE')
@section('content')
<div style="max-width: 500px; margin: 5rem auto; padding: 0 2rem; text-align: center;">
    <div style="background: rgba(30, 33, 52, 0.8); border-radius: 16px; padding: 3rem; border: 1px solid rgba(139, 92, 246, 0.2);">
        <div style="font-size: 4rem; color: #8b5cf6; margin-bottom: 1.5rem;"><i class="fas fa-envelope"></i></div>
        <h1 style="font-size: 2rem; margin-bottom: 1rem;">Vérifiez votre email</h1>
        <p style="color: #a1a1aa; margin-bottom: 2rem;">Un lien de vérification a été envoyé à votre adresse email. Veuillez cliquer sur le lien pour activer votre compte.</p>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-primary" style="padding: 1rem 2rem;">Renvoyer l'email de vérification</button>
        </form>
        <div style="margin-top: 2rem;">
            <a href="{{ route('home') }}" style="color: #8b5cf6;">Retour à l'accueil</a>
        </div>
    </div>
</div>
@endsection
