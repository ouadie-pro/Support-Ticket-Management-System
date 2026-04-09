<?php

namespace App\Http\Controllers;

use App\Models\Satisfaction;
use Illuminate\Http\Request;

class SatisfactionController extends Controller
{
    public function index()
    {
        $satisfactions = Satisfaction::with('ticket')->get();
        return view('satisfactions.index', compact('satisfactions'));
    }

    public function create()
    {
        return view('satisfactions.create');
    }

    public function store(Request $request)
    {
        Satisfaction::create($request->all());
        return redirect()->route('satisfactions.index');
    }

    public function show(Satisfaction $satisfaction)
    {
        return view('satisfactions.show', compact('satisfaction'));
    }

    public function edit(Satisfaction $satisfaction)
    {
        return view('satisfactions.edit', compact('satisfaction'));
    }

    public function update(Request $request, Satisfaction $satisfaction)
    {
        $satisfaction->update($request->all());
        return redirect()->route('satisfactions.show', $satisfaction->id);
    }

    public function destroy(Satisfaction $satisfaction)
    {
        $satisfaction->delete();
        return redirect()->route('satisfactions.index');
    }
}
