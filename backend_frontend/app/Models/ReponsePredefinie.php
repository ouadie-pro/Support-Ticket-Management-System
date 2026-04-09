<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReponsePredefinie extends Model
{
    protected $fillable = [
        'titre',
        'contenu',
        'created_by',
    ];

    public function auteur()
    {
        return $this->belongsTo(Utilisateur::class, 'created_by');
    }
}