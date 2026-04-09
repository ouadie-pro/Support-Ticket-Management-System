<?php
// app/Models/Role.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'code',
        'libelle',
        'description',
    ];

    // Relations
    public function utilisateurs()
    {
        return $this->belongsToMany(Utilisateur::class, 'role_utilisateur')
                    ->withTimestamps();
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role')
                    ->withTimestamps();
    }
}