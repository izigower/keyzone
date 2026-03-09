@extends('layouts.app')
@section('title', 'Vérifiez votre email - KEYZONE')
@section('content')
<div style="max-width: 500px; margin: 5rem auto; padding: 0 2rem; text-align: center;">
    <div style="background: rgba(30, 33, 52, 0.8); border-radius: 16px; padding: 3rem; border: 1px solid rgba(139, 92, 246, 0.2);">
        <div style="font-size: 4rem; color: #10b981; margin-bottom: 1.5rem;"><i class="fas fa-check-circle"></i></div>
        <h1 style="font-size: 2rem; margin-bottom: 1rem;">Email vérifié !</h1>
        <p style="color: #a1a1aa; margin-bottom: 2rem;">
            Un email de confirmation a été envoyé. Votre compte sera automatiquement activé dans quelques instants.
        </p>

        <div style="background: rgba(139, 92, 246, 0.1); border-radius: 12px; padding: 1.5rem; margin-bottom: 2rem;">
            <p style="color: #c4b5fd; margin: 0;">
                <i class="fas fa-info-circle" style="margin-right: 0.5rem;"></i>
                Vous pouvez vous connecter immédiatement ou attendre la confirmation par email.
            </p>
        </div>

        <a href="{{ route('login') }}" class="btn btn-primary" style="padding: 1rem 2rem;">
            Se connecter
        </a>
    </div>
</div>
@endsection
