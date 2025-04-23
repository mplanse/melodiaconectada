@extends('layouts.layout')

@section('title', $evento->nombreEvento)

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <!-- Imagen del evento -->
            @if ($evento->urlMultimedia)
                <img src="{{ asset('img/' . $evento->urlMultimedia) }}" alt="{{ $evento->nombreEvento }}" class="img-fluid rounded">
            @else
                <div class="bg-secondary text-light d-flex align-items-center justify-content-center" style="height: 300px;">
                    <span>Sin imagen</span>
                </div>
            @endif
        </div>
        <div class="col-md-6">
            <!-- Detalles del evento -->
            <h1 class="mb-3 text-white">{{ $evento->nombreEvento }}</h1>
            <p class="text-white">{{ $evento->descripcion }}</p>
            <p class="text-white"><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($evento->fecha)->format('d/m/Y') }}</p>
            <p class="text-white"><strong>Precio:</strong> {{ $evento->precio }}€</p>
        </div>
    </div>
</div>
@endsection
