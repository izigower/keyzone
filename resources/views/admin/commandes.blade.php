@extends('layouts.app')
@section('title', 'Commandes - Admin')
@section('content')
<div style="max-width: 1400px; margin: 2rem auto; padding: 0 2rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1 style="font-size: 2rem; color: #a78bfa;"><i class="fas fa-box"></i> Commandes</h1>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> Retour</a>
    </div>
    <div class="table-container" style="background: rgba(30, 33, 52, 0.7); border-radius: 12px;">
        <table>
            <thead><tr><th>#</th><th>Client</th><th>Montant</th><th>Promo</th><th>Statut</th><th>Date</th></tr></thead>
            <tbody>
                @forelse($commandes as $cmd)
                    <tr>
                        <td style="color: #a78bfa; font-weight: 600;">{{ $cmd->numero_commande }}</td>
                        <td>{{ $cmd->user->username ?? 'N/A' }}</td>
                        <td style="font-weight: 600;">{{ number_format($cmd->montant_reduit ?? $cmd->montant_total, 2, ',', ' ') }} &euro;
                            @if($cmd->montant_reduit) <span style="text-decoration: line-through; color: #71717a; font-size: 0.85rem;">{{ number_format($cmd->montant_total, 2) }}</span> @endif
                        </td>
                        <td>{{ $cmd->codePromo?->code ?? '-' }}</td>
                        <td><span style="padding: 0.2rem 0.6rem; border-radius: 4px; font-size: 0.8rem;
                            {{ $cmd->statut === 'payee' ? 'background: rgba(16,185,129,0.2); color: #34d399;' : '' }}
                            {{ $cmd->statut === 'en_attente' ? 'background: rgba(251,191,36,0.2); color: #fbbf24;' : '' }}
                            {{ $cmd->statut === 'annulee' ? 'background: rgba(239,68,68,0.2); color: #f87171;' : '' }}
                        ">{{ ucfirst(str_replace('_', ' ', $cmd->statut)) }}</span></td>
                        <td style="color: #71717a;">{{ $cmd->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="6" style="text-align: center; color: #71717a;">Aucune commande</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $commandes->links() }}
</div>
@endsection
