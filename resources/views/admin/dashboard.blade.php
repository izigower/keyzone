@extends('layouts.app')
@section('title', 'Administration - KEYZONE')
@section('content')
<div style="max-width: 1400px; margin: 2rem auto; padding: 0 2rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1 style="font-size: 2rem; color: #a78bfa;"><i class="fas fa-cog"></i> Administration</h1>
        <div style="display: flex; gap: 0.5rem;">
            <a href="{{ route('admin.users') }}" class="btn btn-outline btn-sm">Utilisateurs</a>
            <a href="{{ route('admin.categories') }}" class="btn btn-outline btn-sm">Catégories</a>
            <a href="{{ route('admin.produits') }}" class="btn btn-outline btn-sm">Produits</a>
            <a href="{{ route('admin.commandes') }}" class="btn btn-outline btn-sm">Commandes</a>
            <a href="{{ route('admin.promos') }}" class="btn btn-outline btn-sm">Promos</a>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; margin-bottom: 3rem;">
        <div style="background: linear-gradient(135deg, rgba(139, 92, 246, 0.2), rgba(30, 33, 52, 0.8)); padding: 2rem; border-radius: 12px; border: 1px solid rgba(139, 92, 246, 0.3);">
            <div style="font-size: 2.5rem; font-weight: 800; color: #a78bfa;">{{ $stats['users'] }}</div>
            <div style="color: #94a3b8;">Utilisateurs</div>
        </div>
        <div style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.2), rgba(30, 33, 52, 0.8)); padding: 2rem; border-radius: 12px; border: 1px solid rgba(16, 185, 129, 0.3);">
            <div style="font-size: 2.5rem; font-weight: 800; color: #34d399;">{{ $stats['produits'] }}</div>
            <div style="color: #94a3b8;">Produits</div>
        </div>
        <div style="background: linear-gradient(135deg, rgba(251, 191, 36, 0.2), rgba(30, 33, 52, 0.8)); padding: 2rem; border-radius: 12px; border: 1px solid rgba(251, 191, 36, 0.3);">
            <div style="font-size: 2.5rem; font-weight: 800; color: #fbbf24;">{{ $stats['commandes'] }}</div>
            <div style="color: #94a3b8;">Commandes</div>
        </div>
        <div style="background: linear-gradient(135deg, rgba(239, 68, 68, 0.2), rgba(30, 33, 52, 0.8)); padding: 2rem; border-radius: 12px; border: 1px solid rgba(239, 68, 68, 0.3);">
            <div style="font-size: 2.5rem; font-weight: 800; color: #f87171;">{{ number_format($stats['revenus'], 2, ',', ' ') }} &euro;</div>
            <div style="color: #94a3b8;">Revenus</div>
        </div>
    </div>

    <div style="background: rgba(30, 33, 52, 0.7); border-radius: 12px; padding: 2rem; border: 1px solid rgba(139, 92, 246, 0.2);">
        <h2 style="color: #a78bfa; margin-bottom: 1.5rem;">Commandes récentes</h2>
        <div class="table-container">
            <table>
                <thead><tr><th>#</th><th>Client</th><th>Montant</th><th>Statut</th><th>Date</th></tr></thead>
                <tbody>
                    @forelse($stats['commandes_recentes'] as $cmd)
                        <tr>
                            <td style="color: #a78bfa;">{{ $cmd->numero_commande }}</td>
                            <td>{{ $cmd->user->username ?? 'N/A' }}</td>
                            <td style="font-weight: 600;">{{ number_format($cmd->montant_total, 2, ',', ' ') }} &euro;</td>
                            <td><span style="padding: 0.2rem 0.6rem; border-radius: 4px; font-size: 0.8rem;
                                {{ $cmd->statut === 'payee' ? 'background: rgba(16,185,129,0.2); color: #34d399;' : 'background: rgba(251,191,36,0.2); color: #fbbf24;' }}
                            ">{{ ucfirst($cmd->statut) }}</span></td>
                            <td style="color: #71717a;">{{ $cmd->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5" style="text-align: center; color: #71717a;">Aucune commande</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
