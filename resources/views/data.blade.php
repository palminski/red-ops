@extends('layouts.layout')

@section('title')
    Data
@endsection

@section('content')
    <div class="block">
        <h1>Data testing page</h1>
        @if(session('status'))
            <p>{{session('status')}}</p>
        @endif

        

        <form action="{{route('submit-form')}}" method="POST">
            @csrf
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>
            <br>
            <label for="info">Info:</label>
            <input type="text" name="info" id="info" required>
            <br>
            <button type="submit">Submit</button>
        </form>
    </div>
@endsection
