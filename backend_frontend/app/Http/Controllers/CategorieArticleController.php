<?php

namespace App\Http\Controllers;

use App\Models\CategorieArticle;
use Illuminate\Http\Request;

class CategorieArticleController extends Controller
{
    public function index()
    {
        return CategorieArticle::all();
    }

    public function store(Request $request)
    {
        return CategorieArticle::create($request->all());
    }

    public function update(Request $request, CategorieArticle $categorieArticle)
    {
        $categorieArticle->update($request->all());
        return $categorieArticle;
    }

    public function destroy(CategorieArticle $categorieArticle)
    {
        $categorieArticle->delete();
        return response()->json(['message'=>'Deleted']);
    }
}