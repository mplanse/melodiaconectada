<form action="{{ route('register') }}" method="POST">
    @csrf
    <input type="text" name="username" placeholder="Username" required>
    <input type="email" name="mail" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
    <input type="text" name="nombre" placeholder="Nombre completo" required>
    <textarea name="descripcion" placeholder="Descripción"></textarea>
    <button type="submit">Register</button>
</form>
