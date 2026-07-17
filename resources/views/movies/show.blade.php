@extends('layouts.dark')

@section('title')
    Movie
@endsection

@section('content')
    <main class="max-w-xl  lg:p mx-auto">
        {{-- Current Queue --}}
        <section class=" p-2 max-w-[550px]">
            <div class="bg-window-bright border-2 border-zinc-300 border-b-zinc-700 border-r-zinc-700 space-y-1">
                <header class="bg-redops-red-dark m-1 px-1 flex justify-between items-center">
                    <h1 class="text-red-100 text-xl">movie_info_{{ Str::limit($movie->movie_title, 40) ?? 'CLASIFIED' }}</h1>
                    <a class="bg-window-bright border-2 border-zinc-700 border-b-zinc-300 border-r-zinc-700 my-1 px-1"
                        href="{{route('movie-queue')}}">&#x2190; movie_index</a>
                </header>

                <div class="p-1 space-y-2">
                    <div>
                        <h1>Movie Stats</h1>
                        <div class="bg-window-bright border-2 border-zinc-700 border-b-zinc-300 border-r-zinc-700 w-full p-1 space-y-2">
                            <div>
                                Picked On <span class="">[{{ $movie->created_at->format('Y-m-d') }}]</span> by agent <span
                                    class="underline"> <a href={{ route('users.show', ['id' => $movie->user->id]) }}>
                                        {{ $movie->user->username }} </a></span>
                            </div>
                            <div>
                                Average User Rating: <span class="">[{{ $movie->getAverageRating() ?? 'Not Rated' }}]
                            </div>
                            <div x-data="{ rt: null, imdb: null, apiTitle: null, apiYear: null, loading: true }"
                                x-init="fetch('{{ route('movies.omdb-rating', ['id' => $movie->id]) }}')
                                    .then(r => r.json())
                                    .then(data => {
                                        rt = data.found ? data.rottenTomatoes : 'Not Found';
                                        imdb = data.found ? data.imdbRating : 'Not Found';
                                        apiTitle = data.found ? data.title : null;
                                        apiYear = data.found ? data.year : null;
                                        loading = false;
                                    })
                                    .catch(() => { rt = 'Unavailable'; imdb = 'Unavailable'; loading = false })">
                                    <div x-show="!loading && apiTitle">
                                Critic Reviews For: <span x-text="apiTitle + (apiYear ? ' (' + apiYear + ')' : '')"></span> 
                                    </div>
                                    <div>
                                IMDB Score: <span x-text="loading ? '[Loading...]' : `[${imdb ?? 'Not Found'}]`"></span>

                                    </div>
                                    <div>
                                Rotten Tomatoes: <span x-text="loading ? '[Loading...]' : `[${rt ?? 'Not Found'}]`"></span>

                                    </div>
                            </div>
                            
                        </div>
                    </div>
                    

                    @if (Auth::user())
                        <form method="POST" action={{ route('movies.rate', ['id' => $movie->id]) }}
                            class="flex flex-col justify-between">
                            @csrf
                            <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                            Rate Movie
                            <div class="bg-window-bright border-2 border-zinc-700 border-b-zinc-300 border-r-zinc-700 w-full p-1 space-y-2">
                                <div x-data="{
                                            rating: {{ $movie->movieRatings->firstWhere('user_id', Auth::user()->id)->rating ?? 0 }},
                                            hover: null,
                                            display() { return this.hover ?? this.rating },
                                            fillPercent(star) {
                                                let val = this.display();
                                                if (val >= star) return 100;
                                                if (val >= star - 0.5) return 50;
                                                return 0;
                                            }
                                        }">
                                    <label for="movieTitle">Your Rating For
                                        {{ Str::limit($movie->movie_title, 25) ?? 'CLASIFIED' }}:
                                    <span class="ml-2 text-sm" x-text="display() + ' / 10'"></span></label>
                                    <div
                                        class="flex items-center gap-1 py-1 w-full"
                                        @mouseleave="hover = null">
                                        <template x-for="star in 10" :key="star">
                                            <div class="relative flex-1 aspect-square">
                                                <svg viewBox="0 0 24 24" fill="currentColor" class="absolute inset-0 w-full h-full text-zinc-600">
                                                    <path d="M12 2 14.25 8.91 21.51 8.91 15.63 13.18 17.88 20.09 12 15.82 6.12 20.09 8.37 13.18 2.49 8.91 9.75 8.91Z" />
                                                </svg>
                                                <svg viewBox="0 0 24 24" fill="currentColor" class="absolute inset-0 w-full h-full text-red-500"
                                                    :style="`clip-path: inset(0 ${100 - fillPercent(star)}% 0 0)`">
                                                    <path d="M12 2 14.25 8.91 21.51 8.91 15.63 13.18 17.88 20.09 12 15.82 6.12 20.09 8.37 13.18 2.49 8.91 9.75 8.91Z" />
                                                </svg>
                                                <button type="button" class="absolute inset-y-0 left-0 w-1/2 h-full"
                                                    @click="let v = star - 0.5; rating = (rating === v) ? 0 : v" @mouseenter="hover = star - 0.5"
                                                    :aria-label="`Rate ${star - 0.5} out of 10`"></button>
                                                <button type="button" class="absolute inset-y-0 right-0 w-1/2 h-full"
                                                    @click="let v = star; rating = (rating === v) ? 0 : v" @mouseenter="hover = star"
                                                    :aria-label="`Rate ${star} out of 10`"></button>
                                            </div>
                                        </template>
                                        <input type="hidden" name="rating" id="rating" :value="rating">

                                    </div>
                                </div>
                                <div x-data="{ review: @js($movie->movieRatings->firstWhere('user_id', Auth::user()->id)->review ?? '') }">
                                    <label for="review">Your Thoughts On {{ Str::limit($movie->movie_title, 40) }}
                                        <span class="text-xs" :class="review.length >= 280 ? 'text-red-800' : 'text-zinc-800'"
                                            x-text="'(' + review.length + ' / 280)'"></span>
                                    </label>
                                    <textarea name="review" id="review" rows="4" x-model="review" maxlength="280"
                                        class="w-full border border-zinc-700 px-1 resize-none"></textarea>
                                </div>
                                <div class="text-right">
                                <button id="submit-button" class="bg-zinc-900 text-white px-2 border ml-auto border-zinc-300 ">Submit</button>

                                </div>
                            </div>
                        </form>
                    @endif

                    <div>
                        <h2>User Ratings</h2>
                        <ul
                            class="bg-zinc-950 border-2 border-zinc-700 border-b-zinc-300 border-r-zinc-700 w-full p-1 text-red-300 ">
                            @foreach ($movie->movieRatings as $rating)
                                <li class="my-2">
                                    [<a class="underline" href={{ route('users.show', ['id' => $rating->user->id]) }}>
                                        {{ $rating->user->username }} </a>] rated movie <span
                                        class="text-red-400">[{{ $rating->rating }}]</span>
                                    @if ($rating->review)
                                        <div class="pl-2 text-red-400">{{ $rating->review }}</div>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>




    </main>
@endsection
