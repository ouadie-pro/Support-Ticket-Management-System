<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoriqueTicket extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'ticket_id',
        'ancien_statut',
        'nouveau_statut',
        'change_par',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'change_par');
    }
}