<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategorieTicket extends Model
{
    protected $fillable = [
        'code',
        'libelle',
        'sla_heures',
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'categorie_id');
    }

    public function sla()
    {
        return $this->hasOne(SLA::class, 'categorie_ticket_id');
    }
}