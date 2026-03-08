@extends('layouts.app')
@section('title', 'Connexion - KEYZONE')
@section('styles')
<style>
    .auth-wrapper {
        min-height: calc(100vh - 70px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 3rem 2rem;
        position: relative;
        overflow: hidden;
    }
    .auth-wrapper::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse at 30% 50%, rgba(139, 92, 246, 0.06) 0%, transparent 60%);
    }
    .auth-container {
        max-width: 440px;
        width: 100%;
        position: relative;
        z-index: 1;
    }
    .auth-header {
        text-align: center;
        margin-bottom: 2rem;
    }
    .auth-icon {
        width: 60px;
        height: 60px;
        border-radius: 16px;
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.15), rgba(139, 92, 246, 0.05));
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.2rem;
        font-size: 1.5rem;
        color: #8b5cf6;
    }
    .auth-header h1 {
        font-size: 2rem;
        font-weight: 900;
        background: linear-gradient(135deg, #fff, #c4b5fd);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.3rem;
    }
    .auth-header p { color: #64748b; font-size: 0.95rem; }
    .auth-box {
        background: rgba(20, 20, 40, 0.5);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(139, 92, 246, 0.08);
        border-radius: 20px;
        padding: 2.5rem;
    }
    .auth-footer {
        text-align: center;
        margin-top: 2rem;
        color: #64748b;
        font-size: 0.9rem;
    }
    .auth-footer a { color: #8b5cf6; font-weight: 600; transition: color 0.3s; }
    .auth-footer a:hover { color: #a78bfa; }
    .remember-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        font-size: 0.88rem;
    }
    .remember-row label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
        color: #94a3b8;
    }
    .remember-row input[type="checkbox"] { accent-color: #8b5cf6; }
    .remember-row a { color: #8b5cf6; font-size: 0.88rem; transition: color 0.3s; }
    .remember-row a:hover { color: #a78bfa; }
</style>
@endsection

@section('content')
<div class="auth-wrapper">
    <div class="auth-container">
        <div class="auth-header">
            <div class="auth-icon"><i class="fas fa-gamepad"></i></div>
            <h1>Connexion</h1>
            <p>Connectez-vous pour acceder a vos jeux</p>
        </div>

        <div class="auth-box">
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error) <p>{{ $error }}</p> @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label>Email ou nom d'utilisateur</label>
                    <input type="text" name="email" class="form-control" placeholder="votreemail@exemple.com" value="{{ old('email') }}" required autofocus>
                </div>
                <div class="form-group">
                    <label>Mot de passe</label>
                    <input type="password" name="password" class="form-control" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" required>
                </div>
                <div class="remember-row">
                    <label>
                        <input type="checkbox" name="remember"> Se souvenir de moi
                    </label>
                    <a href="{{ route('password.request') }}">Mot de passe oublie ?</a>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1rem; font-size: 1rem; justify-content: center;">Se connecter</button>
            </form>
        </div>

        <div class="auth-footer">
            Pas encore de compte ? <a href="{{ route('register') }}">S'inscrire</a>
        </div>
    </div>
</div>
@endsection
