<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'utilisateur_id',
        'type',
        'titre',
        'message',
        'lu_at',
        'canal',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
        'lu_at' => 'datetime',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class);
    }
}