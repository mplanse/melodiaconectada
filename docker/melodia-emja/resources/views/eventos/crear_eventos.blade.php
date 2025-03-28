@extends('layouts.layout')

@section('content')
    <div class="container">
        <h1>Crear un nuevo evento</h1>

        <!-- Mostrar mensaje de éxito si existe -->
        @if(session('success'))
            <div style="color: green; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        <!-- Formulario para crear un evento -->
        <form action="{{ route('eventos.store') }}" method="POST">
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

            <!-- URL multimedia -->
            <div class="form-group">
                <label for="urlMultimedia">URL multimedia (opcional):</label>
                <input type="url" id="urlMultimedia" name="urlMultimedia" class="form-control">
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
                @if(session('restaurante_nombre'))
                    <p>{{ session('restaurante_nombre') }}</p>
                    <input type="hidden" name="restaurantes_idRestaurante" value="{{ session('restaurante_id') }}">
                @else
                    <p>No se ha seleccionado ningún restaurante.</p>
                @endif
            </div>

            <!-- Botón de envío -->
            <button type="submit" class="btn btn-primary">Guardar evento</button>
        </form>
    </div>
@endsection
