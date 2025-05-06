<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mi Aplicación')</title>

    <!-- Incluye los archivos de Vue.js y Mapbox generados por Vite -->
    @vite(['resources/js/app.js', 'resources/css/app.css', 'resources/js/bootstrap.js'])

    <!-- Aquí se incluirían otras bibliotecas si las necesitas, como Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #212529;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Asegura que el cuerpo ocupe al menos el alto de la ventana */
        }
        .content {
            flex-grow: 1; /* Empuja el footer hacia abajo */
        }
        .navbar {
            background-color: #1C1C1C; /* Fondo oscuro */
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .navbar-brand {
            display: flex;
            align-items: center;
            color: #FFFFFF; /* Texto blanco */
            font-weight: bold;
            text-decoration: none;
        }
        .logo {
            width: 50px; /* Tamaño del logo */
            height: 50px;
            margin-right: 1.5rem;
            margin-left: 1.5rem; /* Separación del borde izquierdo */
        }
        .nav-buttons {
            display: flex;
            justify-content: space-evenly; /* Espaciado uniforme entre botones */
            flex-grow: 1; /* Ocupa todo el espacio restante */
            margin: 0 20px; /* Separación del logo y los íconos */
        }
        .nav-link {
            background-color: #E09D89; /* Fondo rosado */
            color: #000000; /* Texto negro */
            font-weight: bold;
            border-radius: 20px; /* Bordes redondeados */
            padding: 5px 15px;
            text-align: center;
            text-decoration: none;
            flex-shrink: 0; /* Evita que los botones se reduzcan demasiado */
        }
        .nav-link:hover {
            background-color: #FFFFFF; /* Fondo blanco al pasar el mouse */
            color: #E09D89; /* Texto rosado */
        }
        .nav-icons {
            display: flex;
            align-items: center;
        }
        .nav-icon {
            color: #E09D89; /* Color de los íconos */
            font-size: 1.5rem;
            text-decoration: none;
            margin-left: 1.5rem;
            margin-right: 1.5rem;
        }
        .nav-icon:hover {
            color: #FFFFFF; /* Cambia a blanco al pasar el mouse */
        }
    </style>
</head>
<body class="d-flex flex-column">

    <nav class="navbar">
        <!-- Logo y texto a la izquierda -->
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo"> <!-- Ruta de la imagen -->
            BEATBITE
        </a>

        <!-- Botones centrados -->
        <div class="nav-buttons">
            <a class="nav-link" href="{{ route('home') }}">Inicio</a>
            <a class="nav-link" href="{{ route('mensajes.index') }}">Chat</a>
            <a class="nav-link" href="{{ route('perfil.edit') }}">Perfil</a>
        </div>

        <!-- Íconos a la derecha -->
        <div class="nav-icons pr-5 pl-5">
            <a href="{{ route('mapa') }}" class="nav-icon">
                <i class="bi bi-map"></i> <!-- Ícono de mapa -->
            </a>
            <a href="{{ route('eventos.create') }}" class="nav-icon">
                <i class="bi bi-plus-circle"></i> <!-- Ícono de agregar -->
            </a>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="content container mt-4">
        @yield('content') <!-- Aquí se inyectará el contenido de las vistas hijas -->
    </div>

    <!-- Footer pegado abajo -->
    <footer class="bg-dark text-light text-center py-3 mt-5">
        <p>Beatbite. Todos los derechos reservados.</p>
    </footer>

    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
