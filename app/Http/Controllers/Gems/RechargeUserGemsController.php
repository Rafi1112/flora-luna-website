<?php

namespace App\Http\Controllers\Gems;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RechargeUserGemsController extends Controller
{
    public function index()
    {
        $users = User::get();
        return view('dashboard.gems.recharge.index', compact('users'));
    }

    public function recharge(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'amount' => 'required|integer|min:0'
        ]);

        $user = User::where('username', $request->username)->firstOrFail();
        $user->update([
            'balance' => $user->balance + $request->amount,
        ]);

        return redirect()->back()->with("success", "Success add {$request->amount} gems to {$user->username}");
    }
}
