@extends('layouts.layout')

@section('title')
    Admin Settings
@endsection

@section('content')
    <div class="block">
        <h1>Admin Settings</h1>

    </div>
    <br>
    <div class="block">
        <h1>Users</h1>
            <ul class="movie-queue">
                @foreach ($users as $user)
                    <li>
                        <a href={{ route('admin.showUser', ['id'=>$user->id]) }}>{{ ucfirst($user->username) }}</a>
                    </li>
                @endforeach
            </ul>
    </div>
@endsection
