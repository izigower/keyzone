<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #0a0a0f;
            color: #ffffff;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #1e2134;
            border-radius: 12px;
            padding: 30px;
            border: 1px solid rgba(139, 92, 246, 0.3);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            background: linear-gradient(135deg, #8b5cf6, #a78bfa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 28px;
        }

        .success-icon {
            font-size: 60px;
            text-align: center;
            margin: 20px 0;
        }

        .btn-verify {
            display: inline-block;
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            color: #ffffff;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: bold;
            margin: 20px 0;
        }

        .footer {
            text-align: center;
            color: #71717a;
            font-size: 12px;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>KEYZONE</h1>
            <p style="color: #94a3b8;">Vérification d'email</p>
        </div>

        <div class="success-icon">✅</div>

        <p>Bonjour {{ $user->username ?? 'Cher joueur' }},</p>
        
        <p style="color: #a1a1aa; font-size: 16px; line-height: 1.6;">
            <strong>Merci d'avoir vérifié votre adresse email !</strong>
        </p>

        <p style="color: #a1a1aa;">
            Votre compte est maintenant activé. Vous pouvez dès maintenant vous connecter et profiter de tous nos jeux.
        </p>

        <div style="text-align: center;">
            <a href="{{ url('/login') }}" class="btn-verify">Se connecter</a>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} KEYZONE. Tous droits réservés.</p>
            <p>Cet email a été envoyé automatiquement, merci de ne pas y répondre.</p>
        </div>
    </div>
</body>

</html>
