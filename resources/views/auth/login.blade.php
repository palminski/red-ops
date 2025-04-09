@extends('layouts.dark')

@section('title')
    Log In
@endsection

@section('content')
    {{-- <div class="flex flex-col items-center mt-12 mb-4">
        <div class="w-full max-w-md sm:max-w-md md:max-w-md lg:max-w-lg xl:max-w-2xl">
            <img class="w-full " src="{{asset('assets/images/Variant4.svg')}}" alt="Our Logo">
        </div>
    </div> --}}

<main class="max-w-xl  lg:pt-16 mx-auto">
    <section class=" p-2 max-w-[550px]">
        <div class="bg-window-bright border-2 border-zinc-300 border-b-zinc-700 border-r-zinc-700 space-y-1">
            <header class="bg-redops-red-dark m-1 px-1 flex justify-between items-center">
                <h1 class="text-red-100 text-xl">redops.authenticator</h1>
                <a class="bg-window-bright border-2 border-zinc-700 border-b-zinc-300 border-r-zinc-700 my-1 px-1"
                    href="/">&#x2190; app_root</a>
            </header>

            <form class="p-1" action="{{ route('login') }}" method="post">
                @csrf
                <div class="flex flex-col items-center">
                    <div class="bg-window-bright border-2 border-zinc-700 border-b-zinc-300 border-r-zinc-700 w-full p-1 space-y-2">
                        <div>
                            <label for="username">Username:</label>
                            <input id="username" name="username" type="text" class="w-full border border-zinc-700 px-1"
                                placeholder= "username">
                        </div>



                        <div>
                            <label for="password">Password:</label>
                            <input name="password" id="password" type="Password" class="w-full border border-zinc-700 px-1"
                                placeholder= "password">
                        </div>

                        <button class=" bg-zinc-900 text-white px-2 border border-zinc-300">
                            Authenticate
                        </button>
                    </div>
                </div>

                <div class="lex flex-col items-center animate-pulse flex space-x-4">

                </div>
            </form>
        </div>
    </section>
</main>
    
@endsection
