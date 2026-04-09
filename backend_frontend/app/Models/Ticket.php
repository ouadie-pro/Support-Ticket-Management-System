<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Ticket extends Model
{
    protected $fillable = [
        'numero',
        'client_id',
        'sujet',
        'description',
        'priorite',
        'statut',
        'categorie_id',
        'assigne_a',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($ticket) {
            if (!$ticket->numero) {
                $ticket->numero = 'TCK-'.Str::upper(Str::random(8));
            }
        });
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function categorie()
    {
        return $this->belongsTo(CategorieTicket::class, 'categorie_id');
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'assigne_a');
    }

    public function commentaires()
    {
        return $this->hasMany(CommentaireTicket::class);
    }

    public function historiques()
    {
        return $this->hasMany(HistoriqueTicket::class);
    }
}