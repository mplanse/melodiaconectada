<form action="{{ route('register.show') }}" method="GET">
    @csrf
    <div class="form-group">
        <label for="rol">Selecciona tu rol:</label>
        <select name="rol" id="rol" class="form-control" required>
            <option value="">-- Selecciona un rol --</option>
            @foreach($roles as $rol)
                <option value="{{ $rol->idRol }}">{{ $rol->nombreRol }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Continuar</button>
    </div>
</form>
