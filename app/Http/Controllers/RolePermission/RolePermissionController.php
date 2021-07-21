<?php

namespace App\Http\Controllers\RolePermission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::get();
        return view('dashboard.role-permission.sync.index', compact('roles', 'permissions'));
    }

    public function sync(Request $request)
    {
        $request->validate([
            'role' => 'required',
            'permissions' => 'required|array'
        ]);

        $role = Role::findOrFail($request->role);

        $role->syncPermissions($request->permissions);

        return redirect()->back()->with("success", "Permission has been assigned to Role ' {$role->name} '");
    }
}
