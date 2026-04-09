<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('Permission.index', compact('permissions'));
    }

    public function create()
    {
        return view('Permission.create');
    }

    public function store(Request $request)
    {
        Permission::create($request->all());
        return redirect()->route('permissions.index');
    }

    public function show(Permission $permission)
    {
        return view('Permission.show', compact('permission'));
    }

    public function edit(Permission $permission)
    {
        return view('Permission.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $permission->update($request->all());
        return redirect()->route('permissions.show', $permission->id);
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('permissions.index');
    }
}
