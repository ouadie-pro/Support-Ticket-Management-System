<?php

namespace App\Http\Controllers;

use App\Models\HistoriqueTicket;
use Illuminate\Http\Request;

class HistoriqueTicketController extends Controller
{
    public function index()
    {
        return HistoriqueTicket::with('ticket')->get();
    }

    public function store(Request $request)
    {
        return HistoriqueTicket::create($request->all());
    }

    public function show(HistoriqueTicket $historiqueTicket)
    {
        return $historiqueTicket;
    }

    public function destroy(HistoriqueTicket $historiqueTicket)
    {
        $historiqueTicket->delete();
        return response()->json(['message'=>'Deleted']);
    }
}