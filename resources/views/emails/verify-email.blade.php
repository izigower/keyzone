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

        .small-url {
            color: #a78bfa;
            font-size: 11px;
            word-break: break-all;
            margin-top: 15px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>KEYZONE</h1>
            <p style="color: #94a3b8;">Vérifiez votre adresse email</p>
        </div>

        <p>Bonjour {{ $user->username ?? 'Cher joueur' }},</p>
        <p style="color: #a1a1aa;">Merci de vous être inscrit sur KEYZONE ! Veuillez cliquer sur le bouton ci-dessous
            pour vérifier votre adresse email et finaliser votre inscription.</p>

        <div style="text-align: center;">
            <a href="{{ $url }}" class="btn-verify">Vérifier mon adresse email</a>
        </div>

        <p style="color: #a1a1aa;">Si vous n'avez pas créé de compte, aucune action supplémentaire n'est requise.</p>

        <div class="small-url">
            <p>Si vous rencontrez des problèmes en cliquant sur le bouton, copiez et collez l'URL suivante dans votre
                navigateur web :</p>
            <p><a href="{{ $url }}" style="color: #a78bfa;">{{ $url }}</a></p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} KEYZONE. Tous droits réservés.</p>
            <p>Cet email a été envoyé automatiquement, merci de ne pas y répondre.</p>
        </div>
    </div>
</body>

</html>