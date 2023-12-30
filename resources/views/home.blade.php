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
        <h1>Red-Ops</h1>
        @if (Auth::check())
            <h2>Logged in as {{Auth:user()->username}}</h2>
        @else
        {{-- @include('components.login-form') --}}
        @endif
        
    </div>
    <br>
    <div class="block">
        @include('components.signup-form')
    </div>
    <br>
    <div class="block">
        <h1>DATA</h1>
        <hr>
        @if ($users)
            <ul>
                @foreach ($users as $user)
                    <li>{{$user->username}}</li>
                @endforeach
            </ul>
            <hr>
        @endif
        @if ($formData)
            <p><strong>Name:</strong> {{ $formData['name'] ?? '[Not Provided]' }}</p>
            <p><strong>Info:</strong> {{ $formData['info'] ?? '[Not Provided]' }}</p>
            <form action="{{route('clear-session')}}" method="POST">
            @csrf
            <button type="submit">Clear Session Data</button>
            </form>
        @else
            <p><strong>No Data in session</strong></p>
        @endif
    </div>
@endsection
