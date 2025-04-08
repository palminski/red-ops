@extends('layouts.dark')

@section('title')
    Movies
@endsection

@section('content')
    <main class="max-w-xl  lg:p mx-auto">
        {{-- Current Queue --}}
        <section class=" p-2 max-w-[550px]">
            <div class="bg-window-bright border-2 border-zinc-300 border-b-zinc-700 border-r-zinc-700 space-y-1">
                <h1 class="bg-redops-red-bright m-1 px-1 text-red-100">current_queue</h1>
                <div class="p-1">
                    <ul class="bg-window-bright border-2 border-zinc-700 border-b-zinc-300 border-r-zinc-700 w-full p-1 ">
                        @foreach ($users as $user)
                            <li class="flex justify-between @if($loop->first) bg-red-300 @endif">
                                <div>
                                    {{ $loop->index + 1 }} - <a class="underline"
                                        href={{ route('users.show', ['id' => $user->id]) }}>{{ Str::limit($user->username,16) }}</a>
                                        @if($loop->first)
                                            [next]
                                        @endif
                                </div>
                                <div>
                                    {{ $user->getAverageScore() ?? 'No Score' }} Average Rating
                                </div>


                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>

        @if(Auth::user())
        <section class=" p-2 max-w-[550px]">
            <div class="bg-window-bright border-2 border-zinc-300 border-b-zinc-700 border-r-zinc-700 space-y-1">
                <h1 class="bg-redops-red-bright m-1 px-1 text-red-100">log_movie_{{ Auth::user()->username }}</h1>

                <form method="POST" action={{ route('movie.pick') }} class="p-1 flex flex-col justify-between">
                    @csrf
                    <input type="hidden" name="userId" value={{ Auth::user()->id }}>
                    <div
                        class="bg-window-bright border-2 border-zinc-700 border-b-zinc-300 border-r-zinc-700 w-full p-1 space-y-2">
                        <div>
                            <label for="movieTitle">Movie:</label>
                            <input id="movieTitle" name="movieTitle" type="text"
                                class="w-full border border-zinc-700 px-1" placeholder= "movie title">
                        </div>
                        <button id="submit-button" class="bg-zinc-900 text-white px-2 border border-zinc-300 ">Log</button>
                    </div>
                </form>
            </div>
        </section>
        @endif

        <section class=" p-2 max-w-[550px]">
            <div class="bg-window-bright border-2 border-zinc-300 border-b-zinc-700 border-r-zinc-700 space-y-1">
                <h1 class="bg-redops-red-bright m-1 px-1 text-red-100">movie_log</h1>
                <div class="p-1">
                    <ul
                        class="bg-zinc-950 border-2 border-zinc-700 border-b-zinc-300 border-r-zinc-700 w-full p-1 text-red-300 max-h-[400px] overflow-y-auto">
                        @foreach ($moviePicks as $moviePick)
                            <li class="my-2">
                                <span>
                                    [{{ $moviePick->created_at->format('Y-m-d') }}]
                                    <a class="underline text-red-400 hover:text-red-500"
                                        href={{ route('users.show', ['id' => $moviePick->user->id]) }}>{{ ucfirst($moviePick->user->username) }}</a>
                                    =>
                                    <a class="underline text-red-400 hover:text-red-500"
                                        href={{ route('movies.show', ['id' => $moviePick->id]) }}>{{ $moviePick->movie_title ? Str::limit($moviePick->movie_title,16) : 'CLASSIFIED' }}</a>
                                    -
                                    <a class="text-red-600" href={{ route('movies.show', ['id' => $moviePick->id]) }}>
                                        ({{ $moviePick->getAverageRating() ?? "No Data" }})
                                    </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>
    </main>
@endsection
