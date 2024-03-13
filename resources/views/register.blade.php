<!-- resources/views/auth/register.blade.php -->
<form method="POST" action="{{ route('register') }}">
    @csrf

    <input type="text" name="name" value="{{ old('name') }}" required>
    <input type="email" name="email" value="{{ old('email') }}" required>
    <input type="password" name="password" required>
    <input type="password" name="password_confirmation" required>

    <button type="submit">Register</button>
</form>
