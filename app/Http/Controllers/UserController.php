<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index()
    {
        $users = User::count();
        return view('dashboard.user.index', compact('users'));
    }

    public function table()
    {
        $users = User::latest()->get();
        return DataTables::of($users)
            ->editColumn('balance', function ($user) {
                return '<div class="d-flex align-items-center">
                            '.$user->balance.'
                            <img src="'.asset('assets/media/gem-coin.png').'" alt="gem" class="ml-1">
                        </div>';
            })
            ->editColumn('created_at', function ($user) {
                return $user->created_at->format('d F Y, H:i');
            })
            ->rawColumns(['balance'])
            ->make();
    }
}
