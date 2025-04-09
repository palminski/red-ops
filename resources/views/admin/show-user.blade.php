@extends('layouts.dark')

@section('title')
    Admin Settings
@endsection

@section('content')
    <main class="max-w-xl  lg:p mx-auto">


        <section class=" p-2 max-w-[550px]">
            <div class="bg-window-bright border-2 border-zinc-300 border-b-zinc-700 border-r-zinc-700 space-y-1">
                <h1 class="bg-redops-red-dark m-1 px-1 text-red-100">admin_settings_{{ $user->username }}</h1>
                <form action={{ route('admin.updateUser', ['id' => $user->id]) }} method="post"
                    class="p-1 flex flex-col justify-between">
                    @csrf
                    <div
                        class="bg-window-bright border-2 border-zinc-700 border-b-zinc-300 border-r-zinc-700 w-full p-1 space-y-2">
                        <div>
                            <label for="disabled-input">Disabled?</label>
                            <input id="disabled-input" type="checkbox" name="disabled" value={{ true }}
                                @if ($user->disabled) checked @endif>
                        </div>

                        <div>
                            <label for="username-reset">Username: </label>
                            <input class="w-full border border-zinc-700 px-1" id="username-reset" type="text"
                                name="username_reset" value={{ $user->username }}>
                        </div>

                        <div>
                            <label for="password-reset">Password: </label>
                            <input class="w-full border border-zinc-700 px-1" id="password-reset" type="password"
                                name="password_reset">
                        </div>

                        <button id="submit-button"
                            class="bg-zinc-900 text-white px-2 border border-zinc-300 ">Submit</button>
                    </div>
                </form>
            </div>
        </section>

        <section class=" p-2 max-w-[550px]">
            <div class="bg-window-bright border-2 border-zinc-300 border-b-zinc-700 border-r-zinc-700 space-y-1">
                <h1 class="bg-redops-red-dark m-1 px-1 text-red-100">{{ $user->username }}_achiev_settings</h1>
                <form action={{ route('achievement.assign', ['id' => $user->id]) }} method="post"
                    class="p-1 flex flex-col justify-between">
                    @csrf
                    <div
                        class="bg-window-bright border-2 border-zinc-700 border-b-zinc-300 border-r-zinc-700 w-full p-1 space-y-2">

                        <div>
                            <label for="achievementId">Achievement: </label>
                            <select name="achievementId" id="achievementId" class="w-full border border-zinc-700 px-1">
                                @foreach ($achievements as $achievement)
                                    <option value="{{$achievement->id}}">{{$achievement->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        

                        <button id="submit-button"
                            class="bg-zinc-900 text-white px-2 border border-zinc-300 ">Submit</button>
                    </div>
                </form>
            </div>
        </section>


    </main>
@endsection
