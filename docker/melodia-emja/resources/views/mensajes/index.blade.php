<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensajes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .message-container {
            display: flex;
            flex-direction: column;
        }
        .message-origin {
            align-self: flex-end;
            background-color: #d4edda; /* Light green */
            padding: 5px 10px;
            border-radius: 5px;
            margin-bottom: 5px;
        }
        .message-destination {
            align-self: flex-start;
            background-color: #cce5ff; /* Light blue */
            padding: 5px 10px;
            border-radius: 5px;
            margin-bottom: 5px;
        }
    </style>
</head>
<body class="container mt-4">
    <div class="row">
        <div class="col-md-3">
            <h2>Usuarios</h2>
            <ul class="list-group">
                @foreach ($usuarios as $usuario)
                    <a href="{{ route('mensajes.index', ['user_id' => $usuario->idUsuario]) }}" class="list-group-item list-group-item-action {{ $usuario->idUsuario == $userId ? 'active' : '' }}">
                        {{ $usuario->nombre }}
                    </a>
                @endforeach
            </ul>
        </div>
        <div class="col-md-9">
            <h2>Mensajes</h2>
            <div class="message-container">
                @if($mensajes->isEmpty())
                    <p>No hay mensajes.</p>
                @else
                    @foreach ($mensajes as $mensaje)
                        @if ($mensaje->origen_usuarios_idUsuario == $userId)
                            <div class="message-origin">{{ $mensaje->mensaje }}</div>
                        @else
                            <div class="message-destination">{{ $mensaje->mensaje }}</div>
                        @endif
                    @endforeach
                @endif
            </div>
            <form action="{{ route('mensajes.store') }}" method="POST" class="mt-3">
                @csrf
                <input type="hidden" name="origen_usuarios_idUsuario" value="{{ $userId }}">
                <input type="hidden" name="destino_usuarios_idUsuario" value="{{ $userId == 1 ? 2 : 1 }}">
                <div class="input-group">
                    <input type="text" name="mensaje" class="form-control" placeholder="Escribe tu mensaje">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
