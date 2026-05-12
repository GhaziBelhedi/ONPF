<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $fillable = ['demande_id', 'article_id', 'quantite', 'statut', 'qualite_conforme', 'commentaire_magasinier', 'confirmed_at'];

    protected $casts = [
        'confirmed_at' => 'datetime',
        'qualite_conforme' => 'boolean',
    ];

    public function demande()
    {
        return $this->belongsTo(Demande::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
