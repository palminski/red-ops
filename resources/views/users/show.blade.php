@extends('layouts.dark')

@section('title')
    Agent Page
@endsection

@section('content')
    <main class="max-w-xl  lg:p mx-auto">
        {{-- Current Queue --}}
        <section class=" p-2 max-w-[550px]">
            <div class="bg-window-bright border-2 border-zinc-300 border-b-zinc-700 border-r-zinc-700 space-y-1">
                <h1 class="bg-redops-red-bright m-1 px-1">agent_info_{{ $user->username }}</h1>
                <div class="p-1">
                    <div>
                        Average Rating: {{ $user->getAverageScore() }}
                    </div>
                    <div>
                        Previous Picks:
                        <ul
                            class="bg-zinc-950 border-2 border-zinc-700 border-b-zinc-300 border-r-zinc-700 w-full p-1 text-red-300">
                            @foreach ($moviePicks as $moviePick)
                                <li class="my-2">
                                    <span>
                                        [{{ $moviePick->created_at->format('Y-m-d') }}]
                                        =>
                                        <a class="underline text-red-400 hover:text-red-500"
                                            href={{ route('movies.show', ['id' => $moviePick->id]) }}>{{ $moviePick->movie_title ? $moviePick->movie_title : 'CLASSIFIED' }}</a>
                                        -
                                        <a class="text-red-600" href={{ route('movies.show', ['id' => $moviePick->id]) }}>
                                            ({{ $moviePick->getAverageRating() }})
                                        </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
