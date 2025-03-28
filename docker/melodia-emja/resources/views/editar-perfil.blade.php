@extends('layouts.layout')

@section('content')
<div class="container mt-5">
    <h2>Editar Perfil</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('perfil.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $usuario->nombre) }}" required>
        </div>

        <div class="form-group">
            <label for="mail">Correo Electrónico</label>
            <input type="email" name="mail" class="form-control" value="{{ old('mail', $usuario->mail) }}" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" class="form-control">{{ old('descripcion', $usuario->descripcion) }}</textarea>
        </div>

        <div class="form-group">
            <label for="password">Nueva Contraseña (opcional)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirmar Contraseña</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Guardar cambios</button>
    </form>
</div>
@endsection
