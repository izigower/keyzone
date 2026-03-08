<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentaireController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'contenu' => 'required|string|min:3|max:500',
            'note' => 'nullable|integer|min:1|max:5',
        ]);

        // Check if user already commented on this product
        $existing = Commentaire::where('user_id', Auth::id())
            ->where('produit_id', $validated['produit_id'])
            ->first();

        if ($existing) {
            $existing->update([
                'contenu' => $validated['contenu'],
                'note' => $validated['note'],
            ]);
            return redirect()->back()->with('success', 'Commentaire mis à jour.');
        }

        Commentaire::create([
            'user_id' => Auth::id(),
            'produit_id' => $validated['produit_id'],
            'contenu' => strip_tags($validated['contenu']),
            'note' => $validated['note'],
        ]);

        return redirect()->back()->with('success', 'Commentaire ajouté !');
    }

    public function destroy($id)
    {
        $commentaire = Commentaire::where('id', $id)
            ->where(function ($q) {
                $q->where('user_id', Auth::id())
                  ->orWhereHas('user', function ($q2) {
                      // Admin can delete any
                  });
            })->firstOrFail();

        if (Auth::user()->isAdmin() || $commentaire->user_id === Auth::id()) {
            $commentaire->delete();
            return redirect()->back()->with('success', 'Commentaire supprimé.');
        }

        abort(403);
    }
}
