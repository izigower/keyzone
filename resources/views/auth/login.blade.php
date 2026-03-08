<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Connexion - Gaming Store</title>
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
            max-width: 450px;
        }

        .header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .logo {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .logo i {
            color: #8b5cf6;
        }

        .header h1 {
            font-size: 2.5rem;
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

        .form-container {
            background: rgba(30, 33, 52, 0.6);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(139, 92, 246, 0.1);
            border-radius: 16px;
            padding: 2.5rem;
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #e2e8f0;
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

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            font-size: 0.9rem;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }

        .remember-me input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: #8b5cf6;
        }

        .forgot-password {
            color: #8b5cf6;
            text-decoration: none;
            transition: color 0.3s;
        }

        .forgot-password:hover {
            color: #a78bfa;
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
                font-size: 2rem;
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
            <h1>CONNEXION</h1>
            <p>Connectez-vous pour accéder à vos jeux</p>
        </div>

        <div class="form-container">
            @if(session('error'))
                <div class="error-message">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Email ou nom d'utilisateur</label>
                    <input 
                        type="text" 
                        id="email" 
                        name="email" 
                        placeholder="votreemail@exemple.com" 
                        value="{{ old('email') }}" 
                        required 
                        autofocus
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
                    @error('password')
                        <div style="color: #f87171; font-size: 0.85rem; margin-top: 0.3rem;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember">
                        <span>Se souvenir de moi</span>
                    </label>
                    <a href="#" class="forgot-password">Mot de passe oublié ?</a>
                </div>

                <button type="submit" class="btn-submit">
                    Se connecter
                </button>
            </form>

            <div class="divider">
                <span>OU CONTINUER AVEC</span>
            </div>

            <div class="social-login">
                <a href="{{ url('auth/google') }}" class="btn-social">
                    <i class="fab fa-google"></i>
                    Continuer avec Google
                </a>
                <a href="{{ url('auth/facebook') }}" class="btn-social">
                    <i class="fab fa-facebook-f"></i>
                    Continuer avec Facebook
                </a>
            </div>
        </div>

        <div class="footer">
            Vous avez déjà un compte ? <a href="{{ route('register') }}">S'inscrire</a>
        </div>
    </div>
</body>
</html>