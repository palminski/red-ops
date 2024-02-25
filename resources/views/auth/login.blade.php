
@extends('layouts.layout')

@section('title')
    Log In
@endsection

@section('content')
<br>
<div class="block">
    <form action="{{ route('login') }}" method="post">
        @csrf
        <h2>Log In</h2>
        <hr>
        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div>
            <button type="submit">Log In</button>
        </div>
    </form>
    <hr>
    <p>or <a href="{{route('signup')}}">Sign up</a></p>
</div>
@endsection