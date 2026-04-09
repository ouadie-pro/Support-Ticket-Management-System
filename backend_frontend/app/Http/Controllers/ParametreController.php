<?php

namespace App\Http\Controllers;

use App\Models\Parametre;
use Illuminate\Http\Request;

class ParametreController extends Controller
{
    public function index()
    {
        return Parametre::all();
    }

    public function store(Request $request)
    {
        return Parametre::create($request->all());
    }

    public function update(Request $request, Parametre $parametre)
    {
        $parametre->update($request->all());
        return $parametre;
    }
}