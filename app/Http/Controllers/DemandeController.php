<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemandeController extends Controller
{
    public function index()
    {
        $demandes = Demande::with(['article', 'commande'])->where('user_id', Auth::id())->latest()->get();
        return view('demandes.index', compact('demandes'));
    }

    public function create()
    {
        $articles = Article::all();
        return view('demandes.create', compact('articles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'article_id' => 'required|exists:articles,id',
            'quantite' => 'required|integer|min:1',
        ]);

        Demande::create([
            'article_id' => $request->article_id,
            'user_id' => Auth::id(),
            'quantite' => $request->quantite,
            'statut' => 'en attente',
        ]);

        return redirect()->route('demandes.index')->with('success', 'Demande créée avec succès.');
    }
}
