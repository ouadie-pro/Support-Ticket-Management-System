<?php
namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UtilisateurController extends Controller
{
    public function index()
    {
        $utilisateurs = Utilisateur::with('roles')->get();
        return view('utilisateurs.index', compact('utilisateurs'));
    }

    public function create()
    {
        return view('utilisateurs.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['mot_de_passe'] = Hash::make($request->mot_de_passe);
        Utilisateur::create($data);
        return redirect()->route('utilisateurs.index');
    }

    public function show(Utilisateur $utilisateur)
    {
        return view('utilisateurs.show', compact('utilisateur'));
    }

    public function edit(Utilisateur $utilisateur)
    {
        return view('utilisateurs.edit', compact('utilisateur'));
    }

    public function update(Request $request, Utilisateur $utilisateur)
    {
        if ($request->filled('mot_de_passe')) {
            $request->merge([
                'mot_de_passe' => Hash::make($request->mot_de_passe)
            ]);
        }
        $utilisateur->update($request->all());
        return redirect()->route('utilisateurs.show', $utilisateur->id);
    }

    public function destroy(Utilisateur $utilisateur)
    {
        $utilisateur->delete();
        return redirect()->route('utilisateurs.index');
    }
}
