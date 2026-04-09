<?php

namespace App\Http\Controllers;

use App\Models\ReponsePredefinie;
use Illuminate\Http\Request;

class ReponsePredefinieController extends Controller
{
    public function index()
    {
        $reponsePredefinies = ReponsePredefinie::with('auteur')->get();
        return view('ReponsePredefinie.index', compact('reponsePredefinies'));
    }

    public function create()
    {
        return view('ReponsePredefinie.create');
    }

    public function store(Request $request)
    {
        ReponsePredefinie::create($request->all());
        return redirect()->route('reponsePredefinies.index');
    }

    public function show(ReponsePredefinie $reponsePredefinie)
    {
        return view('ReponsePredefinie.show', compact('reponsePredefinie'));
    }

    public function edit(ReponsePredefinie $reponsePredefinie)
    {
        return view('ReponsePredefinie.edit', compact('reponsePredefinie'));
    }

    public function update(Request $request, ReponsePredefinie $reponsePredefinie)
    {
        $reponsePredefinie->update($request->all());
        return redirect()->route('reponsePredefinies.show', $reponsePredefinie->id);
    }

    public function destroy(ReponsePredefinie $reponsePredefinie)
    {
        $reponsePredefinie->delete();
        return redirect()->route('reponsePredefinies.index');
    }
}
