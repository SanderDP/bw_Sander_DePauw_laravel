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

    public function update(Request $request, $id)
    {
        $user = User::where('id', '=', $id)->firstOrFail();

        if(Auth::user() != $user && !Auth::user()->is_admin){
            abort(403, 'Users can only edit their own profiles.');
        }

        $validated = $request->validate([
            'name' => 'required|min:3',
            'about_me' => 'required|min:5',
            'birthday' => 'required',
        ]);

        if($request->hasFile('file')){
            
            $request->validate([
                'file' => 'mimes:png,jpg'
            ]);

            $request->file->store('users', 'public');
            $image_path = public_path('users'). '/' . $user->avatar;
            // unlink($image_path);                                                     should delete old image from storage/app/public/news but throws notFoundException

            $user->avatar = $request->file->hashName();
        }
        
        
        $user->name = $validated['name'];
        $user->about_me = $validated['about_me'];
        $user->birthday = $validated['birthday'];
        $user->save();

        return redirect()->route('users.show', $user->id)->with('status', 'Profile info updated');
    }

    public function promote($id)
    {
        $user = User::where('id', '=', $id)->firstOrFail();

        if(!Auth::user()->is_admin){
            abort(403, 'Only admins can promote users.');
        }

        $user->is_admin = true;
        $user->save();

        return redirect()->route('users.show', $user->id)->with('status', 'User promoted to admin');
    }

    public function demote($id)
    {
        $user = User::where('id', '=', $id)->firstOrFail();

        if(!Auth::user()->is_admin){
            abort(403, 'Only admins can demote users.');
        }

        $user->is_admin = false;
        $user->save();

        return redirect()->route('users.show', $user->id)->with('status', 'User admin status revoked');
    }
}
