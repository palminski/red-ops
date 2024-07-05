<nav class=" p-4">
    <ul class="flex space-x-4">
        <li> <a href="/">Home</li></a>
        
        @if (Auth::check())
            <li> 
                <a href={{route('movie-queue')}}>Movies</a>
            </li>
            @if (Auth::user()->admin)
            <li>
                <a href={{route('admin.index')}}>Admin</a>
            </li>
            @endif
            <li>
                <form action="{{route('logout')}}" method="post">
                    @csrf
                    <button class="link-button" type="submit">Log Out</button>
                </form>
            </li>
        @else
            <li> <a href={{route('login')}}>Log In</a></li>
            <li> <a href={{route('signup')}}>Sign Up</a></li>
        @endif
        
        {{-- <li><a href="https://palminski.github.io/myriad-conniptions/" target="_blank">My Portfolio</a></li> --}}
    </ul>
</nav>