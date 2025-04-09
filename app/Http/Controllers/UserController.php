<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();
        return view('users.index')
        ->with('users', $users);
    }
    public function show($id)
    {
        $user = User::findOrFail($id);
        
        $moviePicks = $user->moviePicks->sortByDesc('created_at');
        // dd($moviePicks);

        return view('users.show')
        ->with('user', $user)
        ->with('moviePicks', $moviePicks);
    }

    public function updateProfilePicture($id, Request $request)
    {
        $request->validate([
            'profile_picture' => 'image|max:12288'
        ]);

        $user = Auth::user();
        // dd($user);
        if ($user->id !== $id)
        {
            abort(403);
        }

        if($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        $upload = $request->file('profile_picture');
        $image = Image::read($upload)->resize(500,500);
        $filename = uniqid().".".$upload->getClientOriginalExtension();

        Storage::disk('public')->put("profile_pictures/$filename", $image->encodeByExtension($upload->getClientOriginalExtension(), quality: 70));
        $user->profile_picture = "profile_pictures/$filename";
        $user->save();

        return redirect()->back()->with('success', 'profile picture updated!');
    }

    public function addUser(Request $request)
    {
        if ($request->input('secret_code') != env('SECRET_CODE'))
        {
            return redirect()->route('signup')->with('message', "Secret Code Incorrect! Contact Will");
        }
        $validator = $this->validateNewUser($request);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->username = $request->username;
        $user->hashed_password = Hash::make($request->password);
        $user->disabled = true;
        $user->save();

        return redirect(route('login'));
    }

    private function validateNewUser($requestInfo)
    {
        return Validator::make(
            $requestInfo->all(),
            [
                'username' => ['required', 'unique:users', 'string', 'alpha_dash', 'max:255'],
                'password' => ['required', 'string', 'min:8']
            ],
            [
                'username.unique' => 'An agent already exists with that username.',
                'username.alpha_dash' => 'A username may only consist of letter, numbers, dashes, and underscores',
                'password.min' => 'For maximum red ops security please make your password at least 8 characters long',
            ]
        );
    }
}
