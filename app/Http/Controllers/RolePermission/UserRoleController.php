<?php

namespace App\Http\Controllers\RolePermission;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        $roles = Role::get();
        return view('dashboard.role-permission.user-role.index', compact('users', 'roles'));
    }

    public function sync(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'roles' => 'required|array'
        ]);

        try {
            $user = User::where('username', $request->username)->first();
            Role::findOrFail($request->roles);

            if (!$user) return redirect()->back()->with("error", "User with username ' {$request->username} ' is not found.");

            $user->syncRoles($request->roles);
            return redirect()->back()->with("success", "Role has been assigned to user ' {$user->username} '");

        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with("error", "Something went wrong.");
        }
    }
}
