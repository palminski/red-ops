<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\MoviePick;
use App\Models\MovieRating;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{

    public function index()
    {
        $users = User::select('users.*')->where('disabled', false)
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

    public function show($id)
    {
        $movie = MoviePick::findOrFail($id);
        return view('movies.show')->with('movie', $movie);
    }

    public function rate($id, Request $request)
    {
        $request->validate([
            "rating" => "required|numeric|min:1|max:5"
        ]);
        $rating = MovieRating::where('user_id', '=', Auth::user()->id)->where("movie_pick_id", '=', $id)->first() ?? new MovieRating();
        $rating->user_id = Auth::user()->id;
        $rating->movie_pick_id = $id;
        $rating->rating = $request->input('rating');
        $rating->save();
        return redirect()->route('movies.show', ["id"=>$id]);
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
