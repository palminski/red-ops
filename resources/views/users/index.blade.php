@extends('layouts.dark')

@section('title')
    Users
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
                                <a class="underline" href={{ route('users.show', ['id' => $user->id]) }}>
                                    {{ ucfirst($user->username) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>
    </main>
@endsection
