<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $users = User::orderBy('name')->get();
        return view('users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::where('id', '=', $id)->firstOrFail();
        return view('users.profile', compact('user'));
    }

    public function edit($id)
    {
        $user = User::where('id', '=', $id)->firstOrFail();

        if(Auth::user() != $user && !Auth::user()->is_admin){
            abort(403, 'Users can only edit their own profiles.');
        }
        return view('users.edit', compact('user'));
    }
}
