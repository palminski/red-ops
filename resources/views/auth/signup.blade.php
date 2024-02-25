@extends('layouts.layout')

@section('title')
    Red-Ops
@endsection

@section('content')
<br>
    <div class="block">
        @if (session('error-message'))
            <h3 style="color: red">{{ session('error-message') }}</h3>
        @endif
        <form action="{{ route('add-user') }}" method="POST">
            @csrf
            <h2>Sign-Up</h2>
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
                <button type="submit">Sign Up</button>
            </div>
            <hr>
    <p>or <a href="{{route('login')}}">Log in</a></p>
        </form>
    </div>
@endsection
