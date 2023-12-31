
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
</div>
@endsection