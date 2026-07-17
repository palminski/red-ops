<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

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
            "rating" => "required|numeric|min:0|max:10",
            "review" => "required|string|max:280"
        ]);
        $rating = MovieRating::where('user_id', '=', Auth::user()->id)->where("movie_pick_id", '=', $id)->first() ?? new MovieRating();
        $rating->user_id = Auth::user()->id;
        $rating->movie_pick_id = $id;
        $rating->rating = $request->input('rating');
        $rating->review = $request->input('review');
        $rating->save();
        return redirect()->route('movies.show', ["id"=>$id]);
    }

    public function omdbRating($id)
    {
        $movie = MoviePick::findOrFail($id);

        $cacheKey = "omdb-rating-{$id}";
        $result = Cache::get($cacheKey);

        if ($result === null) {
            $response = Http::get('https://www.omdbapi.com/', [
                'apikey' => config('services.omdb.key'),
                't' => $movie->movie_title,
            ]);

            if (! $response->ok() || ($response->json('Response') !== 'True')) {
                $result = ['found' => false];
                Cache::put($cacheKey, $result, now()->addMinutes(10));
            } else {
                $rottenTomatoes = collect($response->json('Ratings', []))
                    ->firstWhere('Source', 'Rotten Tomatoes');
                $imdbRating = collect($response->json('Ratings', []))
                    ->firstWhere('Source', 'Internet Movie Database');

                $result = [
                    'found' => true,
                    'title' => $response->json('Title'),
                    'year' => $response->json('Year'),
                    'rottenTomatoes' => $rottenTomatoes['Value'] ?? null,
                    'imdbRating' => $imdbRating['Value'] ?? null,
                ];
                Cache::put($cacheKey, $result, now()->addDay());
            }
        }

        return response()->json($result);
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
