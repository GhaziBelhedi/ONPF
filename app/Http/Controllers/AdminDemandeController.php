<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Demande;
use App\Models\Commande;

class AdminDemandeController extends Controller
{
    public function index()
    {
        $demandes = Demande::with(['article', 'user'])->latest()->get();
        return view('admin.demandes.index', compact('demandes'));
    }

    public function valider(Request $request, Demande $demande)
    {
        if ($demande->statut !== 'en attente') {
            return back()->with('error', 'Cette demande a déjà été traitée.');
        }

        $validatedQuantity = $request->input('quantite_approuvee', $demande->quantite);

        $demande->update([
            'statut' => 'validée',
            'validated_by' => auth()->id(),
            'validated_at' => now(),
        ]);

        // Créer automatiquement la commande (En attente de la Direction Centrale)
        Commande::create([
            'demande_id' => $demande->id,
            'article_id' => $demande->article_id,
            'quantite' => $validatedQuantity,
            'statut' => 'en_attente_direction',
        ]);

        return back()->with('success', 'Demande validée avec une quantité de ' . $validatedQuantity . ' et envoyée à la Direction Centrale.');
    }

    public function rejeter(Demande $demande)
    {
        if ($demande->statut !== 'en attente') {
            return back()->with('error', 'Cette demande a déjà été traitée.');
        }

        $demande->update([
            'statut' => 'rejetée',
            'validated_by' => auth()->id(),
            'validated_at' => now(),
        ]);

        return back()->with('success', 'Demande rejetée.');
    }
}
