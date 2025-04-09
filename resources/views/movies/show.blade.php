@extends('layouts.dark')

@section('title')
    Movie
@endsection

@section('content')
    <main class="max-w-xl  lg:p mx-auto">
        {{-- Current Queue --}}
        <section class=" p-2 max-w-[550px]">
            <div class="bg-window-bright border-2 border-zinc-300 border-b-zinc-700 border-r-zinc-700 space-y-1">
                <header class="bg-redops-red-bright m-1 px-1 flex justify-between items-center">
                    <h1 class="text-red-100 text-xl">movie_info_{{ Str::limit($movie->movie_title, 40) ?? 'CLASIFIED' }}</h1>
                    <a class="bg-window-bright border-2 border-zinc-700 border-b-zinc-300 border-r-zinc-700 my-1 px-1"
                        href="{{route('movie-queue')}}">&#x2190; movie_index</a>
                </header>

                <div class="p-1 space-y-2">
                    <div>
                        <h1>Movie Stats</h1>
                        <div class="bg-window-bright border-2 border-zinc-700 border-b-zinc-300 border-r-zinc-700 w-full p-1 space-y-2">
                            <div>
                                Picked On <span class="">[{{ $movie->created_at->format('Y-m-d') }}]</span> by agent <span
                                    class="underline"> <a href={{ route('users.show', ['id' => $movie->user->id]) }}>
                                        {{ $movie->user->username }} </a></span>
                            </div>
                            <div>
                                Average Rating: <span class="">[{{ $movie->getAverageRating() ?? 'Not Rated' }}]
                            </div>
                        </div>
                    </div>
                    

                    @if (Auth::user())
                        <form method="POST" action={{ route('movies.rate', ['id' => $movie->id]) }}
                            class="flex flex-col justify-between">
                            @csrf
                            <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                            Rate Movie
                            <div class="bg-window-bright border-2 border-zinc-700 border-b-zinc-300 border-r-zinc-700 w-full p-1 space-y-2">
                                <div>
                                    <label for="movieTitle">Your Rating For
                                        {{ Str::limit($movie->movie_title, 25) ?? 'CLASIFIED' }}:</label>
                                    <input type="number" name="rating" id="rating" min="0" max="5"
                                        step="0.5"
                                        value={{ $movie->movieRatings->firstWhere('user_id', Auth::user()->id)->rating ?? '0' }}
                                        required class="w-full border border-zinc-700 px-1">
                                </div>
                                <button id="submit-button"
                                    class="bg-zinc-900 text-white px-2 border border-zinc-300 ">Log</button>
                            </div>
                        </form>
                    @endif

                    <div>
                        <h2>User Ratings</h2>
                        <ul
                            class="bg-zinc-950 border-2 border-zinc-700 border-b-zinc-300 border-r-zinc-700 w-full p-1 text-red-300 ">
                            @foreach ($movie->movieRatings as $rating)
                                <li class="my-2">
                                    [<a class="underline" href={{ route('users.show', ['id' => $rating->user->id]) }}>
                                        {{ $rating->user->username }} </a>] rated movie <span
                                        class="text-red-400">[{{ $rating->rating }}]</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>




    </main>
@endsection
