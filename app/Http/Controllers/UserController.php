<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show')
        ->with('user', $user);
    }

    public function addUser(Request $request)
    {

        $validator = $this->validateNewUser($request);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->username = $request->username;
        $user->hashed_password = Hash::make($request->password);
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
