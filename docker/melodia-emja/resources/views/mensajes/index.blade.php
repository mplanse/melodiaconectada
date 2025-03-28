@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h5>Contactos</h5>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        @foreach($usuarios as $usuario)
                            <a href="{{ route('mensajes.index', ['user_id' => $usuario->idUsuario]) }}"
                               class="list-group-item list-group-item-action">
                                {{ $usuario->nombre }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h5>Conversaciones recientes</h5>
                </div>
                <div class="card-body">
                    @if(isset($conversations) && $conversations->count() > 0)
                        <div class="list-group">
                            @foreach($conversations as $item)
                                @php
                                    $message = isset($item['message']) ? $item['message'] : $item;
                                    $contact = isset($item['contact']) ? $item['contact'] : null;
                                    $isIncoming = $message->destino_usuarios_idUsuario == $userId;
                                    $contactId = $isIncoming ? $message->origen_usuarios_idUsuario : $message->destino_usuarios_idUsuario;
                                    $contactName = $contact ? $contact->nombre :
                                                    (Usuario::find($contactId) ? Usuario::find($contactId)->nombre : 'Usuario desconocido');
                                @endphp
                                <a href="{{ route('mensajes.index', ['user_id' => $contactId]) }}"
                                   class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{ $contactName }}</h5>
                                        <small>{{ \Carbon\Carbon::parse($message->timestamp)->format('d/m/Y H:i') }}</small>
                                    </div>
                                    <p class="mb-1 text-truncate">
                                        @if(!$isIncoming)
                                            <strong>Tú:</strong>
                                        @endif
                                        {{ $message->texto_mensaje }}
                                    </p>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-info">
                            No tienes conversaciones activas. ¡Comienza a hablar con alguien!
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
