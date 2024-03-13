<!-- resources/views/auth/login.blade.php -->
<form method="POST" action="{{ route('login') }}">
    @csrf

    <input type="email" name="email" value="{{ old('email') }}" required autofocus>
    <input type="password" name="password" required>

    <button type="submit">Login</button>
</form>
