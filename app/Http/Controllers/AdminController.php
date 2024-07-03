<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\MoviePick;

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
        $request->input("disabled");
        $user = User::findOrFail($id);
        
        $user->disabled = $request->input("disabled") ? true : false;
            
        $user->save();
        
        return redirect()->route('admin.showUser', ['id'=>$id]);
    }
}
