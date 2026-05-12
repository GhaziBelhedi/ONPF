<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\AdminDemandeController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\CentralDirectionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('articles.index');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('articles.index');
    })->name('dashboard');

    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/creer', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/demandes', [DemandeController::class, 'index'])->name('demandes.index');
    Route::get('/demandes/creer', [DemandeController::class, 'create'])->name('demandes.create');
    Route::post('/demandes', [DemandeController::class, 'store'])->name('demandes.store');

    // Admin Routes
    Route::get('/admin/demandes', [AdminDemandeController::class, 'index'])->name('admin.demandes.index');
    Route::post('/admin/demandes/{demande}/valider', [AdminDemandeController::class, 'valider'])->name('admin.demandes.valider');
    Route::post('/admin/demandes/{demande}/rejeter', [AdminDemandeController::class, 'rejeter'])->name('admin.demandes.rejeter');
    Route::get('/admin/commandes', [CommandeController::class, 'index'])->name('admin.commandes.index');

    // Magasinier Commandes (Bons de Sortie)
    Route::get('/mes-bons-de-sortie', [CommandeController::class, 'mesBonsDeSortie'])->name('magasinier.commandes.index');
    Route::post('/commandes/{commande}/confirmer', [CommandeController::class, 'confirmer'])->name('magasinier.commandes.confirmer');

    // Direction Centrale Routes
    Route::get('/central/commandes', [CentralDirectionController::class, 'index'])->name('central.commandes.index');
    Route::post('/central/commandes/{commande}/valider', [CentralDirectionController::class, 'valider'])->name('central.commandes.valider');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
