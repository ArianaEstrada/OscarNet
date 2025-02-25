<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WoodWise</title>
    <link rel="stylesheet" href="{{ asset('node_modules/bootstrap/dist/css/bootstrap.min.css') }}">
    <style>
        /* Estilos generales */
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Fuente más moderna */
            color: #fff; /* Texto blanco por defecto */
            background-color: #333; /* Fondo oscuro de respaldo */
            overflow: hidden; /* Oculta el scroll para el video de fondo */
        }

        /* Video de fondo */
        video#bg-video {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -2; /* Detrás del overlay y el contenido */
        }

        /* Overlay para mejorar la legibilidad del texto */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6); /* Fondo semi-transparente */
            z-index: -1; /* Detrás del contenido */
        }

        /* Barra de navegación */
        .navbar {
            position: absolute;
            top: 0;
            right: 0; /* Alineado a la derecha */
            padding: 20px;
            z-index: 10; /* Asegura que esté por encima del contenido */
        }

        .navbar a {
            color: #fff;
            text-decoration: none;
            margin-left: 20px; /* Espacio entre los enlaces */
            font-size: 1.1em;
            transition: color 0.3s ease; /* Transición suave al pasar el ratón */
        }

        .navbar a:hover {
            color: #f8c291; /* Color al pasar el ratón */
        }

        /* Contenedor del título y los botones */
        .container-content {
            text-align: center;
            z-index: 1; /* Asegura que esté por encima del overlay */
        }

        /* Título principal */
        .title {
            font-size: 4em;
            font-weight: bold;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Sombra sutil */
        }

        /* Estilos de los botones */
        .btn-custom {
            padding: 12px 30px;
            font-size: 1.2em;
            border-radius: 30px;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block; /* Permite márgenes laterales */
            margin: 0 10px; /* Espacio entre los botones */
        }

        .btn-register {
            background-color:rgb(166, 248, 145);
            color: #fff;
            border: none;
        }

        .btn-register:hover {
            background-color:rgb(113, 165, 129);
        }

        .btn-login {
            background-color: transparent;
            border: 2px solid #fff;
            color: #fff;
        }

        .btn-login:hover {
            background-color: #fff;
            color: #333;
        }
    </style>
</head>
<body>
    <!-- Video de fondo -->
    <video id="bg-video" autoplay loop muted>
        <source src="{{ asset('Videos/inicio.mp4') }}" type="video/mp4">
        Tu navegador no soporta el video.
    </video>

    <!-- Overlay -->
    <div class="overlay"></div>

    <!-- Barra de navegación -->
    <nav class="navbar">
        <a href="#">Acerca de</a>
        <a href="#">Contacto</a>
    </nav>

    <!-- Contenido principal -->
    <div class="container-content">
        <h1 class="title">OscarNet</h1>
        <div>
            <a href="{{ route('register') }}" class="btn btn-custom btn-register">Regístrate</a>
            <a href="{{ route('login') }}" class="btn btn-custom btn-login">Inicia Sesión</a>
        </div>
    </div>
</body>
</html>
