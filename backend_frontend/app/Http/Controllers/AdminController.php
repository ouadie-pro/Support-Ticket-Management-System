<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ticket;
use App\Models\Complaint;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_tickets' => Ticket::count(),
            'total_complaints' => Complaint::count(),
            'tickets_ouverts' => Ticket::where('statut', 'ouvert')->count(),
            'tickets_en_cours' => Ticket::where('statut', 'en_cours')->count(),
            'tickets_resolus' => Ticket::where('statut', 'resolu')->count(),
            'complaints_soumis' => Complaint::where('statut', 'soumis')->count(),
            'complaints_en_cours' => Complaint::where('statut', 'en_cours')->count(),
            'complaints_resolus' => Complaint::where('statut', 'resolu')->count(),
        ];

        $tickets_par_mois = Ticket::select(
            DB::raw("strftime('%m', created_at) as mois"),
            DB::raw('COUNT(*) as total')
        )
        ->whereYear('created_at', date('Y'))
        ->groupBy('mois')
        ->orderBy('mois')
        ->get();

        $complaints_par_mois = Complaint::select(
            DB::raw("strftime('%m', created_at) as mois"),
            DB::raw('COUNT(*) as total')
        )
        ->whereYear('created_at', date('Y'))
        ->groupBy('mois')
        ->orderBy('mois')
        ->get();

        $tickets_recents = Ticket::with(['client', 'categorie'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $complaints_recents = Complaint::with(['user'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $users_par_role = User::select('role_id', DB::raw('COUNT(*) as total'))
            ->whereNotNull('role_id')
            ->groupBy('role_id')
            ->get()
            ->map(function ($item) {
                $role = Role::find($item->role_id);
                return (object) ['code' => $role ? $role->code : 'unknown', 'total' => $item->total];
            });

        return view('admin.dashboard', compact(
            'stats',
            'tickets_par_mois',
            'complaints_par_mois',
            'tickets_recents',
            'complaints_recents',
            'users_par_role'
        ));
    }

    public function users()
    {
        $users = User::with('role')->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function createUser()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role_id' => 'required|exists:roles,id',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role_id' => $validated['role_id'],
        ]);

        return redirect()->route('admin.users')->with('success', 'Utilisateur créé avec succès.');
    }

    public function editUser(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role_id' => 'required|exists:roles,id',
        ]);

        $user->update($validated);

        if ($request->filled('password')) {
            $user->update(['password' => bcrypt($request->password)]);
        }

        return redirect()->route('admin.users')->with('success', 'Utilisateur mis à jour.');
    }

    public function destroyUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Utilisateur supprimé.');
    }

    public function reports()
    {
        $tickets_par_priorite = Ticket::select('priorite', DB::raw('COUNT(*) as total'))
            ->groupBy('priorite')
            ->get();

        $complaints_par_type = Complaint::select('type', DB::raw('COUNT(*) as total'))
            ->groupBy('type')
            ->get();

        $tickets_par_statut = Ticket::select('statut', DB::raw('COUNT(*) as total'))
            ->groupBy('statut')
            ->get();

        $complaints_par_statut = Complaint::select('statut', DB::raw('COUNT(*) as total'))
            ->groupBy('statut')
            ->get();

        return view('admin.reports', compact(
            'tickets_par_priorite',
            'complaints_par_type',
            'tickets_par_statut',
            'complaints_par_statut'
        ));
    }

    public function settings()
    {
        return view('admin.settings');
    }
}
