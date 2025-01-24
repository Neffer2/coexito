<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <h2>Reestablecer Contraseña</h2>
                <div>
                    <label for="email">Correo:</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" />
                    @error('email')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password">Contraseña:</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password" />
                    @error('password')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation">Confirmar Contraseña:</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
                    @error('password_confirmation')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div class="btn-container-recuperar">
                    <button type="submit">
                        {{ __('Reestablecer contraseña') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>