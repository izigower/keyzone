@extends('layouts.app')
@section('title', 'Mot de passe oublié - KEYZONE')
@section('content')
<div style="max-width: 450px; margin: 5rem auto; padding: 0 2rem;">
    <div style="text-align: center; margin-bottom: 2rem;">
        <div style="font-size: 3rem; margin-bottom: 1rem;"><i class="fas fa-key" style="color: #8b5cf6;"></i></div>
        <h1 style="font-size: 2rem; background: linear-gradient(135deg, #8b5cf6, #a78bfa); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Mot de passe oublié</h1>
        <p style="color: #94a3b8;">Entrez votre email pour recevoir un lien de réinitialisation</p>
    </div>
    <div style="background: rgba(30, 33, 52, 0.6); border: 1px solid rgba(139, 92, 246, 0.1); border-radius: 16px; padding: 2.5rem;">
        @if($errors->any())
            <div class="alert alert-danger">@foreach($errors->all() as $e)<p>{{ $e }}</p>@endforeach</div>
        @endif
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group">
                <label>Adresse email</label>
                <input type="email" name="email" class="form-control" placeholder="votreemail@exemple.com" value="{{ old('email') }}" required autofocus>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1rem;">Envoyer le lien</button>
        </form>
    </div>
    <div style="text-align: center; margin-top: 2rem;"><a href="{{ route('login') }}" style="color: #8b5cf6;">Retour à la connexion</a></div>
</div>
@endsection
