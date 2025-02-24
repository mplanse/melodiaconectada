@extends('layouts.layout') <!-- Asegúrate de extender una plantilla base -->

@section('content') <!-- Abrimos la sección correctamente -->

<div class="container">
    <h1 class="mb-4">Lista de Eventos</h1>

    @if ($eventos->count() > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Fecha</th>
                    <th>Precio</th>
                    <th>Imagen</th> <!-- Nueva columna para la imagen -->
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($eventos as $evento)
                    <tr>
                        <td>{{ $evento->idEventos }}</td>
                        <td>{{ $evento->nombreEvento }}</td>
                        <td>{{ $evento->descripcion }}</td>
                        <td>{{ $evento->fecha }}</td>
                        <td>{{ $evento->precio }} €</td>
                        <td>
                            @if ($evento->urlMultimedia)
                                <img src="{{ asset($evento->urlMultimedia) }}" alt="Imagen del evento" width="100" height="100" class="img-thumbnail">
                            @else
                                <span class="text-muted">Sin imagen</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('eventos.show', $evento->idEventos) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('eventos.edit', $evento->idEventos) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('eventos.destroy', $evento->idEventos) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este evento?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Paginación -->
        <div class="d-flex justify-content-center">
            {{ $eventos->links() }}
        </div>
    @else
        <p>No hay eventos disponibles.</p>
    @endif
</div>

@endsection
