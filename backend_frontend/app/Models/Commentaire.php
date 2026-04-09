<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commentaire extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'utilisateur_id',
        'objet_type',
        'objet_id',
        'contenu',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class);
    }

    public function objet()
    {
        return $this->morphTo();
    }
}