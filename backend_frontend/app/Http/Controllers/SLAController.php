<?php

namespace App\Http\Controllers;

use App\Models\SLA;
use Illuminate\Http\Request;

class SLAController extends Controller
{
    public function index()
    {
        $slas = SLA::with('categorie')->get();
        return view('SLA.index', compact('slas'));
    }

    public function create()
    {
        return view('SLA.create');
    }

    public function store(Request $request)
    {
        SLA::create($request->all());
        return redirect()->route('slas.index');
    }

    public function show(SLA $sla)
    {
        return view('SLA.show', compact('sla'));
    }

    public function edit(SLA $sla)
    {
        return view('SLA.edit', compact('sla'));
    }

    public function update(Request $request, SLA $sla)
    {
        $sla->update($request->all());
        return redirect()->route('slas.show', $sla->id);
    }

    public function destroy(SLA $sla)
    {
        $sla->delete();
        return redirect()->route('slas.index');
    }
}
