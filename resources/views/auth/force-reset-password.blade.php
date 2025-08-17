<!DOCTYPE html>
<html lang="es">
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
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <!-- Email Address -->
                    <h2>Reestablecer Contraseña</h2>
                    <p>Tu contraseña ha expirado, crea una nueva contraseña a continuación.</p>

                    <label for="current_password" :value="__('Email')">Contraseña actual:</label>
                    <input id="current_password" type="password"  name="current_password" :value="old('current_password')" required autofocus style="margin-bottom: 0;" />
                    @error('current_password')
                        <p style="text-align: left; margin: 0;">
                            <span style="color: black; font-size: 0.8rem">{{ $message }}</span>
                        </p>
                    @enderror

                    <label for="password" :value="__('Email')" style="margin-top: 20px;">Nueva contraseña:</label>
                    <input id="password" type="password"  name="password" :value="old('password')" required autofocus style="margin-bottom: 0;" />                    

                    <label for="password_confirmation" :value="__('Email')" style="margin-top: 20px;">Confirmar nueva contraseña:</label>
                    <input id="password_confirmation" type="password"  name="password_confirmation" :value="old('password_confirmation')" required autofocus style="margin-bottom: 0;"  />
                    @error('password')
                        <p style="text-align: left; margin: 0;">
                            <span style="color: black; font-size: 0.8rem">{{ $message }}</span>
                        </p>
                    @enderror

                <div class="btn-container-recuperar">
                    <x-primary-button style="margin-top: 20px;">
                        {{ __('Reestablecer contraseña') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
    <a href="https://api.whatsapp.com/send?phone=+573214198536&text=Hola,%20tengo%20una%20pregunta%20sobre%20la%20campa%C3%B1a%20de%20Co%C3%A9xito%2070%20a%C3%B1os%20contigo.%20%C2%BFMe%20puedes%20ayudar?"
        class="whatsapp-float" target="_blank">
        <i class="fab fa-whatsapp whatsapp-icon"></i>
    </a>
</body>
</html>
