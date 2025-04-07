<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Kino Order')</title>
    <link rel="stylesheet" href={{ asset('assets/css/style.css') }}>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">
    @vite('resources/css/app.css')
    @vite(['resources/js/app.js'])
    {{-- Lottie? --}}
    <script src="https://unpkg.com/lottie-web@latest/build/player/lottie.min.js"></script>
</head>

<body class="bg-black flex flex-col min-h-svh justify-between bg-cover bg-center bg-no-repeat"
    style="background-image: url({{ asset('assets/images/RedOpsMap.svg') }})">


    <section>
        <nav class="flex justify-between px-4 py-2 bg-black border-b border-red-900/40 items-center ">
            <div class="text-redops-red-bright text-6xl font-vt323 ">
                <a href="/">
                    REDOPS
                </a>
                
            </div>
            <div class="text-redops-red-bright font-bold text-xl animate-pulse">
                SECURE
            </div>
        </nav>
        @if (session('error-message'))
            <h3 style="color: red">{{ session('error-message') }}</h3>
        @endif


        <div class="">
            @yield('content')
        </div>
    </section>


    <footer class="flex justify-between p-4 bg-black border-t border-red-900/40 items-center">
        
        @if (Auth::user())
            <div class="text-redops-red-bright lg:text-2xl">
                {{Auth::user()->username}} authenticated
            </div>
            <div class="text-redops-red-bright lg:text-2xl uppercase">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button class="link-button" type="submit">Log Out</button>
                </form>
            </div>
        @else
        <div class="text-redops-red-bright lg:text-2xl uppercase">
            No User Authenticated
        </div>
        <div class="text-redops-red-bright lg:text-2xl">
            {{-- CLASSIFIED SYSTEMS --}}
        </div>
        @endif
    </footer>




</body>

</html>
