@extends('layouts.dark')

@section('title')
    Red-Ops
@endsection

@section('content')
<div class="flex flex-col items-center mt-12 mb-4">
    <div class="w-full max-w-md sm:max-w-md md:max-w-md lg:max-w-lg xl:max-w-2xl">
        <img class="w-full " src="{{asset('assets/images/Variant4.svg')}}" alt="Our Logo">
    </div>
</div>
<form class="auth-form" action="{{ route('add-user') }}" method="post">
    @csrf
    <div class="flex flex-col items-center">
        <div class="bg-red-900 border-red-900 border-8 rounded-xl w-96">
            <div class="text-red-300">
                <input name="username" type="text" class="w-full border-red-900 placeholder-red-900 bg-black focus:outline-none px-8 py-4 mt-4 border-4 rounded-xl" placeholder= "USERNAME">
            </div>   
            <div class="text-red-300">
                <input name="password" type="Password" class="w-full border-red-900 placeholder-red-900 bg-black focus:outline-none px-8 py-4 mt-4 border-4 rounded-xl" placeholder= "PASSWORD">
            </div> 
        </div>
    </div>

    <div class="lex flex-col items-center animate-pulse flex space-x-4"> 
            <button class="bg-black text-red-900 py-5 px-20 rounded-3xl libre-barcode-39-text-regular text-8xl ">
            Sign Up
            </button>
    </div>
</form>
@endsection
