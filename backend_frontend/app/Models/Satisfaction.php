<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Satisfaction extends Model
{
    protected $fillable = [
        'ticket_id',
        'note',
        'commentaire',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}