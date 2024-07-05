@extends('layouts.dark-with-nav')

@section('title')
    Movies
@endsection

@section('content')


<div class="container mx-auto py-8">
    <h1 class="text-6xl libre-barcode-39-text-regular mb-8 text-center text-red-900 animate-pulse">Current Queue</h1>
    <div class="uppercase terminal mx-auto" style="max-width: 600px;">
      <ul>
        @foreach ($users as $user)
            @if ($user->disabled)
                @continue
            @endif
            @if ($user == Auth::user())
                <li class="highlight">
                    <form method="POST" action={{ route('movie.pick') }}>
                        @csrf
                        <input type="hidden" name="userId" value={{ Auth::user()->id }}>
                        <li id="highlighted-name" class="pl-4 py-4 cursor-pointer bg-red-900 text-black transition duration-300 ease-in-out transform hover:scale-105 flex items-center glitch-effect" onclick="toggleInput(this)">
                            <span class="block text-lg sm:text-xl mr-4">{{ ucfirst($user->username) }}</span>
                            {{-- <div class="click-indicator ml-4 animate-pulse">
                                <span>&#9758;</span> 
                            </div> --}}
                            
                            <div id="input-container" class="input-container ml-8 flex relative">
                                <input name="movieTitle" id="text-entry" type="text" class="text-entry w-60 px-3 py-1 rounded-lg  border-red-900 focus:outline-none focus:border-red-900 placeholder-red-900 placeholder-opacity-75 mr-2" placeholder="Movie Title">
                                <button id="submit-button" class="play-button right-10 top-0 bottom-0 bg-black border-8 border-black rounded-3xl text-red-900">&#9658;</button>
                            </div> 
                        </li>
                    </form>
                </li>
            @else
                <li class="bg-black rounded-lg border-red-900 border-4 py-4 pl-4 cursor-pointer hover:bg-red-900 hover:text-black transition duration-300 ease-in-out transform hover:scale-105 flex items-center" onclick="toggleInput(this)">
                    <span class="block text-lg sm:text-xl mr-4"> {{ ucfirst($user->username) }}</span>
                </li>
            @endif
        @endforeach
      </ul>
    </div>
  </div>
  <br>
    <div class="block container mx-auto py-8">
        <div class=" mx-auto" style="max-width: 600px;">
            <ul class="fake-terminal">
                <li class="terminal-comment">// Red-Ops Terminal Injection</li>
                @foreach ($moviePicks as $moviePick)
                        <li class="my-2">
                            <span>{{$moviePick->created_at}} => [<span class="highlight">{{ucfirst($moviePick->user->username)}}</span>  picked <span class="highlight">{{$moviePick->movie_title ? $moviePick->movie_title : 'CLASSIFIED'}}</span>] </span>
                        </li>
                @endforeach
            </ul>
            
        </div>
        
    </div>

    

  <!-- Custom JavaScript for toggling input container -->
  <script>
    function toggleInput(element) {
      // Toggle input container
      var inputContainer = element.querySelector('.input-container');
      inputContainer.classList.toggle('show');
      
      // Highlight the selected name
      document.querySelectorAll('.py-4').forEach(item => {
        item.classList.remove('bg-red-900', 'text-black', 'glitch-effect');
      });
      element.classList.add('bg-red-900', 'text-black', 'glitch-effect');
    }
    
    // Prevent input container from closing when clicked
    document.getElementById('input-container').addEventListener('click', function(event) {
      event.stopPropagation();
    });
    
    
  </script>
@endsection
