<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Escalade extends Model
{
    protected $fillable = [
        'ticket_id',
        'niveau',
        'motif',
        'escalade_a',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'escalade_a');
    }
}