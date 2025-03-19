
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
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

    <script src="{{ asset('js/carousel.js') }}"></script>
        
</body> 
</html>
