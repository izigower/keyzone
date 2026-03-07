<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement réussi - KEYZONE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #0a0a0f 0%, #1e1d2d 100%);
            color: #ffffff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .success-container {
            text-align: center;
            padding: 4rem;
            background: rgba(30, 33, 52, 0.8);
            border-radius: 16px;
            border: 2px solid #10b981;
            max-width: 600px;
            margin: 2rem;
        }

        .success-icon {
            font-size: 6rem;
            color: #10b981;
            margin-bottom: 2rem;
        }

        h1 {
            color: #10b981;
            margin-bottom: 1rem;
            font-size: 2.5rem;
        }

        p {
            color: #a1a1aa;
            margin-bottom: 1rem;
            font-size: 1.1rem;
            line-height: 1.6;
        }

        .order-number {
            background: rgba(16, 185, 129, 0.2);
            padding: 1rem;
            border-radius: 8px;
            margin: 2rem 0;
            font-size: 1.2rem;
            color: #10b981;
        }

        .btn {
            padding: 1rem 2rem;
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            color: #ffffff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            display: inline-block;
            margin: 0.5rem;
            transition: all 0.3s;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(139, 92, 246, 0.4);
        }
    </style>
</head>
<body>
    <div class="success-container">
        <div class="success-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <h1>Paiement réussi !</h1>
        <p>Merci pour votre achat. Vos clés de jeu ont été envoyées à votre email.</p>
        
        <div class="order-number">
            <i class="fas fa-receipt"></i> Commande #{{ $commande->numero_commande }}
        </div>
        
        <p>Montant payé : <strong style="color: #10b981;">{{ number_format($commande->montant_total, 2) }} €</strong></p>
        
        <div style="margin-top: 2rem;">
            <a href="{{ route('home') }}" class="btn">Retour à l'accueil</a>
            <a href="#" class="btn" onclick="window.print();">
                <i class="fas fa-print"></i> Imprimer
            </a>
        </div>
    </div>
</body>
</html>