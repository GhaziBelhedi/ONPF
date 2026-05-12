<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Commande;

class CommandeController extends Controller
{
    public function index()
    {
        $commandes = Commande::with(['article', 'demande.user'])->latest()->get();
        return view('admin.commandes.index', compact('commandes'));
    }

    public function mesBonsDeSortie()
    {
        $commandes = Commande::with('article')
            ->whereHas('demande', function($query) {
                $query->where('user_id', auth()->id());
            })
            ->latest()
            ->get();
        
        return view('magasinier.commandes.index', compact('commandes'));
    }

    public function confirmer(Request $request, Commande $commande)
    {
        if ($commande->demande->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'qualite_conforme' => 'required|boolean',
            'commentaire_magasinier' => 'nullable|string',
        ]);

        $commande->update([
            'statut' => 'confirmée',
            'qualite_conforme' => $request->qualite_conforme,
            'commentaire_magasinier' => $request->commentaire_magasinier,
            'confirmed_at' => now(),
        ]);

        // Incrémenter le stock si la qualité est conforme (réception de marchandises)
        if ($request->qualite_conforme) {
            $commande->article->increment('quantite_magasin', $commande->quantite);
            return back()->with('success', 'Bon de sortie confirmé et stock mis à jour (+'.$commande->quantite.').');
        } else {
            // Retourner la quantité au stock de la Direction Centrale
            $commande->article->increment('quantite_centrale', $commande->quantite);
            return back()->with('warning', 'Article refusé. La quantité a été retournée au stock de la Direction Centrale.');
        }
    }
}
