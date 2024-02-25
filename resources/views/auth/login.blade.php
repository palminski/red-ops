
@extends('layouts.layout')

@section('title')
    Log In
@endsection

@section('content')
<br>
<div class="block">
    <form class="auth-form" action="{{ route('login') }}" method="post">
        @csrf
        <h2>Log In</h2>
        <hr>
        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
        </div>
        <br>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
        </div>
        <br>
        <div>
            <button type="submit">Log In To Red-Ops</button>
        </div>
        <hr>
    <p>or <a href="{{route('signup')}}">Sign up</a></p>
    </form>
    
</div>
@endsection