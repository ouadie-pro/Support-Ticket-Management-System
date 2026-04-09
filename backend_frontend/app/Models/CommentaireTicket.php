<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentaireTicket extends Model
{
    protected $fillable = [
        'ticket_id',
        'utilisateur_id',
        'message',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class);
    }
}