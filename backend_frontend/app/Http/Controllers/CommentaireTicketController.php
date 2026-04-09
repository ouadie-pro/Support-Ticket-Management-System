<?php

namespace App\Http\Controllers;

use App\Models\CommentaireTicket;
use Illuminate\Http\Request;

class CommentaireTicketController extends Controller
{
    public function index()
    {
        return CommentaireTicket::with(['ticket','utilisateur'])->get();
    }

    public function store(Request $request)
    {
        return CommentaireTicket::create($request->all());
    }

    public function show(CommentaireTicket $commentaireTicket)
    {
        return $commentaireTicket;
    }

    public function update(Request $request, CommentaireTicket $commentaireTicket)
    {
        $commentaireTicket->update($request->all());
        return $commentaireTicket;
    }

    public function destroy(CommentaireTicket $commentaireTicket)
    {
        $commentaireTicket->delete();
        return response()->json(['message'=>'Deleted']);
    }
}