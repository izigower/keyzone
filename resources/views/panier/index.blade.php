@extends('layouts.app')
@section('title', 'Votre Panier - KEYZONE')

@section('styles')
<style>
    .cart-wrapper {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 2rem;
    }
    .cart-header {
        margin-bottom: 2rem;
    }
    .cart-header h1 {
        font-size: 2.2rem;
        font-weight: 900;
        letter-spacing: -0.5px;
        display: flex;
        align-items: center;
        gap: 0.8rem;
    }
    .cart-header h1 i { color: #8b5cf6; font-size: 1.8rem; }
    .cart-header .count {
        font-size: 1rem;
        color: #64748b;
        font-weight: 500;
    }

    .cart-layout {
        display: grid;
        grid-template-columns: 1.5fr 1fr;
        gap: 2rem;
        align-items: start;
    }

    /* Cart items */
    .cart-items {
        background: rgba(20, 20, 40, 0.4);
        border-radius: 16px;
        border: 1px solid rgba(139, 92, 246, 0.06);
        overflow: hidden;
    }
    .cart-item {
        display: grid;
        grid-template-columns: 80px 1fr auto;
        gap: 1.2rem;
        padding: 1.5rem;
        border-bottom: 1px solid rgba(139, 92, 246, 0.05);
        align-items: center;
        transition: background 0.3s;
    }
    .cart-item:hover { background: rgba(139, 92, 246, 0.02); }
    .cart-item:last-child { border-bottom: none; }
    .cart-item-image {
        width: 80px;
        height: 80px;
        border-radius: 10px;
        object-fit: cover;
    }
    .cart-item-info h3 {
        font-size: 1.05rem;
        font-weight: 700;
        margin-bottom: 0.2rem;
    }
    .cart-item-platform { color: #4b5563; font-size: 0.82rem; margin-bottom: 0.2rem; }
    .cart-item-price { color: #a78bfa; font-weight: 700; margin-bottom: 0.5rem; }
    .cart-item-qty {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .cart-item-qty label { font-size: 0.82rem; color: #64748b; }
    .cart-item-qty input {
        width: 50px;
        padding: 0.3rem;
        background: rgba(15,15,30,0.6);
        border: 1px solid rgba(139,92,246,0.15);
        border-radius: 6px;
        color: #fff;
        text-align: center;
        font-family: inherit;
        font-size: 0.9rem;
    }
    .cart-item-qty input:focus {
        border-color: #8b5cf6;
        outline: none;
    }
    .cart-item-right {
        text-align: right;
    }
    .cart-item-subtotal {
        font-size: 1.2rem;
        color: #a78bfa;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    /* Summary */
    .cart-summary {
        background: rgba(20, 20, 40, 0.5);
        border-radius: 16px;
        border: 1px solid rgba(139, 92, 246, 0.08);
        padding: 2rem;
        position: sticky;
        top: 90px;
    }
    .cart-summary h3 {
        color: #e2e8f0;
        margin-bottom: 1.5rem;
        font-size: 1.1rem;
        font-weight: 700;
    }
    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.8rem;
        font-size: 0.95rem;
        color: #94a3b8;
    }
    .summary-total {
        display: flex;
        justify-content: space-between;
        font-size: 1.4rem;
        font-weight: 800;
        color: #a78bfa;
        border-top: 2px solid rgba(139,92,246,0.15);
        padding-top: 1rem;
        margin-top: 1rem;
    }
    .checkout-btn {
        width: 100%;
        margin-top: 1.5rem;
        padding: 1.1rem;
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        color: #fff;
        border: none;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: 700;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: all 0.3s;
        box-shadow: 0 8px 25px rgba(139, 92, 246, 0.3);
    }
    .checkout-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 35px rgba(139, 92, 246, 0.4);
    }
    .empty-btn {
        width: 100%;
        margin-top: 0.8rem;
        padding: 0.8rem;
        background: rgba(239, 68, 68, 0.08);
        color: #f87171;
        border: 1px solid rgba(239, 68, 68, 0.12);
        border-radius: 10px;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        font-family: inherit;
    }
    .empty-btn:hover {
        background: #ef4444;
        color: #fff;
        border-color: transparent;
    }

    /* Empty cart */
    .cart-empty {
        text-align: center;
        padding: 5rem 2rem;
    }
    .cart-empty-icon {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: rgba(139, 92, 246, 0.08);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2.5rem;
        color: #8b5cf6;
    }
    .cart-empty h2 { font-size: 1.5rem; margin-bottom: 0.5rem; }
    .cart-empty p { color: #4b5563; margin-bottom: 2rem; }

    @media (max-width: 768px) {
        .cart-layout { grid-template-columns: 1fr; }
        .cart-summary { position: static; }
    }
</style>
@endsection

@section('content')
<div class="cart-wrapper">
    <div class="cart-header">
        <h1><i class="fas fa-shopping-cart"></i> Votre Panier
            @if($lignes->count() > 0)
                <span class="count">({{ $lignes->count() }} article{{ $lignes->count() > 1 ? 's' : '' }})</span>
            @endif
        </h1>
    </div>

    @if($lignes->count() > 0)
        <div class="cart-layout">
            <div class="cart-items">
                @foreach($lignes as $ligne)
                    <div class="cart-item">
                        <img src="{{ $ligne->produit->image ?? 'https://via.placeholder.com/80' }}" alt="{{ $ligne->produit->nom }}" class="cart-item-image">
                        <div class="cart-item-info">
                            <h3>{{ $ligne->produit->nom }}</h3>
                            <p class="cart-item-platform">{{ $ligne->produit->plateforme->nom ?? '' }}</p>
                            <p class="cart-item-price">{{ number_format($ligne->produit->prix, 2, ',', ' ') }} &euro;</p>
                            <form action="{{ route('panier.mettreAJour', $ligne->id) }}" method="POST" class="cart-item-qty">
                                @csrf
                                <label>Qte:</label>
                                <input type="number" name="quantite" value="{{ $ligne->quantite }}" min="1" max="5" onchange="this.form.submit()">
                            </form>
                        </div>
                        <div class="cart-item-right">
                            <div class="cart-item-subtotal">{{ number_format($ligne->sous_total, 2, ',', ' ') }} &euro;</div>
                            <form action="{{ route('panier.supprimer', $ligne->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            <div>
                <div class="cart-summary">
                    <h3>Resume de la commande</h3>
                    <div class="summary-row"><span>Sous-total</span><span>{{ number_format($total, 2, ',', ' ') }} &euro;</span></div>
                    <div class="summary-total"><span>Total</span><span>{{ number_format($total, 2, ',', ' ') }} &euro;</span></div>
                    <a href="{{ route('paiement.checkout') }}" class="checkout-btn"><i class="fas fa-lock"></i> Proceder au paiement</a>
                    <form action="{{ route('panier.vider') }}" method="POST">
                        @csrf
                        <button type="submit" class="empty-btn" onclick="return confirm('Vider tout le panier ?')"><i class="fas fa-trash"></i> Vider le panier</button>
                    </form>
                </div>
            </div>
        </div>
    @else
        <div class="cart-empty">
            <div class="cart-empty-icon"><i class="fas fa-shopping-cart"></i></div>
            <h2>Votre panier est vide</h2>
            <p>Decouvrez nos jeux et ajoutez-les a votre panier !</p>
            <a href="{{ route('games.index') }}" class="btn btn-primary" style="padding: 1rem 2rem;">Voir les jeux</a>
        </div>
    @endif
</div>
@endsection
