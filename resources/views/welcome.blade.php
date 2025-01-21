<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Coexitocontigo</title>
</head>

<body>
    <div class="main-container">
        <div class="top-container">
            <div class="top-logos-images">
                <img class="coexito-logo" src="{{ asset('assets/coexito-logo-white.png') }}" alt="">
                <img src="{{ asset('assets/coljuegos.png') }}" alt="">
            </div>
            <div class="top-container-info">
                <div class="top-container-left-info">
                    <img src="{{ asset('assets/premios-info.png') }}" alt="">
                </div>

                <div class="top-container-right-info">
                    <img src="{{ asset('assets/img-70.png') }}" alt="">
                    <button id="btn_scroll_to_form">¡Participa aquí!</button>
                </div>
            </div>

            <div class="top-container-info-mobile">

                <div class="top-mobile-info">
                    <img class="top-mobile-info-img-first" src="{{ asset('assets/coexito-logo-white.png') }}"
                        alt="">
                    <img class="top-mobile-info-img-second" src="{{ asset('assets/img-70.png') }}" alt="">
                </div>

                <div class="top-mobile-button">
                    <div class="car-mobile-img">
                        <img src="{{ asset('assets/premios-info.png') }}" alt="">
                    </div>
                    <div class="button-mobile">

                        <button id="btn_scroll_to_form_mobile">Participa aquí</button>
                    </div>

                </div>
            </div>
        </div>
        <div class="bottom-line"></div>
        <div class="main-pasos-container">
            <div class="pasos-text-container">
                <img src="{{ asset('assets/titulo-top-mobile.png') }}" alt="texto">
            </div>
            <div class="pasos-container">
                <img src="{{ asset('assets/pasos1.png') }}" alt="Paso 1">
                <img src="{{ asset('assets/pasos2.png') }}" alt="Paso 2">
                <img src="{{ asset('assets/pasos3.png') }}" alt="Paso 3">
            </div>
        </div>
        <div class="info-video-main-container">
            <div class="info-video-container">
                <div class="info-video-text">
                    <h2 class="info-video-text-title">Premios <span>que inspiran</span></h2>
                    <p>Descubre cómo participar. <span>Sigue las instrucciones del video, inscribe tus códigos y
                            participa por la rifa de 3 motos Honda CB 190 R Y 3 camionetas KIA STONIC</span></p>
                </div>
                <div class="info-video">
                    {{-- <iframe src="https://www.youtube.com/embed/F9IN7aO4P8M?si=WCFZl4mVDm84-QuQ"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe> --}}
                </div>

                <div class="info-video-mobile">
                    {{-- <iframe src="https://www.youtube.com/embed/F9IN7aO4P8M?si=WCFZl4mVDm84-QuQ"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe> --}}
                </div>
            </div>
        </div>
        <div class="aliados-container">
            <div class="aliados-slider">
                <img src="{{ asset('assets/energiteca-logo.png') }}" alt="">
                <img src="{{ asset('assets/mac-logo.png') }}" alt="">
                <img src="{{ asset('assets/coexito-logo.png') }}" alt="">
                <img src="{{ asset('assets/magna-logo.png') }}" alt="">
            </div>
            <div class="aliados-slider">
                <img src="{{ asset('assets/energiteca-logo.png') }}" alt="">
                <img src="{{ asset('assets/mac-logo.png') }}" alt="">
                <img src="{{ asset('assets/coexito-logo.png') }}" alt="">
                <img src="{{ asset('assets/magna-logo.png') }}" alt="">
            </div>
        </div>
        <div class="main-forms-container" id="main_forms_container">
            @guest
                <div class="codigos-form-container">
                    <div class="codigos-terminos">
                        <h2 class="codigos-terminos-title">¡Gana bonos <span>de hasta 100 mil pesos!</span></h2>
                        <p>Inscribe tus códigos y participa con una emocionante ruleta donde podrás ganar bonos de gasolina
                            por 20.000, 30.000, 50.000 y 100.000 pesos al instante.</span></p>
                    </div>
                </div>
                <div class="login-register-container">
                    <div class="login-form">
                        <h2 class="login-form-title">Iniciar sesión</h2>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <label for="email_login">Correo electrónico</label>
                            <input type="text" id="email_login" name="email" placeholder="">
                            <label for="password_login">Contraseña</label>
                            <input type="password" id="password_login" name="password" placeholder="">
                            <p>¿No tienes una cuenta? <span class="register-show" id="register_show">Regístrate
                                    aquí</span>
                            <p><a href="{{ route('password.request') }}">Olvid&eacute; mi contraseña </a></p>
                            <button type="submit">Aceptar</button>
                        </form>
                    </div>
                    <div class="register-form">
                        <h2 class="register-form-title">Registro</h2>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <label for="nombre_register">Nombre</label>
                            <input id="nombre_register" name="nombre" value="{{ old('nombre') }}" placeholder="" />

                            <label for="email_register">Correo electrónico</label>
                            <input id="email_register" name="email" value="{{ old('email') }}" placeholder="" />

                            <label for="documento_register">Documento</label>
                            <input id="documento_register" name="documento" value="{{ old('documento') }}"
                                placeholder="" />

                            <label for="telefono_register">Teléfono</label>
                            <input id="telefono_register" name="telefono" value="{{ old('telefono') }}"
                                placeholder="" />

                            <label for="direccion_register">Dirección</label>
                            <input id="direccion_register" name="direccion" value="{{ old('direccion') }}"
                                placeholder="" />

                            <livewire:ciudades-component>

                                <label for="password_register">Contraseña</label>
                                <input id="password_register" type="password" name="password" placeholder="" />

                                <label for="password_confirmation_register">Confirmar contraseña</label>
                                <input id="password_confirmation_register" type="password" name="password_confirmation"
                                    placeholder="" />

                                <p>¿Ya tienes una cuenta? <span class="login-show" id="login_show">Inicia sesión</span>
                                </p>

                                <div class="checkbox-container">
                                    <input id="terminos_condiciones" type="checkbox" name="terminos_condiciones">
                                    <label for="terminos_condiciones">
                                        <a class="terminos-a" target="_blank"
                                            href="https://www.coexito.com.co/terminos-y-condiciones-campana-aniversario"
                                            target="_blank">
                                            Términos y condiciones
                                        </a>
                                    </label>
                                </div>

                                <div class="checkbox-container">
                                    <input id="tratamiento_datos" type="checkbox" name="tratamiento_datos">
                                    <label for="tratamiento_datos">
                                        <a class="terminos-a" target="_blank"
                                            href="https://www.coexito.com.co/politica-datos" target="_blank">
                                            Tratamiento de datos
                                        </a>
                                    </label>
                                </div>

                                <button type="submit">Registrar</button>
                        </form>
                    </div>
                </div>
            @endguest
            @auth
                <div class="main-registro-codigos">
                    @if (auth()->user()->rol_id == 1)
                        <div class="codigos-form-container">
                            <div class="codigos-form-text">
                                <h2 class="codigos-form-text-title">Registra <span>tus códigos ahora </span></h2>
                            </div>
                            <div class="codigos-terminos">
                                <p>Descarga <span>términos y condiciones</span></p>
                                <a href="{{ asset('legal/coexito-tyc-70.pdf') }}" download>
                                    Aquí
                                </a>
                            </div>
                        </div>
                        <livewire:registro-codigos>
                        @elseif(auth()->user()->rol_id == 2)
                            <div class="main-asesor-container">
                                <div class="asesor-menu">
                                    <div class="asesor-menu-item">
                                        <button class="btn-active" id="registro_puntos">Registrar Puntos</button>
                                    </div>
                                    <div class="asesor-menu-item">
                                        <button id="puntos_registrados">Puntos Registrados</button>
                                    </div>
                                    <div class="asesor-menu-item">
                                        <button id="ranking_general">Ranking General</button>
                                    </div>
                                </div>
                                <div class="asesor-items">
                                    <div class="registro-puntos-container">
                                        <livewire:registro-puntos>
                                    </div>
                                    <div class="puntos-registrados-container">
                                        <livewire:puntos-registrados>
                                    </div>
                                    <div class="ranking-general-container">
                                        <livewire:ranking-fuerza-venta>
                                    </div>
                                </div>

                            </div>
                    @endif
                </div>
            @endauth
        </div>
        <div class="main-info-promo-container">
            <div class="info-promo-container">
                <img src="{{ asset('assets/info1.png') }}" alt="">
                <div class="info-promo-text">
                    <h2 class="info-promo-text-title">Más de 400 millones de pesos en premios</h2>
                    <p>Inscribe tus códigos ahora y sé uno de los afortunados ganadores de increíbles premios.</p>
                </div>
            </div>
            <div class="info-promo-container">
                <img src="{{ asset('assets/info2.png') }}" alt="">
                <div class="info-promo-text">
                    <h2 class="info-promo-text-title">Gana una de las 3 motos</h2>
                    <p>Imagina rodar por la ciudad en la impresionante Honda CB 190 R, una moto diseñada para atraer
                        miradas y despertar emociones.</p>
                </div>
            </div>
            <div class="info-promo-container">
                <img src="{{ asset('assets/info3.png') }}" alt="">
                <div class="info-promo-text">
                    <h2 class="info-promo-text-title">Gana una de las 3 camionetas</h2>
                    <p>Recorre cada camino con estilo, tecnología y eficiencia a bordo de la Kia Stonic, una camioneta
                        que combina un diseño moderno y audaz con un rendimiento impecable.</p>
                </div>
            </div>
        </div>

        <div class="slider-cta">
            <div class="cta-container">
                <div class="cta-text">
                    <h2 class="cta-text-title">¡Síguenos en nuestras redes sociales!</h2>
                    <p>Y celebremos juntos los 70 años de Coéxito recorriendo los caminos de Colombia.</p>
                    <div class="social-icons">
                        <a href="https://www.instagram.com/coexitocol/" target="_blank" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://www.facebook.com/coexitocontigo/" target="_blank" aria-label="Facebook">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="https://www.linkedin.com/company/co%C3%A9xito-s-a/?originalSubdomain=co"
                            target="_blank" aria-label="LinkedIn">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    </div>
                </div>
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
    const btnScrolltoForm = document.getElementById('btn_scroll_to_form');
    const btnScrolltoFormMobile = document.getElementById('btn_scroll_to_form_mobile');

    if (btnScrolltoForm) {
        btnScrolltoForm.addEventListener('click', function() {
            document.getElementById('main_forms_container').scrollIntoView({
                behavior: 'smooth'
            });
        });
    }

    if (btnScrolltoFormMobile) {
        btnScrolltoFormMobile.addEventListener('click', function() {
            document.getElementById('main_forms_container').scrollIntoView({
                behavior: 'smooth'
            });
        });
    }

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

    const registroPuntos = document.getElementById('registro_puntos');
    const puntosRegistrados = document.getElementById('puntos_registrados');
    const rankingGeneral = document.getElementById('ranking_general');
    const registroPuntosContainer = document.querySelector('.registro-puntos-container');
    const puntosRegistradosContainer = document.querySelector('.puntos-registrados-container');
    const rankingGeneralContainer = document.querySelector('.ranking-general-container');

    function setActive(element) {
        document.querySelectorAll('.asesor-menu-item button').forEach(btn => {
            btn.classList.remove('btn-active');
        });
        element.classList.add('btn-active');
    }

    if (registroPuntos) {
        registroPuntos.addEventListener('click', () => {


            registroPuntosContainer.style.display = 'flex';
            puntosRegistradosContainer.style.display = 'none';
            rankingGeneralContainer.style.display = 'none';

            setActive(registroPuntos);
        });
    }

    if (puntosRegistrados) {
        puntosRegistrados.addEventListener('click', () => {
            registroPuntosContainer.style.display = 'none';
            puntosRegistradosContainer.style.display = 'flex';
            rankingGeneralContainer.style.display = 'none';

            setActive(puntosRegistrados);
        });
    }

    if (rankingGeneral) {
        rankingGeneral.addEventListener('click', () => {
            registroPuntosContainer.style.display = 'none';
            puntosRegistradosContainer.style.display = 'none';
            rankingGeneralContainer.style.display = 'flex';

            setActive(rankingGeneral);
        });
    }
</script>

</html>
