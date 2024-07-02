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

    public function update(Request $request)
    {
        
        $usersToDisable = $request->input("disable");
        $users = User::get();
        foreach($users as $user)
        {
            $user->disabled = false;
            if (isset($usersToDisable[$user->id])) $user->disabled = true;
            $user->save();
        }
        return redirect()->route('admin.index');
    }
}
