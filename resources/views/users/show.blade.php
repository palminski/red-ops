@extends('layouts.dark')

@section('title')
    Agent Page
@endsection

@section('content')
    <main class="max-w-xl  lg:p mx-auto" x-data="{ showPicks: false, showAchievement: true, showProfileImageUpload: false }">
        {{-- Current Queue --}}
        <section class=" p-2 max-w-[550px]">
            <div class="bg-window-bright border-2 border-zinc-300 border-b-zinc-700 border-r-zinc-700 space-y-1">
                <header class="bg-redops-red-bright m-1 px-1 flex justify-between items-center">
                    <h1 class="text-red-100 text-xl">agent_info_{{$user->username}}</h1>
                    <a class="bg-window-bright border-2 border-zinc-700 border-b-zinc-300 border-r-zinc-700 my-1 px-1" href="/">&#x2190;</a>
                </header>
                <div class="p-1 space-y-2">
                    <div class="pr-3 flex justify-between">
                        <div>
                            <div x-on:click="showProfileImageUpload = true" class="relative bg-zinc-950 border-2 border-zinc-700 border-b-zinc-300 border-r-zinc-700 w-32 h-32 overflow-hidden">
                            <img  class="" src="{{$user->profile_picture ? asset('storage/'.$user->profile_picture) : asset("/assets/images/placeholder.png")}}" alt="">
                                <div class="absolute inset-0 bg-red-500 opacity-40 mix-blend-multiply pointer-events-none"></div>
                            </div>
                            @if (Auth::user() && Auth::user()->id == $user->id)
                                <form x-show="showProfileImageUpload" action="{{ route('users.picture.update', ['id' => Auth::user()->id]) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div>
                                        <input class="file:bg-zinc-900 file:text-white file:px-2 file:border file:border-zinc-300 cursor-pointer" type="file" name="profile_picture" accept="image/*" required>
                                    </div>
                                    <button class=" bg-zinc-900 text-white px-2 border border-zinc-300">
                                        Upload
                                    </button>
                                </form>    
                            @endif
                            
                        </div>
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
                                <div class="flex items-center justify-center">
                                    <div class="achievement-icon w-32 h-32" data-file={{  asset("/assets/achievements/$achievement->icon_name") }}>

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
