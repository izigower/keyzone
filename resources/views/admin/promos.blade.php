@extends('layouts.app')
@section('title', 'Codes promo - Admin')
@section('content')
<div style="max-width: 1200px; margin: 2rem auto; padding: 0 2rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1 style="font-size: 2rem; color: #a78bfa;"><i class="fas fa-tag"></i> Codes promo</h1>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> Retour</a>
    </div>

    <div style="background: rgba(30, 33, 52, 0.7); border-radius: 12px; padding: 2rem; border: 1px solid rgba(139, 92, 246, 0.2); margin-bottom: 2rem;">
        <h3 style="color: #a78bfa; margin-bottom: 1rem;">Nouveau code promo</h3>
        <form method="POST" action="{{ route('admin.promos.store') }}">
            @csrf
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem;">
                <div class="form-group" style="margin:0"><label>Code</label><input type="text" name="code" class="form-control" required placeholder="DEMO2026"></div>
                <div class="form-group" style="margin:0"><label>Type</label><select name="type" class="form-control"><option value="pourcentage">Pourcentage (%)</option><option value="fixe">Montant fixe (&euro;)</option></select></div>
                <div class="form-group" style="margin:0"><label>Valeur</label><input type="number" name="valeur" step="0.01" class="form-control" required placeholder="20"></div>
                <div class="form-group" style="margin:0"><label>Max utilisations</label><input type="number" name="utilisations_max" class="form-control" placeholder="Illimité"></div>
                <div class="form-group" style="margin:0"><label>Date début</label><input type="date" name="date_debut" class="form-control"></div>
                <div class="form-group" style="margin:0"><label>Date fin</label><input type="date" name="date_fin" class="form-control"></div>
            </div>
            <button type="submit" class="btn btn-primary" style="margin-top: 1rem;">Créer le code</button>
        </form>
    </div>

    <div class="table-container" style="background: rgba(30, 33, 52, 0.7); border-radius: 12px;">
        <table>
            <thead><tr><th>Code</th><th>Type</th><th>Valeur</th><th>Utilisations</th><th>Validité</th><th>Statut</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse($promos as $p)
                    <tr>
                        <td style="font-weight: 700; color: #a78bfa;">{{ $p->code }}</td>
                        <td>{{ $p->type === 'pourcentage' ? 'Pourcentage' : 'Fixe' }}</td>
                        <td style="font-weight: 600;">{{ $p->type === 'pourcentage' ? $p->valeur . '%' : number_format($p->valeur, 2) . ' EUR' }}</td>
                        <td>{{ $p->utilisations_count }} / {{ $p->utilisations_max ?? '&infin;' }}</td>
                        <td style="color: #71717a; font-size: 0.85rem;">{{ $p->date_debut?->format('d/m/Y') ?? '-' }} → {{ $p->date_fin?->format('d/m/Y') ?? '-' }}</td>
                        <td>{!! $p->isValide() ? '<span style="color: #34d399;">Actif</span>' : '<span style="color: #f87171;">Inactif</span>' !!}</td>
                        <td>
                            <form method="POST" action="{{ route('admin.promos.destroy', $p->id) }}" onsubmit="return confirm('Supprimer ?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" style="text-align: center; color: #71717a;">Aucun code promo</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
