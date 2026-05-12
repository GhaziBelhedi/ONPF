<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'direction_centrale') {
            abort(403, 'Action non autorisée.');
        }
        return view('articles.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'direction_centrale') {
            abort(403, 'Action non autorisée.');
        }

        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:articles',
            'quantite_magasin' => 'required|integer|min:0',
            'quantite_centrale' => 'required|integer|min:0',
            'seuil_minimum' => 'required|integer|min:0',
        ]);

        Article::create($validated);

        return redirect()->route('articles.index')->with('success', 'Article créé avec succès.');
    }
}
