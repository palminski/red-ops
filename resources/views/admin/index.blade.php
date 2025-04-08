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
                    <ul>
                        @foreach ($users as $user)
                            <li class="flex justify-between">
                                <a class="underline" href={{ route('admin.showUser', ['id' => $user->id]) }}>
                                    {{ ucfirst($user->username) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>

        <section class=" p-2 max-w-[550px]">
            <div class="bg-window-bright border-2 border-zinc-300 border-b-zinc-700 border-r-zinc-700 space-y-1">
                <h1 class="bg-redops-red-bright m-1 px-1 text-red-100">add_achiev_menu</h1>
                <div class="p-1">
                    <form method="POST" action={{ route('achievement.create') }} class="p-1 flex flex-col justify-between">
                        @csrf
                        <div
                            class="bg-window-bright border-2 border-zinc-700 border-b-zinc-300 border-r-zinc-700 w-full p-1 space-y-2">
                            <div>
                                <label for="name">Name:</label>
                                <input id="name" name="name" type="text" class="w-full border border-zinc-700 px-1" placeholder= "achievement name">

                                <label for="desc">Desc:</label>
                                <input id="desc" name="desc" type="text" class="w-full border border-zinc-700 px-1" placeholder= "achievement desc">

                                <label for="file">File Name:</label>
                                <input id="file" name="file" type="text" class="w-full border border-zinc-700 px-1" placeholder= "achievement file">

                            </div>
                            <button id="submit-button" class="bg-zinc-900 text-white px-2 border border-zinc-300 ">Create Achievement</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection
