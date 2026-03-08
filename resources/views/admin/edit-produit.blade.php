@extends('layouts.app')
@section('title', 'Modifier ' . $produit->nom . ' - Admin')
@section('content')
<div style="max-width: 1000px; margin: 2rem auto; padding: 0 2rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1 style="font-size: 2rem; color: #a78bfa;"><i class="fas fa-edit"></i> Modifier : {{ $produit->nom }}</h1>
        <a href="{{ route('admin.produits') }}" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> Retour</a>
    </div>

    <div style="display: grid; gap: 2rem;">
        <div style="background: rgba(30, 33, 52, 0.7); border-radius: 12px; padding: 2rem; border: 1px solid rgba(139, 92, 246, 0.2);">
            <h3 style="color: #a78bfa; margin-bottom: 1.5rem;">Informations du produit</h3>
            <form method="POST" action="{{ route('admin.produits.update', $produit->id) }}">
                @csrf @method('PUT')
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group" style="margin:0"><label>Nom</label><input type="text" name="nom" class="form-control" value="{{ $produit->nom }}" required></div>
                    <div class="form-group" style="margin:0"><label>Image URL</label><input type="text" name="image" class="form-control" value="{{ $produit->image }}"></div>
                    <div class="form-group" style="margin:0"><label>Prix (&euro;)</label><input type="number" name="prix" step="0.01" class="form-control" value="{{ $produit->prix }}" required></div>
                    <div class="form-group" style="margin:0"><label>Prix original (&euro;)</label><input type="number" name="prix_original" step="0.01" class="form-control" value="{{ $produit->prix_original }}"></div>
                    <div class="form-group" style="margin:0"><label>Catégorie</label><select name="categorie_id" class="form-control">@foreach($categories as $c)<option value="{{ $c->id }}" {{ $produit->categorie_id == $c->id ? 'selected' : '' }}>{{ $c->nom }}</option>@endforeach</select></div>
                    <div class="form-group" style="margin:0"><label>Plateforme</label><select name="plateforme_id" class="form-control">@foreach($plateformes as $p)<option value="{{ $p->id }}" {{ $produit->plateforme_id == $p->id ? 'selected' : '' }}>{{ $p->nom }}</option>@endforeach</select></div>
                    <div class="form-group" style="margin:0"><label>Badge</label><input type="text" name="badge" class="form-control" value="{{ $produit->badge }}"></div>
                    <div class="form-group" style="margin:0"><label>PEGI</label><input type="number" name="age_rating" class="form-control" value="{{ $produit->age_rating }}"></div>
                </div>
                <div class="form-group"><label>Description</label><textarea name="description" class="form-control" rows="3">{{ $produit->description }}</textarea></div>
                <div class="form-group">
                    <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" {{ $produit->is_active ? 'checked' : '' }} style="accent-color: #8b5cf6;"> Produit actif
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Sauvegarder</button>
            </form>
        </div>

        <!-- Game Keys -->
        <div style="background: rgba(30, 33, 52, 0.7); border-radius: 12px; padding: 2rem; border: 1px solid rgba(139, 92, 246, 0.2);">
            <h3 style="color: #34d399; margin-bottom: 1rem;"><i class="fas fa-key"></i> Clés de jeu ({{ $produit->cles->where('statut', 'disponible')->count() }} disponibles / {{ $produit->cles->count() }} total)</h3>
            <form method="POST" action="{{ route('admin.cles.store', $produit->id) }}">
                @csrf
                <div class="form-group">
                    <label>Ajouter des clés (une par ligne)</label>
                    <textarea name="cles" class="form-control" rows="5" placeholder="XXXXX-XXXXX-XXXXX&#10;YYYYY-YYYYY-YYYYY&#10;ZZZZZ-ZZZZZ-ZZZZZ"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Ajouter les clés</button>
            </form>

            @if($produit->cles->count() > 0)
                <div style="margin-top: 2rem;">
                    <h4 style="color: #94a3b8; margin-bottom: 1rem;">Clés existantes</h4>
                    <div style="max-height: 300px; overflow-y: auto;">
                        @foreach($produit->cles->sortByDesc('created_at') as $cle)
                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.5rem; border-bottom: 1px solid rgba(139,92,246,0.1);">
                                <code style="color: {{ $cle->statut === 'disponible' ? '#34d399' : '#f87171' }};">{{ $cle->cle }}</code>
                                <span style="font-size: 0.8rem; padding: 0.2rem 0.5rem; border-radius: 4px;
                                    {{ $cle->statut === 'disponible' ? 'background: rgba(16,185,129,0.2); color: #34d399;' : '' }}
                                    {{ $cle->statut === 'vendue' ? 'background: rgba(239,68,68,0.2); color: #f87171;' : '' }}
                                ">{{ $cle->statut }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
