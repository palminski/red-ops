@extends('layouts.dark')

@section('title')
    Red-Ops
@endsection

@section('content')
    {{-- Pages --}}
    <section class="flex flex-wrap max-w-xl mx-auto">

        <a href={{ route('movie-queue') }}
            class="flex flex-col p-8 lg:p-12 w-1/2 justify-center items-center text-redops-red-bright">
            <img class="p-6 h-24 lg:h-48" src="{{ asset('/assets/images/VideoTap.svg') }}" alt="">
            <h1 class="font-bold text-4xl">KINO</h1>
        </a>

        <a href={{ route('users.index') }}
            class="flex flex-col p-8 lg:p-12 w-1/2 justify-center items-center text-redops-red-bright">

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="p-4 lg:p-6 h-24 lg:h-48 w-full">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
            </svg>

            <h1 class="font-bold text-4xl">AGENTS</h1>
        </a>


        <a href={{ route('achievement.index') }}
            class="flex flex-col p-8 lg:p-12 w-1/2 justify-center items-center text-redops-red-bright">

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="p-4 lg:p-6 h-24 lg:h-48 w-full">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 0 1-.982-3.172M9.497 14.25a7.454 7.454 0 0 0 .981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 0 0 7.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 0 0 2.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 0 1 2.916.52 6.003 6.003 0 0 1-5.395 4.972m0 0a6.726 6.726 0 0 1-2.749 1.35m0 0a6.772 6.772 0 0 1-3.044 0" />
            </svg>
              

            <h1 class="font-bold text-4xl">ACHV</h1>
        </a>

        <a href={{ route('testing') }}
            class="flex flex-col p-8 lg:p-12 w-1/2 justify-center items-center text-redops-red-bright">
            <img class="p-6 h-24 lg:h-48" src="{{ asset('/assets/images/Top Secret.svg') }}" alt="">
            <h1 class="font-bold text-4xl">SCRT</h1>
        </a>
        {{-- <a href={{ route('movie-queue') }} class="flex flex-col p-8 lg:p-12 w-1/2 justify-center items-center text-redops-red-bright">
                <img class="p-6" src="{{ asset("/assets/images/Top Secret.svg") }}" alt="">
                <h1 class="font-bold text-4xl">Briefing</h1>
            </a>
            <a href={{ route('movie-queue') }} class="flex flex-col p-8 lg:p-12 w-1/2 justify-center items-center text-redops-red-bright">
                <img class="p-6" src="{{ asset("/assets/images/Top Secret.svg") }}" alt="">
                <h1 class="font-bold text-4xl">Dominion</h1>
            </a> --}}
        @if (Auth::check())
            @if (Auth::user()->admin)
                <a href={{ route('admin.index') }}
                    class="flex flex-col p-8 lg:p-12 w-1/2 justify-center items-center text-redops-red-bright">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="p-4 lg:p-6 h-24 lg:h-48 w-full">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                    </svg>

                    <h1 class="font-bold text-4xl">Admin</h1>
                </a>
            @endif
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
