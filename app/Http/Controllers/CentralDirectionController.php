<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Article;
use Illuminate\Http\Request;

class CentralDirectionController extends Controller
{
    public function index()
    {
        $commandes = Commande::with(['article', 'demande.user'])->latest()->get();
       
        $stats = [
            'en_attente_direction' => Commande::where('statut', 'en_attente_direction')->count(),
            'en_attente_confirmation' => Commande::where('statut', 'en attente de confirmation')->count(),
            'confirmees' => Commande::where('statut', 'confirmée')->count(),
        ];

        return view('central.commandes.index', compact('commandes', 'stats'));
    }

    public function valider(Request $request, Commande $commande)
    {
        if ($commande->statut !== 'en_attente_direction') {
            return back()->with('error', 'Cette commande a déjà été traitée par la Direction Centrale.');
        }

        $validatedQuantity = $request->input('quantite_finale', $commande->quantite);

        $commande->update([
            'statut' => 'en attente de confirmation',
            'quantite' => $validatedQuantity
        ]);

        $commande->article->decrement('quantite_centrale', $validatedQuantity);

        return back()->with('success', 'Commande validée et transmise au magasinier pour réception.');
    }
}
