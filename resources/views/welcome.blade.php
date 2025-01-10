<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}?v={{ time() }}">
    <title>Coexitocontigo</title>
</head>

<body>
    <div class="main-container">
        <div class="top-container">
            <div class="top-logos-images">
                <img src="{{ asset('assets/coexito-logo-white.png') }}" alt="">
                <img src="{{ asset('assets/coljuegos.png') }}" alt="">
            </div>
            <div class="top-container-info">
                <div class="top-container-left-info">
                    <img src="{{ asset('assets/premios-info.png') }}" alt="">
                </div>

                <div class="top-container-right-info">
                    <img src="{{ asset('assets/img-70.png') }}" alt="">
                </div>
            </div>
        </div>
        <div class="bottom-line"></div>
        <div class="pasos-container">
            <img src="{{ asset('assets/pasos1.png') }}" alt="Paso 1">
            <img src="{{ asset('assets/pasos2.png') }}" alt="Paso 2">
            <img src="{{ asset('assets/pasos3.png') }}" alt="Paso 3">
        </div>
        <div class="info-video-container"></div>
        <div class="aliados-container">
            <img src="{{ asset('assets/energiteca-logo.png') }}" alt="">
            <img src="{{ asset('assets/mac-logo.png') }}" alt="">
            <img src="{{ asset('assets/coexito-logo.png') }}" alt="">
            <img src="{{ asset('assets/magna-logo.png') }}" alt="">
        </div>
        @guest
        <div class="main-forms-container">
            <div class="codigos-form-container">
                <div class="codigos-form-text">
                    <h2>Registra <span>tus códigos </span>ahora</h2>
                </div>
                <div class="codigos-terminos">
                    <p>Descarga <span>términos y condiciones</span></p>
                    <button>Aquí</button>
                </div>

            </div>
            <div class="login-register-container">
                <div class="login-form">
                    <h2>Iniciar sesión</h2>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <label for="email_login">Correo electrónico</label>
                        <input type="text" id="email_login" name="email" placeholder="Email">
                        <label for="password_login">Contraseña</label>
                        <input type="password" id="password_login" name="password" placeholder="Password">
                        <p>¿No tienes una cuenta? <span class="register-show" id="register_show">Registrate aquí</span></p>
                        <button type="submit">Aceptar</button>
                    </form>
                </div>
                <div class="register-form">
                    <h2>Registro</h2>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <label for="nombre_register">Nombre</label>
                        <input id="nombre_register" name="nombre" :value="old('nombre')" placeholder="Nombre" />
                        <label for="email_registe">Correo electrónico</label>
                        <input id="email_registe" name="email" :value="old('nombre')" placeholder="Correo" />
                        <label for="documento_register">Documento</label>
                        <input id="documento_register" name="documento" :value="old('documento')" placeholder="Documento" />
                        <label for="telefono_register">Teléfono</label>
                        <input id="telefono_register" name="télefono" :value="old('telefono')" placeholder="Telefono" />
                        <label for="direccion_register">Dirección</label>
                        <input id="direccion_register" name="direccion" :value="old('direccion')" placeholder="Dirección" />
                        <label for="departamento_register">Departamento</label>
                        <select id="departamento_register" name="" placeholder="Departamento">
                            <option value="1">Departamento</option>
                            <option value="2">Proveedor</option>
                        </select>
                        <label for="ciudad_register">Ciudad</label>
                        <select id="ciudad_register" name="ciudad" placeholder="Ciudad">
                            <option value="1">Ciudad</option>
                            <option value="2">Proveedor</option>
                        </select>
                        <label for="password_register">Contraseña</label>
                        <input id="password_register" type="password" name="password" placeholder="Confirmar contraseña" />
                        <label for="password_confirmation_register">Confirmar contraseña</label>
                        <input id="password_confirmation_register" type="password" name="password_confirmation"
                            placeholder="Confirmar contraseña" />

                        <input id="terminos_condiciones" type="checkbox" name="terminos_condiciones"> Terminos y condiciones
                        <input id="tratamiento_datos" type="checkbox" name="tratamiento_datos" /> Tratamiento de datos

                        <button type="submit">Registrar</button>
                    </form>
                </div>
                {{-- @if ($errors->any())
                    <div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}
            </div>
        </div>
        @endguest
        @auth
            <h2>Registro de codigos</h2>
            <livewire:registro-codigos>
        @endauth

        <div class="info-promo-container">
            <img src="{{ asset('assets/info1.png') }}" alt="">
            <div class="info-promo-text">
                <h2>Más de 400.000 millones</h2>
                <p>En premios al instante, participa y se uno de los ganadores de los increíbles premios que tenemos para ti.</p>
            </div>
        </div>

        <div class="info-promo-container-second">
            <img src="{{ asset('assets/info2.png') }}" alt="">
            <div class="info-promo-text-second">
                <h2>Gana una de las 6</h2>
                <p>Motos Honda Cb100R con diseño y Tecnología con ADN Deportivo</p>
                <p>Su diseño deportivo, aspecto agresivo y robusto te hará sentir emociones en tu recorrido siendo una renovación de las mejores sport de Honda.</p>
            </div>
        </div>

        <div class="info-promo-container">
            <img src="{{ asset('assets/info3.png') }}" alt="">
            <div class="info-promo-text">
                <h2>Gana una de las 3</h2>
                <p>Camionetas Nissan Kicks 2024-SUV compactas con motos de 1.6 litros y 118 caballos de fuerza.</p>
            </div>
        </div>
    </div>

    <div class="bottom-line"></div>

</body>
<script>
    const registroShow = document.getElementById('register_show');

    registroShow.addEventListener('click', () => {
        const loginForm = document.querySelector('.login-form');
        const registerForm = document.querySelector('.register-form');

        loginForm.style.display = 'none';
        registerForm.style.display = 'flex';
    });
</script>

</html>
