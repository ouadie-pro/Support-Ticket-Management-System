<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategorieArticle extends Model
{
    protected $fillable = [
        'code',
        'libelle',
    ];

    public function articles()
    {
        return $this->hasMany(BaseConnaissance::class, 'categorie_id');
    }
}