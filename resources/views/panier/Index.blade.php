<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Votre Panier - KEYZONE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #0a0a0f;
            color: #ffffff;
        }

        nav {
            background: rgba(10, 10, 15, 0.98);
            padding: 1rem 5%;
            border-bottom: 1px solid rgba(139, 92, 246, 0.2);
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-links a {
            color: #ffffff;
            text-decoration: none;
            margin-right: 2rem;
            font-weight: 600;
        }

        .nav-links a:hover {
            color: #a78bfa;
        }

        .btn {
            padding: 0.7rem 1.8rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            color: #ffffff;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(139, 92, 246, 0.4);
        }

        .btn-danger {
            background: #ef4444;
            color: #ffffff;
            padding: 0.5rem 1rem;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .container {
            max-width: 1200px;
            margin: 100px auto;
            padding: 2rem;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 2rem;
            color: #a78bfa;
        }

        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.2);
            border: 1px solid #10b981;
            color: #10b981;
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.2);
            border: 1px solid #ef4444;
            color: #ef4444;
        }

        .cart-items {
            background: rgba(30, 33, 52, 0.6);
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .cart-item {
            display: grid;
            grid-template-columns: 100px 1fr auto;
            gap: 2rem;
            padding: 1.5rem;
            border-bottom: 1px solid rgba(139, 92, 246, 0.1);
            align-items: center;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 100px;
            height: 100px;
            border-radius: 8px;
            object-fit: cover;
        }

        .item-info h3 {
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
        }

        .item-info p {
            color: #71717a;
            margin-bottom: 0.3rem;
        }

        .item-price {
            font-size: 1.5rem;
            color: #a78bfa;
            font-weight: 700;
        }

        .quantity-form {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }

        .quantity-form input {
            width: 60px;
            padding: 0.3rem;
            background: rgba(15, 15, 30, 0.6);
            border: 1px solid rgba(139, 92, 246, 0.3);
            border-radius: 4px;
            color: #ffffff;
            text-align: center;
        }

        .cart-summary {
            background: rgba(30, 33, 52, 0.6);
            border-radius: 12px;
            padding: 2rem;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }

        .summary-total {
            font-size: 1.8rem;
            font-weight: 700;
            color: #a78bfa;
            border-top: 2px solid rgba(139, 92, 246, 0.3);
            padding-top: 1rem;
            margin-top: 1rem;
        }

        .checkout-btn {
            width: 100%;
            margin-top: 1.5rem;
            padding: 1.2rem;
            font-size: 1.2rem;
        }

        .empty-cart {
            text-align: center;
            padding: 4rem 2rem;
            color: #71717a;
        }

        .empty-cart i {
            font-size: 5rem;
            margin-bottom: 1rem;
            color: #8b5cf6;
        }

        @media (max-width: 768px) {
            .cart-item {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <nav>
        <div class="nav-container">
            <div class="nav-links">
                <a href="{{ route('home') }}">Accueil</a>
                <a href="{{ route('games.index') }}">Jeux</a>
            </div>
            <div>
                <a href="{{ route('panier.index') }}" style="color: #a78bfa;">
                    <i class="fas fa-shopping-cart"></i> Panier
                </a>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1><i class="fas fa-shopping-cart"></i> Votre Panier</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @if($lignes->count() > 0)
            <div class="cart-items">
                @foreach($lignes as $ligne)
                    <div class="cart-item">
                        <img src="https://cdn.cloudflare.steamstatic.com/steam/apps/{{ $ligne->produit->id_produit }}/header.jpg" 
                             alt="{{ $ligne->produit->nom_produit }}" 
                             class="item-image"
                             onerror="this.src='https://via.placeholder.com/100'">
                        <div class="item-info">
                            <h3>{{ $ligne->produit->nom_produit }}</h3>
                            <p style="color: #a78bfa;">{{ number_format($ligne->produit->prix, 2) }} €</p>
                            
                            <form action="{{ route('panier.mettreAJour', $ligne->id_ligne_panier) }}" method="POST" class="quantity-form">
                                @csrf
                                <label>Quantité:</label>
                                <input type="number" name="quantite" value="{{ $ligne->quantite }}" min="1" max="10" onchange="this.form.submit()">
                            </form>
                        </div>
                        <div style="text-align: right;">
                            <div class="item-price">{{ number_format($ligne->produit->prix * $ligne->quantite, 2) }} €</div>
                            <form action="{{ route('panier.supprimer', $ligne->id_ligne_panier) }}" method="POST" style="margin-top: 1rem;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i> Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="cart-summary">
                <div class="summary-row">
                    <span>Sous-total</span>
                    <span>{{ number_format($total, 2) }} €</span>
                </div>
                <div class="summary-row">
                    <span>TVA (20%)</span>
                    <span>{{ number_format($total * 0.2, 2) }} €</span>
                </div>
                <div class="summary-row summary-total">
                    <span>Total</span>
                    <span>{{ number_format($total, 2) }} €</span>
                </div>
                <a href="{{ route('paiement.checkout') }}" class="btn btn-primary checkout-btn">
                    <i class="fas fa-lock"></i> Procéder au paiement
                </a>
                <form action="{{ route('panier.vider') }}" method="POST" style="margin-top: 1rem;">
                    @csrf
                    <button type="submit" class="btn btn-danger" style="width: 100%;">
                        <i class="fas fa-trash"></i> Vider le panier
                    </button>
                </form>
            </div>
        @else
            <div class="empty-cart">
                <i class="fas fa-shopping-cart"></i>
                <h2>Votre panier est vide</h2>
                <p>Découvrez nos jeux et ajoutez-les à votre panier !</p>
                <a href="{{ route('games.index') }}" class="btn btn-primary" style="margin-top: 2rem;">
                    Voir les jeux
                </a>
            </div>
        @endif
    </div>
</body>
</html>