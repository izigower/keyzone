@extends('layouts.app')
@section('title', 'Mon profil - KEYZONE')
@section('content')
<div style="max-width: 800px; margin: 2rem auto; padding: 0 2rem;">
    <h1 style="font-size: 2rem; margin-bottom: 2rem; color: #a78bfa;"><i class="fas fa-user"></i> Mon profil</h1>
    <div style="display: grid; gap: 2rem;">
        <div style="background: rgba(30, 33, 52, 0.7); border-radius: 12px; padding: 2rem; border: 1px solid rgba(139, 92, 246, 0.2);">
            <h2 style="color: #a78bfa; margin-bottom: 1.5rem;">Informations personnelles</h2>
            <form method="POST" action="{{ route('profil.update') }}" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="form-group">
                    <label>Nom d'utilisateur</label>
                    <input type="text" name="username" class="form-control" value="{{ old('username', $user->username) }}" required>
                    @error('username') <div class="form-error">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                    @error('email') <div class="form-error">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label>Date de naissance</label>
                    <input type="date" name="date_naissance" class="form-control" value="{{ old('date_naissance', $user->date_naissance?->format('Y-m-d')) }}" max="{{ now()->subYears(16)->format('Y-m-d') }}">
                    @error('date_naissance') <div class="form-error">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label>Photo de profil (max 5 Mo)</label>
                    <input type="file" name="avatar" class="form-control" accept="image/*">
                    @error('avatar') <div class="form-error">{{ $message }}</div> @enderror
                </div>
                <button type="submit" class="btn btn-primary">Modifier mon profil</button>
            </form>
        </div>

        <div style="background: rgba(30, 33, 52, 0.7); border-radius: 12px; padding: 2rem; border: 1px solid rgba(139, 92, 246, 0.2);">
            <h2 style="color: #a78bfa; margin-bottom: 1.5rem;">Changer le mot de passe</h2>
            <form method="POST" action="{{ route('profil.password') }}">
                @csrf @method('PUT')
                <div class="form-group">
                    <label>Mot de passe actuel</label>
                    <input type="password" name="current_password" class="form-control" required>
                    @error('current_password') <div class="form-error">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label>Nouveau mot de passe</label>
                    <input type="password" name="password" class="form-control" required>
                    <small style="color: #64748b;">8-24 caractères, majuscules, minuscules et chiffres</small>
                    @error('password') <div class="form-error">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label>Confirmer le nouveau mot de passe</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Changer le mot de passe</button>
            </form>
        </div>
    </div>
</div>
@endsection
