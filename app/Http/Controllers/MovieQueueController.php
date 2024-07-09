<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\MoviePick;

class MovieQueueController extends Controller
{

    public function index()
    {

        $users = User::select('users.*')
                 ->leftJoin(DB::raw('(SELECT user_id, MAX(created_at) as latest_movie_pick FROM movie_picks GROUP BY user_id) as latest_picks'), 'users.id' , '=', 'latest_picks.user_id')
                 ->orderBy('latest_picks.latest_movie_pick', 'asc')
                 ->get();

        $moviePicks = MoviePick::all()
                ->sortByDesc('created_at');
        // dd($users);

        return view('movie',[])
        ->with('users', $users)
        ->with('moviePicks', $moviePicks)
        ;
    }

    public function pickMovie(Request $request)
    {

        $userId = $request->input('userId');
        $movieTitle = $request->input('movieTitle');

        $moviePick = new MoviePick();
        $moviePick->user_id = $userId;
        $moviePick->movie_title = $movieTitle;
        $moviePick->save();
        // dd('hello');
        return redirect(route('movie-queue'));
    }

    
}
