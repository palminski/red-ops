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
                <img class="p-6" src="{{ asset('/assets/images/VideoTap.svg') }}" alt="">
                <h1 class="font-bold text-4xl">Movies</h1>
            </a>

            <a href={{ route('testing') }}
                class="flex flex-col p-8 lg:p-12 w-1/2 justify-center items-center text-redops-red-bright">
                <img class="p-6" src="{{ asset('/assets/images/Top Secret.svg') }}" alt="">
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
                    <img class="p-6" src="{{ asset('/assets/images/Top Secret.svg') }}" alt="">
                    <h1 class="font-bold text-4xl">Admin</h1>
                </a>
            @endif
        @else
            <a href={{ route('login') }}
                class="flex flex-col p-8 lg:p-12 w-1/2 justify-center items-center text-redops-red-bright">
                <img class="p-6" src="{{ asset('/assets/images/Top Secret.svg') }}" alt="">
                <h1 class="font-bold text-4xl">Authenticate</h1>
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
