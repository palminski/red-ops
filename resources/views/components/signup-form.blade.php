
@if (session('error-message'))
<h3 style="color: red">{{ session('error-message') }}</h3>
@endif
<form action="{{route('add-user')}}" method="POST">
    @csrf
    <h2>Sign-Up</h2>
    <div>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
    </div>
    <div>
        <button type="submit">Sign Up</button>
    </div>
</form>