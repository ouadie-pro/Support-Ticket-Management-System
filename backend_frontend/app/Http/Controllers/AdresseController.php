<?php

namespace App\Http\Controllers;

use App\Models\Adresse;
use Illuminate\Http\Request;

class AdresseController extends Controller
{
    public function index()
    {
        return Adresse::all();
    }

    public function store(Request $request)
    {
        return Adresse::create($request->all());
    }

    public function show(Adresse $adresse)
    {
        return $adresse;
    }

    public function update(Request $request, Adresse $adresse)
    {
        $adresse->update($request->all());
        return $adresse;
    }

    public function destroy(Adresse $adresse)
    {
        $adresse->delete();
        return response()->json(['message'=>'Deleted']);
    }
}