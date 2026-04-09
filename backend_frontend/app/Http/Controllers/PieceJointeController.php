<?php

namespace App\Http\Controllers;

use App\Models\PieceJointe;
use Illuminate\Http\Request;

class PieceJointeController extends Controller
{
    public function index()
    {
        $pieceJointes = PieceJointe::all();
        return view('PieceJointe.index', compact('pieceJointes'));
    }

    public function create()
    {
        return view('PieceJointe.create');
    }

    public function store(Request $request)
    {
        PieceJointe::create($request->all());
        return redirect()->route('pieceJointes.index');
    }

    public function show(PieceJointe $pieceJointe)
    {
        return view('PieceJointe.show', compact('pieceJointe'));
    }

    public function edit(PieceJointe $pieceJointe)
    {
        return view('PieceJointe.edit', compact('pieceJointe'));
    }

    public function update(Request $request, PieceJointe $pieceJointe)
    {
        $pieceJointe->update($request->all());
        return redirect()->route('pieceJointes.show', $pieceJointe->id);
    }

    public function destroy(PieceJointe $pieceJointe)
    {
        $pieceJointe->delete();
        return redirect()->route('pieceJointes.index');
    }
}
