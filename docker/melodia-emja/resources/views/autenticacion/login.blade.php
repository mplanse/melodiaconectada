<form action="{{ route('login') }}" method="POST">
    @csrf
    <input type="email" name="mail" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>
