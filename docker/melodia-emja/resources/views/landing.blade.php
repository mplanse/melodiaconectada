<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="contenedor">
        <img src="{{ asset('img/logo.png') }}" alt="BeatBite Logo" class="logo">
        <h1>"BeatBite: Donde la música en vivo encuentra su escenario perfecto."</h1>
        <div class="botones">
            <a href="#" class="btn btn-iniciar">Iniciar sesión</a>
            <a href="#" class="btn btn-registrar">Registrarse</a>
        </div>
        <div class="flecha">
            &#9660;
        </div>
    </div>

    <div class='carrusel'>
        <h1 class='h1_melodia'>🎶 MELODÍA CONECTADA: DA VIDA A TU <br> NEGOCIO CON MÚSICA EN DIRECTO 🎶</h1>

        <h4>Músicos y restaurantes conectados en una sola plataforma.</h4>

        <div class="carousel">
            <button class="carousel-button left">&#9664;</button>
            <img src="{{ asset('img/imagen1.jpg') }}">
            <img src="{{ asset('img/imagen2.jpg') }}">
            <img src="{{ asset('img/imagen3.jpg') }}">
            <img src="{{ asset('img/imagen4.jpg') }}">
            <img src="{{ asset('img/imagen5.jpg') }}">
            <button class="carousel-button right">&#9654;</button>
        </div>
    </div>
    <div class="container-faqs">
    <div class="beatbite-container">
        <h2 class="beatbite-title">¿CÓMO FUNCIONA BEATBITE?</h2>
        <ul class="beatbite-list">
            <li class="beatbite-item">🎵 Descubre la nueva forma de conectar con la música en vivo: contratar un músico es muy fácil (buscas, chateas y confirmas la reserva).</li>
            <li class="beatbite-item">🎤 <strong>Músicos:</strong> tienen la libertad de fijar su propio precio.</li>
            <li class="beatbite-item">🍽️ <strong>Restaurantes:</strong> pueden elegir entre opciones gratuitas y premium para usar la plataforma.</li>
            <li class="beatbite-item">👤 <strong>Crea tu perfil:</strong> conéctate con músicos o locales, y contrata para disfrutar de la experiencia.</li>
            <li class="beatbite-item">🗺️ <strong>Mapa interactivo:</strong> encuentra eventos en vivo cerca de ti.</li>
            <li class="beatbite-item">💬 <strong>Chat integrado:</strong> habla directamente con músicos y negocios.</li>
            <li class="beatbite-item">📅 <strong>Gestión de eventos:</strong> organiza tus actuaciones fácilmente.</li>
            <li class="beatbite-item">🚀 <strong>El futuro de la música en vivo empieza aquí.</strong></li>
            <li class="beatbite-item">❓ <strong>¿Tienes más preguntas?</strong></li>
        </ul>
    </div>
</div>
    <div class="contact-container">
        <div class="contact-card">
            <h2 class="contact-title">CONTACTANOS</h2>

            <form action="#" method="POST">
                <div class="mb-3">
                    <label class="form-label text-light">TU CORREO</label>
                    <input type="email" name="email" class="form-control bg-light" placeholder="Ingresa tu correo" required>
                </div>

                <div class="mb-3">
                    <label class="form-label text-light">ASUNTO</label>
                    <input type="text" name="subject" class="form-control bg-light" placeholder="Asunto" required>
                </div>

                <div class="mb-3">
                    <label class="form-label text-light">MSG</label>
                    <textarea name="message" class="form-control bg-light" rows="4" placeholder="Escribe tu mensaje" required></textarea>
                </div>

                <button type="submit" class="btn btn-success btn-submit">Enviar</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/carousel.js') }}"></script>

</body>

</html>
