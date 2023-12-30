@extends('layouts.layout')

@section('title')
    Data
@endsection

@section('content')
    <div class="block">
        <h1>Data Testing Page</h1>
        @if (session('status'))
            <p>{{ session('status') }}</p>
        @endif

        <h1>Session Data</h1>
        @if ($formData)
            <p><strong>Name:</strong> {{ $formData['name'] ?? '[Not Provided]' }}</p>
            <p><strong>Info:</strong> {{ $formData['info'] ?? '[Not Provided]' }}</p>
        @else
            <p>No Data in session</p>
        @endif

        <a href="{{ route('show-form') }}">
            <= Return to form</a>

    </div>
@endsection
