<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('assets/icon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/ruleta-sorteo.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/custom-ruleta.css') }}?v={{ time() }}">
    <title>Ruleta Sorteo</title>
    @livewireStyles
</head>

<body>
    <div>
        <livewire:ruleta-sorteo>
            @livewireScripts
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</html>
