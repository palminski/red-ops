@extends('layouts.layout')

@section('title')
    Admin Settings
@endsection

@section('content')
    <div class="block">
        <h1>Admin Settings For {{$user->username}}</h1>

    </div>
    <br>
    <div class="block">
        <form action={{ route('admin.updateUser', ['id' => $user->id]) }} method="post">
            {{ csrf_field() }}

            <label for="disabled-input">Disabled?</label>
            <input id="disabled-input" type="checkbox" name="disabled" value={{true}} @if ($user->disabled) checked @endif>
            <br>
            <label for="username-reset">Username: </label>
            <input id="username-reset" type="text" name="username_reset" value={{$user->username}}>
            <br>
            <label for="password-reset">Password: </label>
            <input id="password-reset" type="password" name="password_reset">
            <br>
            <button type="submit">Submit</button>

        </form>
    </div>
@endsection
