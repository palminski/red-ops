@extends('layouts.dark')

@section('title')
    Red-Ops
@endsection

@section('content')
    <div class="flex flex-col items-center mt-12 mb-20">
        <div class="w-full max-w-md sm:max-w-md md:max-w-md lg:max-w-lg xl:max-w-2xl">
            <img class="w-full " src="{{asset('assets/images/Variant4.svg')}}" alt="Our Logo">
        </div>
    </div>
    

    <div class="flex flex-col items-center">
        <div class="animate-pulse flex space-x-4">

            <a  href="{{route('login')}}" class="mt-cusom bg-red-900 hover:bg-red-700 text-black py-5 px-20 rounded-3xl libre-barcode-39-text-regular text-8xl">
                ENTER
            </a>
        </div>
    </div>
    
@endsection
