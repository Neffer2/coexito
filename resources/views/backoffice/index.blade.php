<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Dashboard</title>
</head>
<body>
    <div class="container">
        <ul>
            <li><a href="{{ route('backoffice-shopper') }}">Shopper</a></li>
            <li><a href="{{ route('backoffice-recomendador') }}">Recomendadores</a></li>
            <li><a href="{{ route('backoffice-fv') }}">Fuerza de Ventas</a></li>
            <li><a href="{{ route('backoffice-lista-shopper')}}">Lista de Usuarios Landing (Shopper - Asesores)</a></li>
            <li><a href="{{ route('backoffice-lista-recomendador')}}">Lista de Recomendadores</a></li>
            <li><a href="{{ route('backoffice-total-bonos') }}">Total de Bonos</a></li>
            <li><a href="{{ route('backoffice-filtro-recomendador') }}">Filtro Recomendador</a></li>
        </ul>
    </div>
</body>
</html>
