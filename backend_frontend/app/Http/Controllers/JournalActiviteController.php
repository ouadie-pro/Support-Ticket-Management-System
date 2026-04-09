<?php

namespace App\Http\Controllers;

use App\Models\JournalActivite;
use Illuminate\Http\Request;

class JournalActiviteController extends Controller
{
    public function index()
    {
        return JournalActivite::with('utilisateur')->get();
    }

    public function store(Request $request)
    {
        return JournalActivite::create($request->all());
    }

    public function show(JournalActivite $journalActivite)
    {
        return $journalActivite;
    }
}