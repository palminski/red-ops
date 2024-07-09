@extends('layouts.layout')

@section('title')
    Movie
@endsection

@section('content')
    {{-- @dd($movie) --}}
    <h1 class="text-6xl libre-barcode-39-text-regular mb-8 text-center text-red-600 animate-pulse">{{$movie->movie_title ?? "CLASIFIED"}}</h1>
    <hr class="border-red-600 animate-pulse">
    <div class="text-red-600 animate-pulse text-2xl pt-6">
        <div class="text-center">
            Picked On <span class="text-red-400">[{{$movie->created_at}}]</span> by agent <span class="text-red-400"> <a href={{ route('users.show', ['id'=>$movie->user->id]) }}> [{{$movie->user->username}}] </a></span>
        </div>
        
    </div>

    <div class="text-red-600 animate-pulse  py-6">
        <div class="text-center">
            <div class="text-center text-2xl">
                Average Rating: <span class="text-red-400">[{{$movie->getAverageRating() ?? "Not Rated"}}]</span>
            </div>
            @forEach($movie->movieRatings as $rating)
                Rated <span class="text-red-400">[{{$rating->rating}}]</span> by agent <span class="text-red-400"> <a href={{ route('users.show', ['id'=>$movie->user->id]) }}> [{{$rating->user->username}}] </a></span>
            @endforeach
        </div>
    </div>
    <hr class="border-red-600 animate-pulse">
    <div class="text-red-600 animate-pulse text-2xl pt-6">
        <div class="text-center">
            <form method="POST" action={{ route('movies.rate', ['id'=>$movie->id]) }}>
                @csrf
                <label for="rating">Rate: </label>
                <input type="number" name="rating" id="rating" min="0" max="5" step="0.5" class="border-2 border-red-600 bg-black" value={{$movie->movieRatings->firstWhere('user_id', Auth::user()->id)->rating ?? "0"}} required>
                <button class="border-2 border-red-600 px-4">Submit</button>
            </form>
        </div>
    </div>

@endsection
