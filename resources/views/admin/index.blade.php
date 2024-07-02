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
        <form action={{ route('admin.update') }} method="post">
            @csrf
            <ul class="movie-queue">
                @foreach ($users as $user)
                    <li>
                        {{ ucfirst($user->username) }}
                        <input type="checkbox" name="disable[{{$user->id}}]" value="{{$user->id}}" @if ($user->disabled)
                            checked
                        @endif>
                    </li>
                @endforeach
            </ul>
            <button type="submit">Submit</button>
        </form>
    </div>
@endsection
