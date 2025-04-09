@extends('layouts.dark')

@section('title')
    Red-Ops
@endsection

@section('content')


<main class="max-w-xl  lg:pt-16 mx-auto">
    <section class=" p-2 max-w-[550px]">
        <div class="bg-window-bright border-2 border-zinc-300 border-b-zinc-700 border-r-zinc-700 space-y-1">
            <header class="bg-redops-red-bright m-1 px-1 flex justify-between items-center">
                <h1 class="text-red-100 text-xl">redops.signup</h1>
                <a class="bg-window-bright border-2 border-zinc-700 border-b-zinc-300 border-r-zinc-700 my-1 px-1"
                    href="/">&#x2190; app_root</a>
            </header>

            <form class="p-1" action="{{ route('add-user') }}" method="post">
                @csrf
                <div class="flex flex-col items-center">
                    <div class="bg-window-bright border-2 border-zinc-700 border-b-zinc-300 border-r-zinc-700 w-full p-1 space-y-2">
                        <div>
                            <label for="username">Username:</label>
                            <input id="username" name="username" type="text" class="w-full border border-zinc-700 px-1"
                                placeholder= "username">
                        </div>



                        <div>
                            <label for="password">Password:</label>
                            <input name="password" id="password" type="Password" class="w-full border border-zinc-700 px-1"
                                placeholder= "password">
                        </div>

                        <div>
                            <label for="secret_code">Secret Code:</label>
                            <input name="secret_code" id="secret_code" type="Password" class="w-full border border-zinc-700 px-1"
                                placeholder= "secret_code">
                        </div>

                        <button class=" bg-zinc-900 text-white px-2 border border-zinc-300">
                            Register
                        </button>
                    </div>
                </div>

                <div class="lex flex-col items-center animate-pulse flex space-x-4">

                </div>
            </form>
        </div>
    </section>
</main>
@endsection
