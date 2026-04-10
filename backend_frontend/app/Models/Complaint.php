<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Complaint extends Model
{
    protected $fillable = [
        'numero',
        'user_id',
        'sujet',
        'description',
        'type',
        'priorite',
        'statut',
        'traite_par',
        'date_resolution',
        'resolution',
    ];

    protected $casts = [
        'date_resolution' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($complaint) {
            if (!$complaint->numero) {
                $complaint->numero = 'CPL-' . Str::upper(Str::random(8));
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'traite_par');
    }

    public function comments()
    {
        return $this->morphMany(Commentaire::class, 'objet');
    }
}
