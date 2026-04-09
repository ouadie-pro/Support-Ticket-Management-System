<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JournalActivite extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'utilisateur_id',
        'action',
        'objet_type',
        'objet_id',
        'ip',
        'user_agent',
        'donnees_avant',
        'donnees_apres',
    ];

    protected $casts = [
        'donnees_avant' => 'array',
        'donnees_apres' => 'array',
        'created_at' => 'datetime',
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