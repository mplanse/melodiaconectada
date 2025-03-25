<form action="{{ route('register') }}" method="POST">
    @csrf
    <input type="hidden" name="rol" value="{{ $rolSeleccionado }}"> <!-- Campo oculto para el rol -->

    <div class="form-group">
        <label for="username">Nombre de usuario:</label>
        <input type="text" name="username" id="username" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="mail">Correo electrónico:</label>
        <input type="email" name="mail" id="mail" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="password_confirmation">Confirmar contraseña:</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="nombre">Nombre completo:</label>
        <input type="text" name="nombre" id="nombre" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="descripcion">Descripción (opcional):</label>
        <textarea name="descripcion" id="descripcion" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Registrarse</button>
    </div>
</form>
