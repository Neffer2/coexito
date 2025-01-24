<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/aliados.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/cta-slider.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/info-promo.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/login-register.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/pasos.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/registro-codigos.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/top-container.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/reset-password.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Coexitocontigo</title>
</head>
<body>
    <div class="main-container">
        <div class="recuperar-container">
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <!-- Email Address -->
                    <h2>Recuperar Contraseña</h2>
                    <label for="email" :value="__('Email')">Correo:</label>
                    <input id="email" type="email"  name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />

                <div class="btn-container-recuperar">
                    <x-primary-button>
                        {{ __('Enviar correo de recuperación') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
