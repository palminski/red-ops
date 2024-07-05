@extends('layouts.layout')

@section('title')
    Admin Settings
@endsection

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-6xl libre-barcode-39-text-regular mb-8 text-center text-red-900 animate-pulse">Admin</h1>
        <div class="uppercase terminal mx-auto" style="max-width: 600px;">
          <ul>
            @foreach ($users as $user)
            <a href={{ route('admin.showUser', ['id'=>$user->id]) }}>
                    <li class="bg-black rounded-lg border-red-900 border-4 py-4 pl-4 cursor-pointer hover:bg-red-900 hover:text-black transition duration-300 ease-in-out transform hover:scale-105 flex items-center" onclick="toggleInput(this)">
                        <span class="block text-lg sm:text-xl mr-4"> {{ ucfirst($user->username) }}</span>
                    </li>
            </a>
            @endforeach
          </ul>
        </div>
      </div>
@endsection
