<?php

namespace App\Http\Controllers;

use App\Models\BaseConnaissance;
use Illuminate\Http\Request;

class BaseConnaissanceController extends Controller
{
    public function index()
    {
        return BaseConnaissance::with(['categorie','auteur'])->get();
    }

    public function store(Request $request)
    {
        return BaseConnaissance::create($request->all());
    }

    public function show(BaseConnaissance $baseConnaissance)
    {
        return $baseConnaissance;
    }

    public function update(Request $request, BaseConnaissance $baseConnaissance)
    {
        $baseConnaissance->update($request->all());
        return $baseConnaissance;
    }

    public function destroy(BaseConnaissance $baseConnaissance)
    {
        $baseConnaissance->delete();
        return response()->json(['message'=>'Deleted']);
    }
}