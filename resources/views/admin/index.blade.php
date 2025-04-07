@extends('layouts.dark')

@section('title')
    Admin Settings
@endsection

@section('content')
    <main class="max-w-xl  lg:p mx-auto">
       

        <section class=" p-2 max-w-[550px]">
            <div class="bg-window-bright border-2 border-zinc-300 border-b-zinc-700 border-r-zinc-700 space-y-1">
                <h1 class="bg-redops-red-bright m-1 px-1 text-red-100">users_admin_menu</h1>
                <div class="p-1">
                    <div>
                        {{-- <ul
                            class="bg-zinc-950 border-2 border-zinc-700 border-b-zinc-300 border-r-zinc-700 w-full p-1 text-red-300">
                            @foreach ($movie->movieRatings as $rating)
                                <li class="my-2">
                                    [<a class="underline" href={{ route('users.show', ['id' => $movie->user->id]) }}>
                                        {{ $rating->user->username }} </a>] rated movie <span
                                        class="text-red-400">[{{ $rating->rating }}]</span>
                                </li>
                            @endforeach
                        </ul> --}}
                    </div>
                </div>
            </div>
        </section>
    </main>

    <div class="container mx-auto py-8">
        <h1 class="text-6xl libre-barcode-39-text-regular mb-8 text-center text-red-900 animate-pulse">Admin</h1>
        <div class="uppercase terminal mx-auto" style="max-width: 600px;">
            <ul>
                @foreach ($users as $user)
                    <a href={{ route('admin.showUser', ['id' => $user->id]) }}>
                        <li class="bg-black rounded-lg border-red-900 border-4 py-4 pl-4 cursor-pointer hover:bg-red-900 hover:text-black transition duration-300 ease-in-out transform hover:scale-105 flex items-center"
                            onclick="toggleInput(this)">
                            <span class="block text-lg sm:text-xl mr-4"> {{ ucfirst($user->username) }}</span>
                        </li>
                    </a>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
