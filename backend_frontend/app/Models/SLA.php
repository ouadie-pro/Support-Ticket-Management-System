<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SLA extends Model
{
    protected $fillable = [
        'categorie_ticket_id',
        'delai_premiere_reponse_h',
        'delai_resolution_h',
    ];

    public function categorie()
    {
        return $this->belongsTo(CategorieTicket::class, 'categorie_ticket_id');
    }
}