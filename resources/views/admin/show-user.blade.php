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
            <button type="submit">Submit</button>

        </form>
    </div>
@endsection
