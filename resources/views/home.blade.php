@extends('layouts.dark')

@section('title')
    Red-Ops
@endsection

@section('content')
    {{-- Pages --}}
    <section class="flex flex-wrap max-w-xl mx-auto">
        @if (Auth::check())
            <a href={{ route('movie-queue') }}
                class="flex flex-col p-8 lg:p-12 w-1/2 justify-center items-center text-redops-red-bright">
                <img class="p-6 h-48" src="{{ asset('/assets/images/VideoTap.svg') }}" alt="">
                <h1 class="font-bold text-4xl">Movies</h1>
            </a>

            <a href={{ route('users.index') }}
                class="flex flex-col p-8 lg:p-12 w-1/2 justify-center items-center text-redops-red-bright">
                
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="p-6 h-48 w-full">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                  </svg>
                  
                <h1 class="font-bold text-4xl">Users</h1>
            </a>

            <a href={{ route('testing') }}
                class="flex flex-col p-8 lg:p-12 w-1/2 justify-center items-center text-redops-red-bright">
                <img class="p-6 h-48" src="{{ asset('/assets/images/Top Secret.svg') }}" alt="">
                <h1 class="font-bold text-4xl">Testing</h1>
            </a>
            {{-- <a href={{ route('movie-queue') }} class="flex flex-col p-8 lg:p-12 w-1/2 justify-center items-center text-redops-red-bright">
                <img class="p-6" src="{{ asset("/assets/images/Top Secret.svg") }}" alt="">
                <h1 class="font-bold text-4xl">Briefing</h1>
            </a>
            <a href={{ route('movie-queue') }} class="flex flex-col p-8 lg:p-12 w-1/2 justify-center items-center text-redops-red-bright">
                <img class="p-6" src="{{ asset("/assets/images/Top Secret.svg") }}" alt="">
                <h1 class="font-bold text-4xl">Dominion</h1>
            </a> --}}
            @if (Auth::user()->admin)
                <a href={{ route('admin.index') }}
                    class="flex flex-col p-8 lg:p-12 w-1/2 justify-center items-center text-redops-red-bright">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="p-6 h-48 w-full">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                      </svg>
                      
                    <h1 class="font-bold text-4xl">Admin</h1>
                </a>
            @endif
        @else
            <a href={{ route('login') }}
                class="flex flex-col p-8 lg:p-12 w-1/2 justify-center items-center text-redops-red-bright">
                <img class="p-6 h-48" src="{{ asset('/assets/images/Top Secret.svg') }}" alt="">
                <h1 class="font-bold text-4xl">Log In</h1>
            </a>
        @endif

    </section>
    {{-- <div class="flex flex-col items-center mt-12 mb-20">
        <div class="w-full max-w-md sm:max-w-md md:max-w-md lg:max-w-lg xl:max-w-2xl">
            <img class="w-full " src="{{asset('assets/images/Variant4.svg')}}" alt="Our Logo">
        </div>
    </div> --}}


    {{-- <div class="flex flex-col items-center">
        <div class="animate-pulse flex space-x-4">

            <a  href="{{route('login')}}" class="mt-cusom bg-red-900 hover:bg-red-700 text-black py-5 px-20 rounded-3xl libre-barcode-39-text-regular text-8xl">
                ENTER
            </a>
        </div>
    </div> --}}
@endsection
