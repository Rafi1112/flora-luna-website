<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    public function index()
    {
        return view('account.account');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore(Auth::user()->id) ],
            'name' => 'required'
        ]);

        Auth::user()->update([
            'email' => $request->email,
            'name' => $request->name,
        ]);

        return redirect()->back()->with("success", "Account has been updated.");
    }

    public function changePassword()
    {
        return view('account.change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed'
        ]);

        $userPassword = Auth::user()->getAuthPassword();
        $inputUserPassword = $request->current_password;

        if ( Hash::check($inputUserPassword, $userPassword) ) {
            Auth::user()->update([
                'password' => bcrypt($request->password)
            ]);
            return redirect()->back()->with("success", "Password has been changed.");
        }

        return redirect()->back()->withErrors(['current_password' => 'Wrong current password.']);
    }
}
