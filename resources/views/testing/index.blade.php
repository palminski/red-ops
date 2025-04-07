@extends('layouts.dark')

@section('title')
    Testing
@endsection

@section('content')
    <main class="max-w-xl  lg:p mx-auto">
        

        <section class=" p-2 max-w-[550px]">
            <div class="bg-window-bright border-2 border-zinc-300 border-b-zinc-700 border-r-zinc-700 space-y-1">
                <h1 class="bg-redops-red-bright m-1 px-1 text-red-100">testing</h1>
                <div class="p-1">
                    <div class="bg-zinc-950 border-2 border-zinc-700 border-b-zinc-300 border-r-zinc-700 w-full p-1 text-red-300">
                        <div id="gold-floppy" class="w-64 h-64">
                            {{-- Animation Injected Here --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        console.log("here");
        document.addEventListener("DOMContentLoaded", function () {
            lottie.loadAnimation({
                container: document.getElementById('gold-floppy'),
                renderer: 'svg',
                loop: true,
                autoplay: true,
                path: "{{asset('/assets/animations/GoldFloppy.json')}}"
            });
        });
    </script>

   
@endsection
