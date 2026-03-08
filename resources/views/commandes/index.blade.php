@extends('layouts.app')
@section('title', 'Mes commandes - KEYZONE')
@section('content')
<div style="max-width: 1200px; margin: 2rem auto; padding: 0 2rem;">
    <h1 style="font-size: 2rem; margin-bottom: 2rem; color: #a78bfa;"><i class="fas fa-box"></i> Mes commandes</h1>

    @forelse($commandes as $commande)
        <div style="background: rgba(30, 33, 52, 0.7); border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem; border: 1px solid rgba(139, 92, 246, 0.2);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; flex-wrap: wrap; gap: 1rem;">
                <div>
                    <span style="color: #a78bfa; font-weight: 700;">#{{ $commande->numero_commande }}</span>
                    <span style="color: #71717a; margin-left: 1rem;">{{ $commande->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <div style="display: flex; gap: 1rem; align-items: center;">
                    <span style="padding: 0.3rem 0.8rem; border-radius: 6px; font-size: 0.85rem; font-weight: 600;
                        {{ $commande->statut === 'payee' ? 'background: rgba(16,185,129,0.2); color: #34d399;' : '' }}
                        {{ $commande->statut === 'en_attente' ? 'background: rgba(251,191,36,0.2); color: #fbbf24;' : '' }}
                        {{ $commande->statut === 'annulee' ? 'background: rgba(239,68,68,0.2); color: #f87171;' : '' }}
                    ">{{ ucfirst(str_replace('_', ' ', $commande->statut)) }}</span>
                    <span style="color: #a78bfa; font-weight: 700; font-size: 1.2rem;">{{ number_format($commande->montant_reduit ?? $commande->montant_total, 2, ',', ' ') }} &euro;</span>
                </div>
            </div>
            <div style="display: flex; flex-wrap: wrap; gap: 0.5rem; margin-bottom: 1rem;">
                @foreach($commande->lignes as $ligne)
                    <span style="background: rgba(15,15,30,0.5); padding: 0.3rem 0.8rem; border-radius: 6px; font-size: 0.85rem; color: #94a3b8;">{{ $ligne->produit->nom ?? 'Produit' }} (x{{ $ligne->quantite }})</span>
                @endforeach
            </div>
            @if($commande->cles->count() > 0)
                <div style="margin-top: 1rem;">
                    <h4 style="color: #34d399; margin-bottom: 0.5rem; font-size: 0.9rem;"><i class="fas fa-key"></i> Clés de jeu :</h4>
                    @foreach($commande->cles as $cle)
                        <div style="display: flex; justify-content: space-between; align-items: center; background: rgba(15,15,30,0.5); padding: 0.5rem 1rem; border-radius: 6px; margin-bottom: 0.3rem;">
                            <span style="color: #71717a; font-size: 0.85rem;">{{ $cle->produit->nom ?? '' }}</span>
                            <code style="color: #34d399; font-weight: 600;">{{ $cle->cle }}</code>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    @empty
        <div style="text-align: center; padding: 4rem; color: #71717a;">
            <i class="fas fa-box-open" style="font-size: 4rem; margin-bottom: 1rem; display: block; color: #8b5cf6;"></i>
            <h2 style="color: #fff; margin-bottom: 1rem;">Aucune commande</h2>
            <p style="margin-bottom: 2rem;">Vous n'avez pas encore passé de commande.</p>
            <a href="{{ route('games.index') }}" class="btn btn-primary">Découvrir les jeux</a>
        </div>
    @endforelse
    {{ $commandes->links() }}
</div>
@endsection
