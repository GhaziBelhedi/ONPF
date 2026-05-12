<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['nom', 'quantite_magasin', 'quantite_centrale', 'seuil_minimum'];

    public function demandes()
    {
        return $this->hasMany(Demande::class);
    }

    public function isLowStock()
    {
        return $this->quantite_magasin < $this->seuil_minimum;
    }
}
