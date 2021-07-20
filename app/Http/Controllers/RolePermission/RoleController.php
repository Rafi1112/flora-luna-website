<?php

namespace App\Http\Controllers\RolePermission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::get();
        $role = new Role();
        return view('dashboard.role-permission.role.index', compact('roles', 'role'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'role_name' => 'required',
            'guard_name' => 'required',
        ]);

        Role::create([
            'name' => $request->role_name,
            'guard_name' => $request->guard_name ?? 'web',
        ]);

        return redirect()->back()->with("success", "New Role has been created.");
    }

    public function edit(Role $role)
    {
        return view('dashboard.role-permission.role.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'role_name' => 'required',
            'guard_name' => 'required'
        ]);

        $role->update([
            'name' => $request->role_name
        ]);

        return redirect()->route('role.index')->with("success", "Role '{$role->name}' has been updated.");
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->back()->with("success", "Role has been deleted.");
    }
}
