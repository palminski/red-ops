<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\MoviePick;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class adminController extends Controller
{
    public function index()
    {
        $users = User::get();

        $moviePicks = MoviePick::all()
            ->sortByDesc('created_at');

        return view('admin.index')
            ->with('moviePicks', $moviePicks)
            ->with('users', $users);
    }

    public function showUser($id)
    {
        $user = User::findOrFail($id);
        $achievements = Achievement::get();

        return view('admin.show-user')
            ->with('achievements', $achievements)
            ->with('user', $user);
    }

    public function deleteMovie(Request $request)
    {
        $movie = MoviePick::findOrFail($request->input("movie_id"));
        $movie->delete();

        return redirect()->route('admin.index');

    }

    public function updateUser(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        if ($request->input('username_reset') !== $user->username) {
            $request->validate([
                'username_reset' => 'required|unique:users,username|min:1',
            ]);
        }

        $user->disabled = $request->input('disabled') ? true : false;
        $user->username = $request->input('username_reset');

        if ($request->input('password_reset')) {

            $user->hashed_password = Hash::make($request->input('password_reset'));
        }
        $user->save();

        return redirect()->route('admin.showUser', ['id' => $id]);
    }
}
