<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Selecciona tu Rol - MelodiaConectada</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
    <div class="role-selection-container">
        <!-- Background sides -->
        <div class="role-side musician-side"></div>
        <div class="role-side restaurant-side"></div>

        <div class="role-selection-content">
            <h1 class="role-title">Selecciona tu Rol</h1>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="roles-display">
                <div class="role-option musician-role" onclick="openRegisterModal('musician')">
                    <div class="role-button">
                        <span>Soy Músico</span>
                    </div>
                </div>

                <div class="logo-container">
                    <img src="{{ asset('img/logo.png') }}" alt="MelodiaConectada Logo" class="site-logo">
                </div>

                <div class="role-option restaurant-role" onclick="openRegisterModal('restaurant')">
                    <div class="role-button">
                        <span>Soy Restaurante</span>
                    </div>
                </div>
            </div>

            <div class="role-footer">
                <p>¿Ya tienes una cuenta? <a href="{{ route('login') }}" class="login-link">Inicia sesión</a></p>
            </div>
        </div>
    </div>

    <!-- Modal para registro de Músico -->
    <div id="modalMusician" class="modal modal-musician">
        <div class="modal-overlay" onclick="closeRegisterModal('musician')"></div>
        <div class="modal-content">
            <span class="close-btn" onclick="closeRegisterModal('musician')">&times;</span>
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="form-logo">

            <form action="{{ route('register') }}" method="POST" class="register-form">
                @csrf
                <input type="hidden" name="rol" value="1">

                <input type="text" name="username" class="form-control" placeholder="Nombre de usuario" value="{{ old('username') }}" required>
                <input type="email" name="mail" class="form-control" placeholder="Correo electrónico" value="{{ old('mail') }}" required>
                <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmar contraseña" required>
                <input type="text" name="nombre" class="form-control" placeholder="Nombre artístico o completo" value="{{ old('nombre') }}" required>
                <textarea name="descripcion" class="form-control" placeholder="Descripción como músico (opcional)" rows="2">{{ old('descripcion') }}</textarea>

                <button type="submit" class="btn-register">REGISTRARSE</button>
            </form>
        </div>
    </div>

    <!-- Modal para registro de Restaurante -->
    <div id="modalRestaurant" class="modal modal-restaurant">
        <div class="modal-overlay" onclick="closeRegisterModal('restaurant')"></div>
        <div class="modal-content">
            <span class="close-btn" onclick="closeRegisterModal('restaurant')">&times;</span>
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="form-logo">

            @if ($errors->any())
            <div class="alert alert-danger modal-alert">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="register-form">
                @csrf
                <input type="hidden" name="rol" value="2">

                <input type="text" name="username" class="form-control" placeholder="Nombre de usuario" value="{{ old('username') }}" required>
                <input type="email" name="mail" class="form-control" placeholder="Correo electrónico" value="{{ old('mail') }}" required>
                <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmar contraseña" required>
                <input type="text" name="nombre" class="form-control" placeholder="Nombre del establecimiento" value="{{ old('nombre') }}" required>
                <textarea name="descripcion" class="form-control" placeholder="Descripción del restaurante (opcional)" rows="2">{{ old('descripcion') }}</textarea>

                <button type="submit" class="btn-register">Registrarse</button>
            </form>
        </div>
    </div>

    <script>
        // Funciones para manejar los modales
        function openRegisterModal(type) {
            if (type === 'musician') {
                document.getElementById('modalMusician').style.display = 'block';
            } else if (type === 'restaurant') {
                document.getElementById('modalRestaurant').style.display = 'block';
            }
            document.body.style.overflow = 'hidden';
        }

        function closeRegisterModal(type) {
            if (type === 'musician') {
                document.getElementById('modalMusician').style.display = 'none';
            } else if (type === 'restaurant') {
                document.getElementById('modalRestaurant').style.display = 'none';
            }
            document.body.style.overflow = 'hidden'; // Mantener hidden por el fondo
        }
    </script>
</body>
</html>

