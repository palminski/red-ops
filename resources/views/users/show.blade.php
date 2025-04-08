@extends('layouts.dark')

@section('title')
    Agent Page
@endsection

@section('content')
    <main class="max-w-xl  lg:p mx-auto" x-data="{ showPicks: false, showAchievement: true }">
        {{-- Current Queue --}}
        <section class=" p-2 max-w-[550px]">
            <div class="bg-window-bright border-2 border-zinc-300 border-b-zinc-700 border-r-zinc-700 space-y-1">
                <h1 class="bg-redops-red-bright m-1 px-1 text-red-100">agent_info_{{ $user->username }}</h1>
                <div class="p-1">
                    <div class="pr-3 flex justify-between">
                        <img class="bg-zinc-950 border-2 border-zinc-700 border-b-zinc-300 border-r-zinc-700" src="{{asset("/assets/images/placeholder.png")}}" alt="">
                        <div>
                            <div>
                                Avg Movie Rating: {{ $user->getAverageScore() }}
                            </div>
                            <div>
                                Achievement Count: {{ $user->achievements->count() }}
                            </div>
                        </div>
                    </div>
                    

                    {{--  --}}
                    <div class="py-2">
                        <hr class="border-black">
                    </div>

                    @if ($user->achievements->count() > 0)
                        <div>
                            <div class="flex justify-between">
                                <span>Achievements:</span>
                                <button x-on:click="showAchievement=!showAchievement" class="bg-zinc-900 text-white px-2 border border-zinc-300 w-16 ">
                                    <span x-text="showAchievement ? 'Hide' : 'Show'"></span>
                                </button>
                            </div>
                            <div x-show="showAchievement"
                                class="bg-zinc-950 border-2 border-zinc-700 border-b-zinc-300 border-r-zinc-700 w-full p-1 text-red-300 max-h-[300px] overflow-y-auto">
                                @foreach ($user->achievements as $achievement)
                                <div class="flex items-center">
                                    <div class="achievement-icon w-1/2" data-file={{  asset("/assets/achievements/$achievement->icon_name") }}>

                                    </div>
                                    <div class="w-1/2">
                                        <h1 class="font-bold text-xl underline">{{ $achievement->name }}</h1>
                                        <p>
                                            {{ $achievement->description }}
                                        </p>
                                    </div>
                                </div>
                                
                                
                                @endforeach
                            </div>
                        </div>
                    @endif


                    @if ($moviePicks->count() > 0)
                        <div>
                            <div class="flex justify-between">
                                <span>Previous Movie Picks:</span>
                                <button x-on:click="showPicks=!showPicks"
                                    class="bg-zinc-900 text-white px-2 border border-zinc-300 w-16">
                                    <span x-text="showPicks ? 'Hide' : 'Show'"></span>
                                </button>
                            </div>
                            <ul x-show="showPicks"
                                class="bg-zinc-950 border-2 border-zinc-700 border-b-zinc-300 border-r-zinc-700 w-full p-1 text-red-300 max-h-[400px] overflow-y-auto">
                                @foreach ($moviePicks as $moviePick)
                                    <li class="my-2">
                                        <span>
                                            [{{ $moviePick->created_at->format('Y-m-d') }}]
                                            =>
                                            <a class="underline text-red-400 hover:text-red-500"
                                                href={{ route('movies.show', ['id' => $moviePick->id]) }}>{{ $moviePick->movie_title ? Str::limit($moviePick->movie_title, 25) : 'CLASSIFIED' }}</a>
                                            -
                                            <a class="text-red-600"
                                                href={{ route('movies.show', ['id' => $moviePick->id]) }}>
                                                ({{ $moviePick->getAverageRating() }})
                                            </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </div>
            </div>
        </section>


    </main>

    <script>

        //Find Achievement Containers and Inject Image Into Page
        let achievementIcons = document.querySelectorAll('.achievement-icon');
        achievementIcons.forEach(icon => {
            let filePath = icon.dataset.file;
            lottie.loadAnimation({
                container: icon,
                renderer: 'svg',
                loop: true,
                autoplay: true,
                path: filePath
            });
        });
    </script>
@endsection
