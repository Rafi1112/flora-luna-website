<?php

namespace App\Http\Controllers\RolePermission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::get();
        $permission = new Permission();
        return view('dashboard.role-permission.permission.index', compact('permissions', 'permission'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'permission_name' => 'required',
            'guard_name' => 'required',
        ]);

        Permission::create([
            'name' => $request->permission_name,
            'guard_name' => $request->guard_name ?? 'web',
        ]);

        return redirect()->back()->with("success", "New Permission has been created.");
    }

    public function edit(Permission $permission)
    {
        return view('dashboard.role-permission.permission.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'permission_name' => 'required',
            'guard_name' => 'required'
        ]);

        $permission->update([
            'name' => $request->permission_name,
            'guard_name' => $request->guard_name,
        ]);

        return redirect()->route('permission.index')->with("success", "Permission ' {$permission->name} ' has been updated.");
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->back()->with("success", "Permission has been deleted.");
    }
}
