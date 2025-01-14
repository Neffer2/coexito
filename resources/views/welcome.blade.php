<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
            <img class="flecha-pasos" src="{{ asset('assets/flecha.png') }}" alt="Paso 1">
            <img src="{{ asset('assets/pasos2.png') }}" alt="Paso 2">
            <img class="flecha-pasos" src="{{ asset('assets/flecha.png') }}" alt="Paso 1">
            <img src="{{ asset('assets/pasos3.png') }}" alt="Paso 3">
        </div>
        <div class="info-video-main-container">

            <div class="info-video-container">
                <div class="info-video-text">
                    <h2>Descubre <span>cómo participar</span></h2>
                    <p>Registra tus códigos y participa en la rifa de 6 motos Honda CB100R y 3 camionetas Nissan Kicks
                        2024.</p>
                </div>
                <div class="info-video">
                    <iframe src="https://www.youtube.com/embed/F9IN7aO4P8M?si=WCFZl4mVDm84-QuQ"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
            </div>

        </div>
        <div class="aliados-container">
            <img src="{{ asset('assets/energiteca-logo.png') }}" alt="">
            <img src="{{ asset('assets/mac-logo.png') }}" alt="">
            <img src="{{ asset('assets/coexito-logo.png') }}" alt="">
            <img src="{{ asset('assets/magna-logo.png') }}" alt="">
        </div>

        <div class="main-forms-container">
            @guest
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
                            <input type="text" id="email_login" name="email" placeholder="Correo">
                            <label for="password_login">Contraseña</label>
                            <input type="password" id="password_login" name="password" placeholder="Contraseña">
                            <p>¿No tienes una cuenta? <span class="register-show" id="register_show">Registrate aquí</span>
                            </p>
                            <button type="submit">Aceptar</button>
                        </form>
                    </div>
                    <div class="register-form">
                        <h2>Registro</h2>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <label for="nombre_register">Nombre</label>
                            <input id="nombre_register" name="nombre" value="{{ old('nombre') }}" placeholder="Nombre" />

                            <label for="email_register">Correo electrónico</label>
                            <input id="email_register" name="email" value="{{ old('email') }}" placeholder="Correo" />

                            <label for="documento_register">Documento</label>
                            <input id="documento_register" name="documento" value="{{ old('documento') }}"
                                placeholder="Documento" />

                            <label for="telefono_register">Teléfono</label>
                            <input id="telefono_register" name="telefono" value="{{ old('telefono') }}"
                                placeholder="Teléfono" />

                            <label for="direccion_register">Dirección</label>
                            <input id="direccion_register" name="direccion" value="{{ old('direccion') }}"
                                placeholder="Dirección" />

                            <label for="departamento_register">Departamento</label>
                            <select id="departamento_register" name="departamento" placeholder="Departamento">
                                <option value="1">Departamento</option>
                                <option value="2">Proveedor</option>
                            </select>

                            <label for="ciudad_register">Ciudad</label>
                            <select id="ciudad_register" name="ciudad" placeholder="Ciudad">
                                <option value="1">Ciudad</option>
                                <option value="2">Proveedor</option>
                            </select>

                            <label for="password_register">Contraseña</label>
                            <input id="password_register" type="password" name="password" placeholder="Contraseña" />

                            <label for="password_confirmation_register">Confirmar contraseña</label>
                            <input id="password_confirmation_register" type="password" name="password_confirmation"
                                placeholder="Confirmar contraseña" />

                            <p>¿Ya tienes una cuenta? <span class="login-show" id="login_show">Inicia sesión</span>
                            </p>

                            <div class="checkbox-container">
                                <input id="terminos_condiciones" type="checkbox" name="terminos_condiciones">
                                <label for="terminos_condiciones">Términos y condiciones</label>
                            </div>

                            <div class="checkbox-container">
                                <input id="tratamiento_datos" type="checkbox" name="tratamiento_datos">
                                <label for="tratamiento_datos">Tratamiento de datos</label>
                            </div>

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
                @endguest
                @auth
                    <div class="main-registro-codigos">
                        {{-- <livewire:registro-codigos> --}}
                            <livewire:registro-puntos>
                        <livewire:puntos-registrados>
                    </div>
                @endauth
            </div>
        </div>



        <div class="info-promo-container">
            <img src="{{ asset('assets/info1.png') }}" alt="">
            <div class="info-promo-text">
                <h2>Más de 400.000 millones</h2>
                <p>En premios al instante, participa y se uno de los ganadores de los increíbles premios que tenemos
                    para ti.</p>
            </div>
        </div>

        <div class="info-promo-container-second">
            <img src="{{ asset('assets/info2.png') }}" alt="">
            <div class="info-promo-text-second">
                <h2>Gana una de las 6</h2>
                <p>Motos Honda Cb100R con diseño y Tecnología con ADN Deportivo</p>
                <p>Su diseño deportivo, aspecto agresivo y robusto te hará sentir emociones en tu recorrido siendo
                    una renovación de las mejores sport de Honda.</p>
            </div>
        </div>

        <div class="info-promo-container">
            <img src="{{ asset('assets/info3.png') }}" alt="">
            <div class="info-promo-text">
                <h2>Gana una de las 3</h2>
                <p>Camionetas Nissan Kicks 2024-SUV compactas con motos de 1.6 litros y 118 caballos de fuerza.</p>
            </div>
        </div>
        <div class="slider-cta">
            <div class="cta-container cta-container-1">
                <div class="cta-text">
                    <h2>¡Haz parte de nuestros clientes!</h2>
                    <p>Regístrate y conoce las mejores marcas</p>
                    <button aria-label="Regístrarme" id="registrame_btn">Regístrarme</button>
                </div>
                <button class="slider-button left-button" aria-label="Anterior">
                    <i class="fa-solid fa-circle-chevron-left"></i>
                </button>
                <button class="slider-button right-button" aria-label="Siguiente">
                    <i class="fa-solid fa-circle-chevron-right"></i>
                </button>
            </div>

            <div class="cta-container cta-container-2">
                <div class="cta-text">
                    <h2>¡Haz parte de nuestros clientes!</h2>
                    <p>Regístrate y empieza a vender las mejores marcas</p>
                    <button aria-label="Quiero ser cliente" id="cliente_btn">Quiero ser cliente</button>
                </div>
                <button class="slider-button left-button" aria-label="Anterior">
                    <i class="fa-solid fa-circle-chevron-left"></i>
                </button>
                <button class="slider-button right-button" aria-label="Siguiente">
                    <i class="fa-solid fa-circle-chevron-right"></i>
                </button>
            </div>
        </div>

        <div class="aliados-container-bottom">
            <img src="{{ asset('assets/energiteca-logo.png') }}" alt="">
            <img src="{{ asset('assets/mac-logo.png') }}" alt="">
            <img src="{{ asset('assets/coexito-logo.png') }}" alt="">
            <img src="{{ asset('assets/magna-logo.png') }}" alt="">
        </div>

    </div>



    <div class="bottom-line"></div>

