<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adresse extends Model
{
    protected $fillable = [
        'pays',
        'ville',
        'quartier',
        'rue',
        'code_postal',
        'latitude',
        'longitude',
    ];
}