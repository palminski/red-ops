@extends('layouts.dark')

@section('title')
    Achievements
@endsection

@section('content')
    <main class="max-w-xl  lg:p mx-auto">
        {{-- Current Queue --}}
        <section class=" p-2 max-w-[550px]">
            <div class="bg-window-bright border-2 border-zinc-300 border-b-zinc-700 border-r-zinc-700 space-y-1">

                <header class="bg-redops-red-dark m-1 px-1 flex justify-between items-center">
                    <h1 class="text-red-100 text-xl">all_achievements</h1>
                    <a class="bg-window-bright border-2 border-zinc-700 border-b-zinc-300 border-r-zinc-700 my-1 px-1"
                        href="/">&#x2190; app_root</a>
                </header>

                <div class="p-1 space-y-2">
                    <div>
                        <h2>Achievements:</h2>
                        <div class="bg-zinc-950 border-2 border-zinc-700 border-b-zinc-300 border-r-zinc-700 w-full p-1 text-red-300 max-h-[800px] overflow-y-auto">
                            <img class="mx-auto max-w-[300px] py-5 px-5" src="{{ asset('/assets/images/AchivementTitle.svg') }}" alt="">
                            @foreach ($achievements as $achievement)
                            <hr class="border-red-500 mx-5">
                                <div class="flex items-center justify-center">
                                    <div class="achievement-icon w-32 h-32"
                                        data-file={{ asset("/assets/achievements/$achievement->icon_name") }}>

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

                </div>
            </div>
        </section>
    </main>

    <script>
        //Find Achievement Containers and Inject Image Into Page
        let achievementIcons = document.querySelectorAll('.achievement-icon');
        achievementIcons.forEach(icon => {
            let filePath = icon.dataset.file;
            console.log(icon.dataset.file);
            
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
