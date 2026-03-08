<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Inscription - Gaming Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1a1d2d 0%, #0f0f1e 100%);
            color: #ffffff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .container {
            width: 100%;
            max-width: 500px;
        }

        .header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .logo i {
            color: #8b5cf6;
        }

        .header h1 {
            font-size: 2.2rem;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, #8b5cf6 0%, #a78bfa 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .header p {
            color: #94a3b8;
            font-size: 1rem;
        }

        .benefits {
            background: rgba(30, 33, 52, 0.6);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(139, 92, 246, 0.1);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .benefits h3 {
            color: #8b5cf6;
            margin-bottom: 1rem;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .benefits ul {
            list-style: none;
        }

        .benefits li {
            padding: 0.5rem 0;
            color: #cbd5e1;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            font-size: 0.95rem;
        }

        .benefits li i {
            color: #10b981;
            font-size: 1rem;
        }

        .form-container {
            background: rgba(30, 33, 52, 0.6);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(139, 92, 246, 0.1);
            border-radius: 16px;
            padding: 2.5rem;
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.3rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #e2e8f0;
            font-size: 0.95rem;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 1rem;
            background: rgba(15, 15, 30, 0.6);
            border: 2px solid rgba(139, 92, 246, 0.2);
            border-radius: 8px;
            color: #ffffff;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #8b5cf6;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
        }

        .form-group input::placeholder {
            color: #64748b;
        }

        .form-group small {
            display: block;
            margin-top: 0.3rem;
            color: #64748b;
            font-size: 0.8rem;
        }

        .checkbox-group {
            margin-bottom: 1.2rem;
        }

        .checkbox-group label {
            display: flex;
            align-items: flex-start;
            gap: 0.8rem;
            cursor: pointer;
            font-size: 0.9rem;
            color: #cbd5e1;
            line-height: 1.4;
        }

        .checkbox-group input[type="checkbox"] {
            width: 18px;
            height: 18px;
            margin-top: 0.2rem;
            cursor: pointer;
            accent-color: #8b5cf6;
            flex-shrink: 0;
        }

        .checkbox-group a {
            color: #8b5cf6;
            text-decoration: none;
        }

        .checkbox-group a:hover {
            text-decoration: underline;
        }

        .btn-submit {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            border: none;
            border-radius: 8px;
            color: #ffffff;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.3);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(139, 92, 246, 0.4);
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 2rem 0;
            color: #64748b;
            font-size: 0.9rem;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(100, 116, 139, 0.3);
        }

        .divider span {
            padding: 0 1rem;
        }

        .social-login {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .btn-social {
            width: 100%;
            padding: 1rem;
            background: rgba(15, 15, 30, 0.6);
            border: 1px solid rgba(139, 92, 246, 0.2);
            border-radius: 8px;
            color: #ffffff;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
            text-decoration: none;
        }

        .btn-social:hover {
            background: rgba(139, 92, 246, 0.1);
            border-color: #8b5cf6;
            transform: translateY(-2px);
        }

        .btn-social i {
            font-size: 1.2rem;
        }

        .footer {
            text-align: center;
            color: #94a3b8;
            font-size: 0.95rem;
        }

        .footer a {
            color: #8b5cf6;
            text-decoration: none;
            font-weight: 600;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .error-message {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #f87171;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        @media (max-width: 600px) {
            .form-container {
                padding: 1.5rem;
            }

            .header h1 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <i class="fas fa-gamepad"></i>
            </div>
            <h1>Créez votre compte</h1>
            <p>Rejoignez notre communauté de gamers</p>
        </div>

        <div class="benefits">
            <h3>Vos avantages</h3>
            <ul>
                <li><i class="fas fa-check"></i> Accès à plus de 1000 jeux</li>
                <li><i class="fas fa-check"></i> Bibliothèque cloud sur toutes les plateformes</li>
                <li><i class="fas fa-check"></i> Offres exclusives et réductions</li>
                <li><i class="fas fa-check"></i> Communauté active de joueurs</li>
            </ul>
        </div>

        <div class="form-container">
            @if(session('error'))
                <div class="error-message">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="username">Nom d'utilisateur</label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        placeholder="Nom" 
                        value="{{ old('username') }}" 
                        required 
                        autofocus
                    >
                    <small>Minimum 3 caractères</small>
                    @error('username')
                        <div style="color: #f87171; font-size: 0.85rem; margin-top: 0.3rem;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Adresse email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        placeholder="username@exemple.com" 
                        value="{{ old('email') }}" 
                        required
                    >
                    @error('email')
                        <div style="color: #f87171; font-size: 0.85rem; margin-top: 0.3rem;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="••••••••" 
                        required
                    >
                    <small>Minimum 8 caractères, majuscules, minuscules et chiffres</small>
                    @error('password')
                        <div style="color: #f87171; font-size: 0.85rem; margin-top: 0.3rem;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirmer le mot de passe</label>
                    <input 
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        placeholder="••••••••" 
                        required
                    >
                    @error('password_confirmation')
                        <div style="color: #f87171; font-size: 0.85rem; margin-top: 0.3rem;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="checkbox-group">
                    <label>
                        <input type="checkbox" name="newsletter" value="1">
                        <span>Je souhaite recevoir les offres exclusives et les nouveautés par email</span>
                    </label>
                </div>

                <div class="checkbox-group">
                    <label>
                        <input type="checkbox" name="terms" required>
                        <span>J'accepte les <a href="#">conditions d'utilisation</a> et la <a href="#">politique de confidentialité</a></span>
                    </label>
                    @error('terms')
                        <div style="color: #f87171; font-size: 0.85rem; margin-top: 0.3rem;">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-submit">
                    Créer mon compte
                </button>
            </form>

            <div class="divider">
                <span>OU S'INSCRIRE AVEC</span>
            </div>

            <div class="social-login">
                <a href="{{ url('auth/google') }}" class="btn-social">
                    <i class="fab fa-google"></i>
                    S'inscrire avec Google
                </a>
                <a href="{{ url('auth/facebook') }}" class="btn-social">
                    <i class="fab fa-facebook-f"></i>
                    S'inscrire avec Facebook
                </a>
        </div>

        <div class="footer">
            Vous avez déjà un compte ? <a href="{{ route('login') }}">Se connecter</a>
        </div>
    </div>
</body>
</html>