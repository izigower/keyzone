<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background: #0a0a0f; color: #ffffff; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: #1e2134; border-radius: 12px; padding: 30px; border: 1px solid rgba(139, 92, 246, 0.3); }
        .header { text-align: center; margin-bottom: 30px; }
        .header h1 { background: linear-gradient(135deg, #8b5cf6, #a78bfa); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-size: 28px; }
        .key-box { background: #0f0f1e; padding: 15px; border-radius: 8px; margin: 10px 0; border-left: 4px solid #10b981; }
        .key-code { color: #34d399; font-family: monospace; font-size: 18px; font-weight: bold; letter-spacing: 2px; }
        .game-name { color: #94a3b8; font-size: 14px; margin-bottom: 5px; }
        .total { text-align: center; font-size: 24px; color: #a78bfa; font-weight: bold; margin: 20px 0; }
        .footer { text-align: center; color: #71717a; font-size: 12px; margin-top: 30px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>KEYZONE</h1>
            <p style="color: #94a3b8;">Confirmation de votre commande</p>
        </div>

        <p>Bonjour {{ $commande->user->username }},</p>
        <p style="color: #a1a1aa;">Merci pour votre achat ! Voici les détails de votre commande :</p>

        <div style="background: rgba(139, 92, 246, 0.1); padding: 15px; border-radius: 8px; margin: 20px 0;">
            <p><strong>Commande :</strong> #{{ $commande->numero_commande }}</p>
            <p><strong>Date :</strong> {{ $commande->created_at->format('d/m/Y H:i') }}</p>
        </div>

        <h2 style="color: #a78bfa;">Vos clés de jeu :</h2>

        @foreach($commande->cles as $cle)
            <div class="key-box">
                <div class="game-name">{{ $cle->produit->nom ?? 'Jeu' }}</div>
                <div class="key-code">{{ $cle->cle }}</div>
            </div>
        @endforeach

        <div class="total">
            Total payé : {{ number_format($commande->montant_reduit ?? $commande->montant_total, 2, ',', ' ') }} EUR
        </div>

        <p style="color: #a1a1aa;">Vos clés sont également disponibles dans votre espace "Mes commandes" sur le site.</p>

        <div class="footer">
            <p>&copy; {{ date('Y') }} KEYZONE. Tous droits réservés.</p>
            <p>Cet email a été envoyé automatiquement, merci de ne pas y répondre.</p>
        </div>
    </div>
</body>
</html>
