<?php

namespace App\Http\Controllers;

use App\Models\CategorieTicket;
use Illuminate\Http\Request;

class CategorieTicketController extends Controller
{
    public function index()
    {
        $categorieTickets = CategorieTicket::all();
        return view('categorieTickets.index', compact('categorieTickets'));
    }

    public function create()
    {
        return view('categorieTickets.create');
    }

    public function store(Request $request)
    {
        CategorieTicket::create($request->all());
        return redirect()->route('categorieTickets.index');
    }

    public function show(CategorieTicket $categorieTicket)
    {
        return view('categorieTickets.show', compact('categorieTicket'));
    }

    public function edit(CategorieTicket $categorieTicket)
    {
        return view('categorieTickets.edit', compact('categorieTicket'));
    }

    public function update(Request $request, CategorieTicket $categorieTicket)
    {
        $categorieTicket->update($request->all());
        return redirect()->route('categorieTickets.show', $categorieTicket->id);
    }

    public function destroy(CategorieTicket $categorieTicket)
    {
        $categorieTicket->delete();
        return redirect()->route('categorieTickets.index');
    }
}
