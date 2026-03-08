@extends('layouts.app')
@section('title', 'Produits - Admin')
@section('content')
<div style="max-width: 1400px; margin: 2rem auto; padding: 0 2rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1 style="font-size: 2rem; color: #a78bfa;"><i class="fas fa-gamepad"></i> Produits</h1>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> Retour</a>
    </div>

    <div style="background: rgba(30, 33, 52, 0.7); border-radius: 12px; padding: 2rem; border: 1px solid rgba(139, 92, 246, 0.2); margin-bottom: 2rem;">
        <h3 style="color: #a78bfa; margin-bottom: 1rem;">Nouveau produit</h3>
        <form method="POST" action="{{ route('admin.produits.store') }}">
            @csrf
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group" style="margin:0"><label>Nom</label><input type="text" name="nom" class="form-control" required></div>
                <div class="form-group" style="margin:0"><label>Image URL</label><input type="text" name="image" class="form-control" placeholder="https://..."></div>
                <div class="form-group" style="margin:0"><label>Prix (&euro;)</label><input type="number" name="prix" step="0.01" class="form-control" required></div>
                <div class="form-group" style="margin:0"><label>Prix original (&euro;)</label><input type="number" name="prix_original" step="0.01" class="form-control"></div>
                <div class="form-group" style="margin:0"><label>Catégorie</label><select name="categorie_id" class="form-control" required>@foreach($categories as $c)<option value="{{ $c->id }}">{{ $c->nom }}</option>@endforeach</select></div>
                <div class="form-group" style="margin:0"><label>Plateforme</label><select name="plateforme_id" class="form-control" required>@foreach($plateformes as $p)<option value="{{ $p->id }}">{{ $p->nom }}</option>@endforeach</select></div>
                <div class="form-group" style="margin:0"><label>Badge</label><input type="text" name="badge" class="form-control" placeholder="Ex: Nouveau, Best-seller"></div>
                <div class="form-group" style="margin:0"><label>PEGI</label><input type="number" name="age_rating" class="form-control" value="0" min="0" max="18"></div>
            </div>
            <div class="form-group"><label>Description</label><textarea name="description" class="form-control" rows="2"></textarea></div>
            <button type="submit" class="btn btn-primary">Créer le produit</button>
        </form>
    </div>

    <div class="table-container" style="background: rgba(30, 33, 52, 0.7); border-radius: 12px;">
        <table>
            <thead><tr><th>Image</th><th>Nom</th><th>Prix</th><th>Catégorie</th><th>Plateforme</th><th>Clés dispo</th><th>Actions</th></tr></thead>
            <tbody>
                @foreach($produits as $p)
                    <tr>
                        <td><img src="{{ $p->image ?? 'https://via.placeholder.com/50' }}" style="width: 60px; height: 35px; object-fit: cover; border-radius: 4px;"></td>
                        <td style="font-weight: 600;">{{ $p->nom }}</td>
                        <td style="color: #a78bfa;">{{ number_format($p->prix, 2) }} &euro;</td>
                        <td style="color: #94a3b8;">{{ $p->categorie->nom ?? '-' }}</td>
                        <td>{{ $p->plateforme->nom ?? '-' }}</td>
                        <td><span style="color: {{ $p->cles_disponibles_count > 0 ? '#34d399' : '#f87171' }}; font-weight: 600;">{{ $p->cles_disponibles_count }}</span></td>
                        <td>
                            <div style="display: flex; gap: 0.3rem;">
                                <a href="{{ route('admin.produits.edit', $p->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                <form method="POST" action="{{ route('admin.produits.destroy', $p->id) }}" onsubmit="return confirm('Supprimer ?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $produits->links() }}
</div>
@endsection
