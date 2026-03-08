@extends('layouts.app')
@section('title', 'Réinitialiser le mot de passe - KEYZONE')
@section('content')
<div style="max-width: 450px; margin: 5rem auto; padding: 0 2rem;">
    <div style="text-align: center; margin-bottom: 2rem;">
        <h1 style="font-size: 2rem; color: #a78bfa;">Nouveau mot de passe</h1>
    </div>
    <div style="background: rgba(30, 33, 52, 0.6); border: 1px solid rgba(139, 92, 246, 0.1); border-radius: 16px; padding: 2.5rem;">
        @if($errors->any())
            <div class="alert alert-danger">@foreach($errors->all() as $e)<p>{{ $e }}</p>@endforeach</div>
        @endif
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ $email ?? old('email') }}" required>
            </div>
            <div class="form-group">
                <label>Nouveau mot de passe</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1rem;">Réinitialiser</button>
        </form>
    </div>
</div>
@endsection
