<nav class="relative z-50 p-4" x-data="{ open: false }">
    <section class="hidden  lg:flex justify-between bg-red-800">
        <a href="/">
            <h1 class="text-5xl">RED OPs</h1>
        </a>
        <ul class="flex flex-end space-x-4 font-barcode">
            <li>
                @if (Auth::check())
            <li>
                <a href={{ route('movie-queue') }}>Movies</a>
            </li>
            @if (Auth::user()->admin)
                <li>
                    <a href={{ route('admin.index') }}>Admin</a>
                </li>
            @endif
            <li>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button class="link-button" type="submit">Log Out</button>
                </form>
            </li>
        @else
            <li> <a href={{ route('login') }}>Log In</a></li>
            <li> <a href={{ route('signup') }}>Sign Up</a></li>
            @endif
            </li>
        </ul>
    </section>

    <section class=" p-2 flex lg:hidden justify-between bg-red-800 border-b-2 border-red-600">
        <a href="/">
            <h1 class="font-barcode text-5xl">RED OPs</h1>
        </a>
        <div class="flex justify-center items-center cursor-pointer" x-on:click="open=!open">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-9">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </div>

    </section>
    <div x-show="open" class="xl:hidden  transition-all duration-500 ease-in-out transform">

        {{-- <ul
            class="flex absolute flex-col items-left px-9 justify-between bg-zinc-800 w-full transition-all duration-500 ease-in-out transform">

            <li class="my-2">
                test
            </li>
            <li class="my-2">
                test
            </li>
            <li class="my-2">
                test
            </li>
            <li class="my-2">
                test
            </li>

        </ul> --}}

        <ul
            class="flex absolute flex-col items-left  justify-between bg-zinc-800 w-full transition-all duration-500 ease-in-out text-xl transform text-red-300 ">

            @if (Auth::check())
                <li class="p-2 border-b-2 border-red-800">
                    <a href={{ route('movie-queue') }}>Movies</a>
                </li>
                @if (Auth::user()->admin)
                    <li class="p-2 border-b-2 border-red-800">
                        <a href={{ route('admin.index') }}>Admin</a>
                    </li>
                @endif
                <li class="p-2 border-b-2 border-red-800">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="link-button" type="submit">Log Out</button>
                    </form>
                </li>
            @else
                <li class="p-2 border-b-2 border-red-800"> <a href={{ route('login') }}>Log In</a></li>
                <li class="p-2 border-b-2 border-red-800"> <a href={{ route('signup') }}>Sign Up</a></li>
            @endif
        </ul>
    </div>

</nav>
