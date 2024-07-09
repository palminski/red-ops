@extends('layouts.layout')

@section('title')
    Agent Page
@endsection

@section('content')
    
    <h1 class="text-6xl libre-barcode-39-text-regular mb-8 text-center text-red-600 animate-pulse">{{$user->username}}</h1>
    
    <hr class="border-red-600 animate-pulse">
    

    <div class="text-red-600 animate-pulse  py-6">
        <div class="text-center">
            <div class="text-center text-2xl">
                Average Rating: <span class="text-red-400">[{{$user->getAverageScore()}}]</span>
            </div>
        </div>
    </div>
@endsection
