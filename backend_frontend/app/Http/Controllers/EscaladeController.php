<?php

namespace App\Http\Controllers;

use App\Models\Escalade;
use Illuminate\Http\Request;

class EscaladeController extends Controller
{
    public function index()
    {
        return Escalade::with(['ticket','utilisateur'])->get();
    }

    public function store(Request $request)
    {
        return Escalade::create($request->all());
    }

    public function show(Escalade $escalade)
    {
        return $escalade;
    }

    public function destroy(Escalade $escalade)
    {
        $escalade->delete();
        return response()->json(['message'=>'Deleted']);
    }
}