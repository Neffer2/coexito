<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/ruleta-device.css') }}">
    <title>Coexitocontigo</title>
</head>
<body>
    <div id="game-container-desk"></div>
    <div id="game-container-mobile"></div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script type="module" src="{{ asset('src/phaser.min.js') }}"></script>
    <script type="module" src="{{ asset('src/desk/main.js') }}"></script>

    <script type="module" src="{{ asset('src/phaser.min.js') }}"></script>
    <script type="module" src="{{ asset('src/mobile/main.js') }}"></script>

    <script type="module" src="{{ asset('src/mobile/tools/confetti.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tsparticles/confetti@3.0.3/tsparticles.confetti.bundle.min.js"></script>
</body>
</html>