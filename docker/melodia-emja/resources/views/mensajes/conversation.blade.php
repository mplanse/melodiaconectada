@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h5>Contactos</h5>
                    <a href="{{ route('mensajes.index') }}" class="btn btn-sm btn-secondary">Volver a mensajes</a>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        @foreach($usuarios as $usuario)
                            <a href="{{ route('mensajes.index', ['user_id' => $usuario->idUsuario]) }}"
                               class="list-group-item list-group-item-action {{ $usuario->idUsuario == $otherUserId ? 'active' : '' }}">
                                {{ $usuario->nombre }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Conversación con {{ $otherUser->nombre }}</h5>
                </div>
                <div class="card-body" style="height: 400px; overflow-y: auto;" id="mensaje-container">
                    @if($mensajes->count() > 0)
                        <div class="mensaje-list">
                            @foreach($mensajes as $mensaje)
                                <div class="mensaje mb-3 {{ $mensaje->origen_usuarios_idUsuario == $currentUserId ? 'text-end' : '' }}">
                                    <div class="card {{ $mensaje->origen_usuarios_idUsuario == $currentUserId ? 'bg-primary text-white ms-auto' : 'bg-light' }}"
                                         style="max-width: 80%; display: inline-block;">
                                        <div class="card-body py-2 px-3">
                                            <p class="mb-0">{{ $mensaje->texto_mensaje }}</p>
                                            <small class="d-block {{ $mensaje->origen_usuarios_idUsuario == $currentUserId ? 'text-white-50' : 'text-muted' }}">
                                                {{ \Carbon\Carbon::parse($mensaje->timestamp)->format('d/m/Y H:i') }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-info">
                            No hay mensajes. ¡Comienza la conversación!
                        </div>
                    @endif
                </div>
                <div class="card-footer">
                    <form action="{{ route('mensajes.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="origen_usuarios_idUsuario" value="{{ $currentUserId }}">
                        <input type="hidden" name="destino_usuarios_idUsuario" value="{{ $otherUserId }}">
                        <div class="input-group">
                            <input type="text" name="texto_mensaje" class="form-control" placeholder="Escribe tu mensaje..." required>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Scroll to bottom of message container
    const container = document.getElementById('mensaje-container');
    container.scrollTop = container.scrollHeight;
});
</script>
@endsection
