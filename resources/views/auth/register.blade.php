@extends('layouts.app')
@section('title', 'Inscription - KEYZONE')
@section('styles')
    <style>
        .auth-wrapper {
            min-height: calc(100vh - 70px);
            width: 100vw;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 2rem;
            position: relative;
            overflow: hidden;
            margin-left: calc(-50vw + 50%);
            margin-right: calc(-50vw + 50%);
        }

        .auth-wrapper::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at 70% 50%, rgba(139, 92, 246, 0.06) 0%, transparent 60%);
        }

        .auth-container {
            max-width: 480px;
            width: 100%;
            margin: 0 auto;
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

        .auth-header p {
            color: #64748b;
            font-size: 0.95rem;
        }

        .perks-box {
            background: rgba(20, 20, 40, 0.4);
            border: 1px solid rgba(139, 92, 246, 0.08);
            border-radius: 14px;
            padding: 1.3rem 1.5rem;
            margin-bottom: 1.5rem;
        }

        .perks-box h3 {
            color: #8b5cf6;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 0.8rem;
            font-weight: 700;
        }

        .perks-box ul {
            list-style: none;
        }

        .perks-box li {
            padding: 0.3rem 0;
            color: #94a3b8;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            font-size: 0.9rem;
        }

        .perks-box li i {
            color: #10b981;
            font-size: 0.8rem;
        }

        .auth-box {
            background: rgba(20, 20, 40, 0.5);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(139, 92, 246, 0.08);
            border-radius: 20px;
            padding: 2.5rem;
            margin-bottom: 1.5rem;
        }

        .terms-label {
            display: flex;
            align-items: flex-start;
            gap: 0.6rem;
            cursor: pointer;
            font-size: 0.88rem;
            color: #94a3b8;
            margin-bottom: 1.5rem;
        }

        .terms-label input[type="checkbox"] {
            accent-color: #8b5cf6;
            margin-top: 0.2rem;
        }

        .terms-label a {
            color: #8b5cf6;
            transition: color 0.3s;
        }

        .terms-label a:hover {
            color: #a78bfa;
        }

        .auth-footer {
            text-align: center;
            color: #64748b;
            font-size: 0.9rem;
        }

        .auth-footer a {
            color: #8b5cf6;
            font-weight: 600;
        }
    </style>
@endsection

@section('content')
    <div class="auth-wrapper">
        <div class="auth-container">
            <div class="auth-header">
                <div class="auth-icon"><i class="fas fa-user-plus"></i></div>
                <h1>Creez votre compte</h1>
                <p>Rejoignez notre communaute de gamers</p>
            </div>

            <div class="perks-box">
                <h3>Vos avantages</h3>
                <ul>
                    <li><i class="fas fa-check"></i> Acces a plus de 1000 jeux</li>
                    <li><i class="fas fa-check"></i> Cles livrees instantanement</li>
                    <li><i class="fas fa-check"></i> Offres exclusives et reductions</li>
                </ul>
            </div>

            <div class="auth-box">
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error) <p>{{ $error }}</p> @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <label>Nom d'utilisateur</label>
                        <input type="text" name="username" class="form-control" placeholder="GamerPro42"
                            value="{{ old('username') }}" required>
                        <small style="color: #374151; font-size: 0.78rem;">Min 3 caracteres,
                            lettres/chiffres/underscores</small>
                        @error('username') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label>Adresse email</label>
                        <input type="email" name="email" class="form-control" placeholder="username@exemple.com"
                            value="{{ old('email') }}" required>
                        @error('email') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label>Date de naissance</label>
                        <input type="date" name="date_naissance" class="form-control" value="{{ old('date_naissance') }}"
                            required max="{{ now()->subYears(16)->format('Y-m-d') }}">
                        <small style="color: #374151; font-size: 0.78rem;">Vous devez avoir au moins 16 ans</small>
                        @error('date_naissance') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label>Mot de passe</label>
                        <input type="password" name="password" class="form-control"
                            placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" required>
                        <small style="color: #374151; font-size: 0.78rem;">8-24 caracteres, majuscules, minuscules et
                            chiffres</small>
                        @error('password') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label>Confirmer le mot de passe</label>
                        <input type="password" name="password_confirmation" class="form-control"
                            placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" required>
                    </div>
                    <label class="terms-label">
                        <input type="checkbox" name="terms" required>
                        <span>J'accepte les <a href="#">conditions d'utilisation</a> et la <a href="#">politique de
                                confidentialite</a></span>
                    </label>
                    @error('terms') <div class="form-error" style="margin-top: -1rem; margin-bottom: 1rem;">{{ $message }}
                    </div> @enderror
                    <button type="submit" class="btn btn-primary"
                        style="width: 100%; padding: 1rem; font-size: 1rem; justify-content: center;">Creer mon
                        compte</button>
                </form>
            </div>

            <div class="auth-footer">
                Deja un compte ? <a href="{{ route('login') }}">Se connecter</a>
            </div>
        </div>
    </div>
@endsection