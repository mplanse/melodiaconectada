@extends('layouts.layout')

@section('content')
    <div class="container">
        <h1>Crear un nuevo evento</h1>

        <!-- Mostrar mensaje de éxito o error -->
        @if(session('success'))
            <div style="color: green; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="color: red; margin-bottom: 20px;">
                {{ session('error') }}
            </div>
        @endif

        <!-- Verificar si el usuario tiene un restaurante asociado -->
        @if(isset($restaurante))
            <form action="{{ route('eventos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf <!-- Token CSRF para proteger el formulario -->

                <!-- Nombre del evento -->
                <div class="form-group">
                    <label for="nombreEvento">Nombre del evento:</label>
                    <input type="text" id="nombreEvento" name="nombreEvento" class="form-control" required>
                </div>

                <!-- Descripción -->
                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" class="form-control"></textarea>
                </div>

                <!-- Imagen multimedia (obligatoria) -->
                <div class="form-group">
                    <label for="imagen">Seleccionar imagen (obligatorio):</label>
                    <input type="file" id="imagen" name="imagen" class="form-control-file" accept="image/*" required>
                    @error('imagen')
                        <div style="color: red;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Fecha -->
                <div class="form-group">
                    <label for="fecha">Fecha:</label>
                    <input type="datetime-local" id="fecha" name="fecha" class="form-control" required>
                </div>

                <!-- Precio -->
                <div class="form-group">
                    <label for="precio">Precio:</label>
                    <input type="number" id="precio" name="precio" class="form-control" min="0" required>
                </div>

                <!-- Restaurante -->
                <div class="form-group">
                    <label for="restaurantes_idRestaurante">Restaurante:</label>
                    <p>{{ $restaurante->nombre }}</p>
                    <input type="hidden" name="restaurantes_idRestaurante" value="{{ $restaurante->idRestaurante }}">
                </div>

                <!-- Botón de envío -->
                <button type="submit" class="btn btn-primary">Guardar evento</button>
            </form>
        @else
            <div style="color: red;">
                No tienes un restaurante asociado. Por favor, crea un restaurante antes de crear un evento.
            </div>
        @endif
    </div>
@endsection
