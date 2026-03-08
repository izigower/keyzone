@extends('layouts.app')
@section('title', 'Paiement réussi - KEYZONE')
@section('content')
<div style="max-width: 700px; margin: 3rem auto; padding: 0 2rem;">
    <div style="text-align: center; padding: 3rem; background: rgba(30, 33, 52, 0.8); border-radius: 16px; border: 2px solid #10b981;">
        <div style="font-size: 5rem; color: #10b981; margin-bottom: 1.5rem;"><i class="fas fa-check-circle"></i></div>
        <h1 style="color: #10b981; margin-bottom: 1rem; font-size: 2.2rem;">Paiement réussi !</h1>
        <p style="color: #a1a1aa; margin-bottom: 1rem; font-size: 1.1rem;">Merci pour votre achat. Vos clés de jeu sont disponibles ci-dessous.</p>
        <div style="background: rgba(16, 185, 129, 0.2); padding: 1rem; border-radius: 8px; margin: 1.5rem 0; font-size: 1.1rem; color: #10b981;">
            <i class="fas fa-receipt"></i> Commande #{{ $commande->numero_commande }}
        </div>
        <p style="color: #a1a1aa;">Montant payé : <strong style="color: #10b981;">{{ number_format($commande->montant_reduit ?? $commande->montant_total, 2, ',', ' ') }} &euro;</strong></p>
    </div>

    <!-- Game Keys -->
    @if($commande->cles->count() > 0)
        <div style="margin-top: 2rem; background: rgba(30, 33, 52, 0.8); border-radius: 16px; padding: 2rem; border: 1px solid rgba(139, 92, 246, 0.3);">
            <h2 style="color: #a78bfa; margin-bottom: 1.5rem;"><i class="fas fa-key"></i> Vos clés de jeu</h2>
            @foreach($commande->cles as $cle)
                <div style="background: rgba(15, 15, 30, 0.6); padding: 1.2rem; border-radius: 8px; margin-bottom: 1rem; border: 1px solid rgba(139, 92, 246, 0.2);">
                    <div style="font-size: 0.9rem; color: #94a3b8; margin-bottom: 0.5rem;">{{ $cle->produit->nom ?? 'Produit' }}</div>
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <code style="font-size: 1.2rem; color: #34d399; background: rgba(16,185,129,0.1); padding: 0.5rem 1rem; border-radius: 6px; letter-spacing: 2px; font-weight: 700;" id="key-{{ $cle->id }}">{{ $cle->cle }}</code>
                        <button onclick="navigator.clipboard.writeText('{{ $cle->cle }}'); this.innerHTML='<i class=\'fas fa-check\'></i> Copié !'; setTimeout(() => this.innerHTML='<i class=\'fas fa-copy\'></i> Copier', 2000)" class="btn btn-primary btn-sm">
                            <i class="fas fa-copy"></i> Copier
                        </button>
                    </div>
                </div>
            @endforeach
            <p style="color: #71717a; font-size: 0.85rem; margin-top: 1rem;"><i class="fas fa-envelope"></i> Un email de confirmation contenant vos clés a également été envoyé.</p>
        </div>
    @endif

    <div style="text-align: center; margin-top: 2rem; display: flex; gap: 1rem; justify-content: center;">
        <a href="{{ route('commandes.index') }}" class="btn btn-primary"><i class="fas fa-box"></i> Mes commandes</a>
        <a href="{{ route('games.index') }}" class="btn btn-outline">Continuer mes achats</a>
    </div>
</div>
@endsection
