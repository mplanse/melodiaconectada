<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Iniciar Sesión - BeatBite</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body class="bodinlogin">
    <div class="login-container">
        <!-- Lado izquierdo: Logo y nombre de la app -->
        <div class="login-branding">
            <img src="{{ asset('img/logo.png') }}" alt="MelodíaConectada" class="login-logo">
            <h1 class="login-app-name">BEATBITE</h1>
            <p class="login-tagline">Conectando músicos y restaurantes para crear experiencias inolvidables.</p>
        </div>

        <!-- Lado derecho: Formulario de login -->
        <div class="login-card">
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
                <input type="email" name="mail" class="form-control" placeholder="Correo electrónico" required>
                <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
                <button type="submit" class="btn-login">Iniciar Sesión</button>
            </form>

            <div class="login-divider"></div>
            <div class="login-footer">
                <p>¿Eres músico o restaurante? <a href="{{ route('register') }}">Regístrate gratis</a></p>
            </div>


        </div>
    </div>
</body>
</html>

