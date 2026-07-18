<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Kino Order')</title>
    <link rel="stylesheet" href={{ asset('assets/css/style.css') }}>

    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="theme-color" content="#b30b06">
    <link rel="apple-touch-icon" href="{{ asset('icons/icon-192.png') }}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="RedOps">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">
    @vite('resources/css/app.css')
    @vite(['resources/js/app.js'])
    {{-- Lottie? --}}
    <script src="https://unpkg.com/lottie-web@latest/build/player/lottie.min.js"></script>
</head>

<body class="relative bg-black flex flex-col min-h-svh justify-between bg-cover bg-center bg-repeat-x"
    style="background-image: url({{ asset('assets/images/RedOpsMap.svg') }})">

    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none" aria-hidden="true">
        <div class="radar-sweep-wrap">
            <div class="radar-sweep"></div>
        </div>
        {{-- Each blip's animation-delay = (bearing from center, clockwise from north / 360) * 10s sweep period,
             so its ping fires exactly as the sweep arm passes over it. --}}
        <span class="radar-blip" style="top: 27%; left: 19%; animation-delay: 8.53s;"></span>
        <span class="radar-blip" style="top: 58%; left: 24%; animation-delay: 7.03s;"></span>
        <span class="radar-blip" style="top: 24%; left: 50%; animation-delay: 0s;"></span>
        <span class="radar-blip" style="top: 46%; left: 53%; animation-delay: 1.03s;"></span>
        <span class="radar-blip" style="top: 33%; left: 68%; animation-delay: 1.31s;"></span>
        <span class="radar-blip" style="top: 47%; left: 64%; animation-delay: 2.17s;"></span>
        <span class="radar-blip" style="top: 74%; left: 80%; animation-delay: 3.58s;"></span>
    </div>

    <section x-data x-cloak class="relative z-10">
        <nav class="flex justify-between px-4 py-2 bg-black border-b border-red-900/40 items-center ">
            <div class="text-redops-red-bright text-6xl font-vt323 ">
                <a href="/" class="glitch" data-text="REDOPS">
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
            @if ($errors->any())
                <main class="max-w-xl  lg:p mx-auto">
                    <section class=" p-2 max-w-[550px] ">
                        <div
                            class="bg-window-bright border-2 border-zinc-300 border-b-zinc-700 border-r-zinc-700 space-y-1 ">
                            <h1 class="bg-redops-red-dark m-1 px-1 text-red-100">ERRORS DETECTED</h1>
                            <div class="p-1 ">
                                <ul class="bg-red-300">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </section>
                </main>
            @endif

            @if (session('success'))
                <main class="max-w-xl  lg:p mx-auto">
                    <section class=" p-2 max-w-[550px] ">
                        <div
                            class="bg-window-bright border-2 border-zinc-300 border-b-zinc-700 border-r-zinc-700 space-y-1 ">
                            <h1 class="bg-redops-red-dark m-1 px-1 text-red-100">success</h1>
                            <div class="p-1 ">
                                {{session('success')}}
                            </div>
                        </div>
                    </section>
                </main>
            @endif

            @if (session('message'))
                <main class="max-w-xl  lg:p mx-auto">
                    <section class=" p-2 max-w-[550px] ">
                        <div
                            class="bg-window-bright border-2 border-zinc-300 border-b-zinc-700 border-r-zinc-700 space-y-1 ">
                            <h1 class="bg-redops-red-dark m-1 px-1 text-red-100">message</h1>
                            <div class="p-1 ">
                                {{session('message')}}
                            </div>
                        </div>
                    </section>
                </main>
            @endif


            @yield('content')
        </div>
    </section>


    <footer class="relative z-10 flex justify-between p-4 bg-black border-t border-red-900/40 items-center">

        @if (Auth::user())
            <div class="text-redops-red-bright lg:text-2xl"
                x-data="{
                    canInstall: false,
                    isIOS: false,
                    deferredPrompt: null,
                    install() {
                        if (this.deferredPrompt) {
                            this.deferredPrompt.prompt();
                            this.deferredPrompt = null;
                            this.canInstall = false;
                        }
                    }
                }"
                x-init="
                    let isStandalone = window.matchMedia('(display-mode: standalone)').matches || window.navigator.standalone;
                    isIOS = /iphone|ipad|ipod/i.test(navigator.userAgent) && !isStandalone;
                    if (!isStandalone) {
                        window.addEventListener('beforeinstallprompt', (e) => {
                            e.preventDefault();
                            deferredPrompt = e;
                            canInstall = true;
                        });
                    }
                ">
                {{ Auth::user()->username }} authenticated
                <span x-show="canInstall" x-cloak>
                    &middot; <button type="button" class="link-button underline" @click="install()">Install App</button>
                </span>
                <span x-show="isIOS" x-cloak class="text-sm normal-case">
                    &middot; Tap Share &rarr; Add to Home Screen to install
                </span>
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
                <a href={{ route('login') }} class="link-button" type="submit">Log In</a> / <a href={{ route('signup') }} class="link-button" type="submit">Register</a>
            </div>
        @endif
    </footer>




</body>

</html>
