@extends('layouts.layout')

@section('title')
    Red-Ops
@endsection

@section('content')
    @if (session('status'))
        <div class="block" style="background-color: rgb(255, 134, 134)">
            <h1 style="color: red">{{ session('status') }}</h1>
        </div>
    @endif
    <br>
    <div class="block" >
        <h1>Welcome to Red-Ops</h1>
        @if (Auth::check())
        <h2>Welcome Agent {{ucfirst(Auth::user()->username)}}.</h2>
        @else
        <h4><a href="{{route('login')}}">> Enter <</a></h4>
        @endif
        
    </div>
    
    <br>
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
