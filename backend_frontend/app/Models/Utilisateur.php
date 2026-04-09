<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Utilisateur extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'uuid',
        'nom',
        'prenom',
        'email',
        'telephone',
        'mot_de_passe',
        'etat',
        'derniere_connexion_at',
        'photo_url',
    ];

    protected $hidden = [
        'mot_de_passe',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->uuid) {
                $model->uuid = Str::uuid();
            }
        });
    }

    // Relations
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_utilisateur')
                    ->withTimestamps();
    }
}