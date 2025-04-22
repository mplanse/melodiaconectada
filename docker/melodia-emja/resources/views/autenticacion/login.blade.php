@extends('layouts.layout')

@section('title', 'Login - MelodiaConectada')

@section('content')
<div class="login-container">
    <div class="login-card">
        <h2 class="login-title">Iniciar Sesión</h2>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="login-form">
            @csrf
            <div class="form-group">
                <label for="email"><i class="fas fa-envelope"></i> Email</label>
                <input type="email" name="mail" id="email" class="form-control" placeholder="Tu email" required>
            </div>

            <div class="form-group">
                <label for="password"><i class="fas fa-lock"></i> Contraseña</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Tu contraseña" required>
            </div>

            <button type="submit" class="btn-login">Iniciar Sesión</button>
        </form>

        <div class="login-footer">
            <p>¿No tienes una cuenta? <a href="{{ route('register') }}" class="register-link">Regístrate</a></p>
        </div>
    </div>
</div>

<style>
.login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 80vh;
}

.login-card {
    background-color: #222;
    border-radius: 10px;
    padding: 2.5rem;
    width: 100%;
    max-width: 450px;
    box-shadow: 0px 0px 15px rgba(60, 60, 60, 0.5);
}

.login-title {
    color: #fff;
    font-size: 1.8rem;
    margin-bottom: 1.5rem;
    text-align: center;
}

.login-form {
    display: flex;
    flex-direction: column;
    gap: 1.2rem;
}

.form-group {
    position: relative;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    color: #e0e0e0;
    font-size: 0.9rem;
}

.form-control {
    width: 100%;
    padding: 0.75rem 1rem;
    border: none;
    border-radius: 5px;
    background-color: rgba(255, 255, 255, 0.1);
    color: #fff;
}

.btn-login {
    padding: 0.75rem 1rem;
    border: none;
    border-radius: 5px;
    background-color: #ff6b6b;
    color: #fff;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-login:hover {
    background-color: #ff4c4c;
}

.login-footer {
    margin-top: 1.5rem;
    text-align: center;
}

.login-footer p {
    color: #e0e0e0;
    font-size: 0.9rem;
}

.register-link {
    color: #ff6b6b;
    text-decoration: none;
    font-weight: bold;
}

.register-link:hover {
    text-decoration: underline;
}
</style>
@endsection
