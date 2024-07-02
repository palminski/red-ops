@extends('layouts.layout')

@section('title')
    Movies
@endsection

@section('content')
    <div class="block">
        <h1>Movie Queue</h1>

    </div>
    <br>
    <div class="block">
        <h1>Current Queue</h1>
        
        <ul class="movie-queue">
            @foreach ($users as $user)
            @if ($user->disabled)
                @continue
            @endif
                @if ($user == Auth::user())
                    <li class="highlight">
                        
                        <span> {{ ucfirst($user->username) }}</span>
                                <br>
                                <form method="POST" action={{ route('movie.pick') }}>
                                    @csrf
                                    <input type="hidden" name="userId" value={{ Auth::user()->id }}>
                                    <label for="movieTitle">Movie Title: </label>
                                    <input type="text" name="movieTitle">
                                    <button>Pick Movie</button>
                                </form>

                    </li>
                @else
                
                    <li> {{ ucfirst($user->username) }}</li>
                @endif
            @endforeach
        </ul>
    </div>

    <br>
    <div class="block">
        <ul class="terminal">
            <li class="terminal-comment">// Red-Ops Terminal Injection</li>
            @foreach ($moviePicks as $moviePick)
                
                    <li >
                        <span>{{$moviePick->created_at}} => [<span class="highlight">{{ucfirst($moviePick->user->username)}}</span>  picked <span class="highlight">{{$moviePick->movie_title ? $moviePick->movie_title : 'CLASSIFIED'}}</span>] </span>
                    </li>

            @endforeach
        </ul>
    </div>
@endsection
