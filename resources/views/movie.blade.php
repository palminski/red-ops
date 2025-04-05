@extends('layouts.dark-with-nav')

@section('title')
    Movies
@endsection

@section('content')
    <section class="border-2 p-2 border-red-600 border-l-red-400 border-t-red-400 max-w-4xl bg-zinc-900 mb-8">
        <h1 class="text-xl font-bold p-1  bg-red-800">Current Queue</h1>
        <div class="text-red-300 p-1">
            <ul>
                @foreach ($users as $user)
                    <li class="flex justify-between">
                        <div>
                            {{ $loop->index + 1 }} - <a
                                href={{ route('users.show', ['id' => $user->id]) }}>{{ ucfirst($user->username) }}</a>
                        </div>
                        <div>
                            {{ $user->getAverageScore() ?? 'No Score' }} Average Rating
                        </div>


                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    <section class="border-2 border-red-600 border-l-red-400 border-t-red-400 max-w-4xl bg-zinc-900 mb-8">
        <h1 class="text-xl font-bold p-1 border-b-2 border-red-400 bg-red-800">Log Movie - {{ Auth::user()->username }}</h1>
        <div>
            <form method="POST" action={{ route('movie.pick') }} class="p-2 flex justify-between">
                @csrf
                <input type="hidden" name="userId" value={{ Auth::user()->id }}>

                <input name="movieTitle" id="text-entry" type="text"
                    class="text-entry text-red-400  px-3 py-1 bg-black border-2 border-red-900 focus:outline-none focus:border-red-900 placeholder-red-900 placeholder-opacity-75 mr-2"
                    placeholder="Movie Title">



                <button id="submit-button"
                    class="play-button right-10 top-0 bottom-0 px-3 py-1 font-bold border-2 bg-red-950 border-red-900 text-red-300 ">Log</button>



            </form>
        </div>
    </section>

    <section class="border-2 border-red-600 border-l-red-400 border-t-red-400 max-w-4xl bg-zinc-900">
        <h1 class="text-xl font-bold p-1 border-b-2 border-red-400 bg-red-800">Movie Log</h1>
        <ul class="text-red-300 p-1">
            @foreach ($moviePicks as $moviePick)
                <li class="my-2">
                    <span>{{ $moviePick->created_at }} => [<span class="highlight"><a
                                href={{ route('users.show', ['id' => $moviePick->user->id]) }}>{{ ucfirst($moviePick->user->username) }}</a></span>
                        picked <span class="highlight"><a
                                href={{ route('movies.show', ['id' => $moviePick->id]) }}>{{ $moviePick->movie_title ? $moviePick->movie_title : 'CLASSIFIED' }}</a></span>]
                        {{ $moviePick->getAverageRating() }} </span>
                </li>
            @endforeach
        </ul>
    </section>


    
@endsection
