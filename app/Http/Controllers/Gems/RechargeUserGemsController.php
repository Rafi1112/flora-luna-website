<?php

namespace App\Http\Controllers\Gems;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
        Log::info($request->amount . ' Gems has been added to username: ' . $user->username . '. Recharged by ' . Auth::user()->username);
        return redirect()->back()->with("success", "Success add {$request->amount} gems to {$user->username}");
    }
}
