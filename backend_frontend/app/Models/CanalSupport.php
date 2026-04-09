<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CanalSupport extends Model
{
    protected $fillable = [
        'code',
        'libelle',
        'actif',
    ];
}