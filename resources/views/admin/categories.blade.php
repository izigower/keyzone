@extends('layouts.app')
@section('title', 'Catégories - Admin')
@section('content')
<div style="max-width: 1200px; margin: 2rem auto; padding: 0 2rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1 style="font-size: 2rem; color: #a78bfa;"><i class="fas fa-folder"></i> Catégories</h1>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> Retour</a>
    </div>

    <div style="background: rgba(30, 33, 52, 0.7); border-radius: 12px; padding: 2rem; border: 1px solid rgba(139, 92, 246, 0.2); margin-bottom: 2rem;">
        <h3 style="color: #a78bfa; margin-bottom: 1rem;">Nouvelle catégorie</h3>
        <form method="POST" action="{{ route('admin.categories.store') }}" style="display: flex; gap: 1rem; align-items: flex-end; flex-wrap: wrap;">
            @csrf
            <div class="form-group" style="margin: 0; flex: 1; min-width: 200px;">
                <label>Nom</label>
                <input type="text" name="nom" class="form-control" required placeholder="Ex: Action, RPG...">
            </div>
            <div class="form-group" style="margin: 0; flex: 2; min-width: 200px;">
                <label>Description</label>
                <input type="text" name="description" class="form-control" placeholder="Description de la catégorie">
            </div>
            <button type="submit" class="btn btn-primary">Créer</button>
        </form>
    </div>

    <div class="table-container" style="background: rgba(30, 33, 52, 0.7); border-radius: 12px;">
        <table>
            <thead><tr><th>Nom</th><th>Slug</th><th>Produits</th><th>Actions</th></tr></thead>
            <tbody>
                @foreach($categories as $cat)
                    <tr>
                        <td>
                            <form method="POST" action="{{ route('admin.categories.update', $cat->id) }}" style="display: flex; gap: 0.5rem; align-items: center;">
                                @csrf @method('PUT')
                                <input type="text" name="nom" value="{{ $cat->nom }}" style="background: rgba(15,15,30,0.6); border: 1px solid rgba(139,92,246,0.2); border-radius: 4px; color: #fff; padding: 0.3rem 0.5rem; width: 150px;">
                                <input type="text" name="description" value="{{ $cat->description }}" style="background: rgba(15,15,30,0.6); border: 1px solid rgba(139,92,246,0.2); border-radius: 4px; color: #fff; padding: 0.3rem 0.5rem; width: 200px;">
                                <button type="submit" class="btn btn-primary btn-sm">Maj</button>
                            </form>
                        </td>
                        <td style="color: #71717a;">{{ $cat->slug }}</td>
                        <td><span style="color: #a78bfa; font-weight: 600;">{{ $cat->produits_count }}</span></td>
                        <td>
                            @unless($cat->is_default)
                                <form method="POST" action="{{ route('admin.categories.destroy', $cat->id) }}" style="display: inline;" onsubmit="return confirm('Supprimer cette catégorie ?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                </form>
                            @else
                                <span style="color: #71717a; font-size: 0.85rem;">Par défaut</span>
                            @endunless
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
