<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\MoviePick;
use Illuminate\Support\Facades\Hash;

class adminController extends Controller
{

    public function index()
    {
        $users = User::get();
        return view('admin.index')
        ->with('users', $users);
    }

    public function showUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.show-user')
        ->with('user', $user);
    }

    public function updateUser(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        if($request->input("username_reset") !== $user->username)
        {
            $request->validate([
                "username_reset" => "required|unique:users,username|min:1"
            ]);
        }
        
        $user->disabled = $request->input("disabled") ? true : false;
        $user->username = $request->input("username_reset");
    
        if($request->input('password_reset')) {
            
            $user->hashed_password = Hash::make($request->input('password_reset'));
        } 
        $user->save();
        
        return redirect()->route('admin.showUser', ['id'=>$id]);
    }
}
