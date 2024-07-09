@extends('layouts.layout')

@section('title')
    Admin Settings
@endsection

@section('content')
    
    <h1 class="text-6xl libre-barcode-39-text-regular mb-8 text-center text-red-600 animate-pulse">{{$user->username}}</h1>
    <br>
    <div class="block bg-red-900 rounded p-4">
        <form action={{ route('admin.updateUser', ['id' => $user->id]) }} method="post" class="flex flex-col space-y-3">
            {{ csrf_field() }}
            <div class="text-2xl">ADMIN SETTINGS</div>
            <div>
                <label for="disabled-input">Disabled?</label>
                <input id="disabled-input" type="checkbox" name="disabled" value={{true}} @if ($user->disabled) checked @endif>
            </div>
            
            <div>
                <label for="username-reset">Username: </label>
                <input id="username-reset" type="text" name="username_reset" value={{$user->username}}>
            </div>
            
            <div>
                <label for="password-reset">Password: </label>
                <input id="password-reset" type="password" name="password_reset">
            </div>
            
            
            <button type="submit" class="bg-red-700 hover:bg-red-600 px-4 py-2 rounded-lg">Submit</button>

        </form>
    </div>
@endsection
