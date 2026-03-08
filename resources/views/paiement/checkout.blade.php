<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement - KEYZONE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0a0a0f 0%, #1e1d2d 100%);
            color: #ffffff;
            min-height: 100vh;
        }

        nav {
            background: rgba(10, 10, 15, 0.98);
            padding: 1rem 5%;
            border-bottom: 1px solid rgba(139, 92, 246, 0.2);
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .nav-links a {
            color: #ffffff;
            text-decoration: none;
            margin-right: 2rem;
            font-weight: 600;
        }

        .container {
            max-width: 800px;
            margin: 100px auto;
            padding: 2rem;
        }

        h1 {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 3rem;
            color: #a78bfa;
        }

        .checkout-form {
            background: rgba(30, 33, 52, 0.8);
            border-radius: 16px;
            padding: 3rem;
            border: 1px solid rgba(139, 92, 246, 0.2);
        }

        .form-group {
            margin-bottom: 2rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.8rem;
            font-weight: 600;
            color: #c4b5fd;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 1rem;
            background: rgba(15, 15, 30, 0.6);
            border: 2px solid rgba(139, 92, 246, 0.3);
            border-radius: 8px;
            color: #ffffff;
            font-size: 1rem;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #8b5cf6;
        }

        .form-group textarea {
            min-height: 80px;
            resize: vertical;
        }

        .payment-summary {
            background: rgba(139, 92, 246, 0.1);
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(139, 92, 246, 0.3);
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(139, 92, 246, 0.1);
        }

        .summary-total {
            font-size: 1.5rem;
            font-weight: 700;
            color: #a78bfa;
            border-top: 2px solid rgba(139, 92, 246, 0.3);
            padding-top: 1rem;
            margin-top: 1rem;
        }

        .btn-pay {
            width: 100%;
            padding: 1.5rem;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-size: 1.3rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-pay:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(16, 185, 129, 0.4);
        }

        .secure-badge {
            text-align: center;
            margin-top: 2rem;
            color: #71717a;
        }

        .secure-badge i {
            color: #10b981;
            margin-right: 0.5rem;
        }
    </style>
</head>
<body>
    <nav>
        <div class="nav-container">
            <div class="nav-links">
                <a href="{{ route('home') }}">Accueil</a>
                <a href="{{ route('panier.index') }}">Panier</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1><i class="fas fa-credit-card"></i> Paiement Sécurisé</h1>

        <div class="checkout-form">
            <div class="payment-summary">
                <h3 style="margin-bottom: 1.5rem; color: #a78bfa;">Résumé de la commande</h3>
                @foreach($panier->lignes as $ligne)
                    <div class="summary-item">
                        <span>{{ $ligne->produit->nom_produit }} (x{{ $ligne->quantite }})</span>
                        <span>{{ number_format($ligne->produit->prix * $ligne->quantite, 2) }} €</span>
                    </div>
                @endforeach
                <div class="summary-item summary-total">
                    <span>Total à payer</span>
                    <span>{{ number_format($total, 2) }} €</span>
                </div>
            </div>

            <form action="{{ route('paiement.payer') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label><i class="fas fa-map-marker-alt"></i> Adresse de livraison</label>
                    <textarea name="adresse_livraison" required placeholder="Rue&#10;Code postal, Ville&#10;Pays">{{ old('adresse_livraison') }}</textarea>
                </div>

                <div class="form-group">
                    <label><i class="fas fa-file-invoice"></i> Adresse de facturation</label>
                    <textarea name="adresse_facturation" required placeholder="Rue&#10;Code postal, Ville&#10;Pays">{{ old('adresse_facturation') }}</textarea>
                </div>

                <div class="form-group">
                    <label><i class="fas fa-wallet"></i> Mode de paiement</label>
                    <select name="mode_paiement" required>
                        <option value="carte">Carte bancaire</option>
                        <option value="paypal">PayPal</option>
                        <option value="virement">Virement bancaire</option>
                    </select>
                </div>

                <button type="submit" class="btn-pay">
                    <i class="fas fa-lock"></i> Payer {{ number_format($total, 2) }} €
                </button>

                <div class="secure-badge">
                    <i class="fas fa-shield-alt"></i>
                    Paiement 100% sécurisé par Stripe
                </div>
            </form>
        </div>
    </div>
</body>
</html>