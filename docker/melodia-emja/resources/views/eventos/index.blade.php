
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
</body>
</html>