</body>
<script>
    const registroShow = document.getElementById('register_show');

    if (registroShow) {
        registroShow.addEventListener('click', () => {
            const loginForm = document.querySelector('.login-form');
            const registerForm = document.querySelector('.register-form');

            loginForm.style.display = 'none';
            registerForm.style.display = 'flex';
        });
    }

    const loginShow = document.getElementById('login_show');

    if (loginShow) {

        loginShow.addEventListener('click', () => {
            const loginForm = document.querySelector('.login-form');
            const registerForm = document.querySelector('.register-form');

            loginForm.style.display = 'flex';
            registerForm.style.display = 'none';
        });

    }

    const registrameBtn = document.getElementById('registrame_btn');

    if (registrameBtn) {
        registrameBtn.addEventListener('click', () => {
            window.location.href = 'https://www.coexito.com.co/';
        });
    }

    const clienteBtn = document.getElementById('cliente_btn');

    if (clienteBtn) {
        clienteBtn.addEventListener('click', () => {
            window.location.href = 'https://www.coexito.com.co/contacto';
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const containers = document.querySelectorAll('.cta-container');
        const leftButtons = document.querySelectorAll('.left-button');
        const rightButtons = document.querySelectorAll('.right-button');

        let currentIndex = 0;

        function showContainer(index) {
            containers.forEach((container, i) => {
                if (i === index) {
                    container.classList.add('active');
                } else {
                    container.classList.remove('active');
                }
            });
        }

        leftButtons.forEach(button => {
            button.addEventListener('click', () => {
                currentIndex = (currentIndex === 0) ? containers.length - 1 : currentIndex - 1;
                showContainer(currentIndex);
            });
        });

        rightButtons.forEach(button => {
            button.addEventListener('click', () => {
                currentIndex = (currentIndex === containers.length - 1) ? 0 : currentIndex + 1;
                showContainer(currentIndex);
            });
        });

        showContainer(currentIndex);
    });
</script>

</html>
