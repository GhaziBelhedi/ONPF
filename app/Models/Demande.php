<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    protected $fillable = ['article_id', 'user_id', 'quantite', 'statut', 'validated_by', 'validated_at'];

    protected $casts = [
        'validated_at' => 'datetime',
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function validator()
    {
        return $this->belongsTo(User::class, 'validated_by');
    }

    public function commande()
    {
        return $this->hasOne(Commande::class);
    }
}
