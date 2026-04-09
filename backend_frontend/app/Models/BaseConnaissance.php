<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BaseConnaissance extends Model
{
    protected $fillable = [
        'titre',
        'slug',
        'contenu',
        'categorie_id',
        'statut',
        'created_by',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->slug) {
                $model->slug = Str::slug($model->titre);
            }
        });
    }

    public function categorie()
    {
        return $this->belongsTo(CategorieTicket::class, 'categorie_id');
    }

    public function auteur()
    {
        return $this->belongsTo(Utilisateur::class, 'created_by');
    }
}