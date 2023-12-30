<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function addUser(Request $request) {

        if (!$this->validateNewUser($request)) {
            return redirect()->back()->with("error-message", "A user already exists with that username")->withInput();
        }

        $user = new User();
        $user->username = $request->username;
        $user->hashed_password = Hash::make($request->username);
        $user->save();
        return redirect(route('home'));
    }

    private function validateNewUser($requestInfo) {
        $validator = Validator::make($requestInfo->all(), [
            'username' => 'required|unique:users',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return false;
        }
        return true;
    }
}
