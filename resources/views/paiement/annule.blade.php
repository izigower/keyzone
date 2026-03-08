@extends('layouts.app')
@section('title', 'Paiement annulé - KEYZONE')
@section('content')
<div style="max-width: 600px; margin: 5rem auto; padding: 0 2rem;">
    <div style="text-align: center; padding: 4rem; background: rgba(30, 33, 52, 0.8); border-radius: 16px; border: 2px solid #ef4444;">
        <div style="font-size: 6rem; color: #ef4444; margin-bottom: 2rem;"><i class="fas fa-times-circle"></i></div>
        <h1 style="color: #ef4444; margin-bottom: 1rem; font-size: 2.5rem;">Paiement annulé</h1>
        <p style="color: #a1a1aa; margin-bottom: 2rem; font-size: 1.1rem;">Le paiement a été annulé. Votre panier est toujours disponible.</p>
        <div style="display: flex; gap: 1rem; justify-content: center;">
            <a href="{{ route('panier.index') }}" class="btn btn-primary">Retour au panier</a>
            <a href="{{ route('home') }}" class="btn btn-outline">Accueil</a>
        </div>
    </div>
</div>
@endsection
