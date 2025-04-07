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
</head>

<body class="bg-black border-2 border-red-600 border-l-red-400 border-t-red-400 min-h-svh">

    
    @include('partials.navigation')
    @if (session('error-message'))
        <h3 style="color: red">{{ session('error-message') }}</h3>
    @endif
    <div class="py-8 p-8">
        @yield('content')
    </div>




</body>

</html>
