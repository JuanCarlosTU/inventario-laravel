<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sistema de Inventario</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="d-flex flex-column min-vh-100 bg-light">
        <div class="container text-center py-5">
            <img src="storage/img/LOGO.svg" style="max-width: 25%" alt="MI" />
            <h1 class="display-4">Bienvenido al Sistema de Inventario</h1>
            <p class="lead">Esta herramienta es para que puedas oredenar tus bienes, 
                ya sea que estes a cargo de una bodega o de un almacen o 
                incluso si quieres ordenar tu propia despensa o herramientas, 
                de esta manera tendras un control mas exacto de lo que tienes a tu cargo.</p>
            <a href="{{ url('/dashboard') }}" class="btn btn-primary">Ir a tu inventario...</a>
        </div>
       
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
