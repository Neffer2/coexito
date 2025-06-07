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
    <link rel="stylesheet" href="{{ asset('css/custom-swal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom-pagination.css') }}?v={{ time() }}">
    <link rel="shortcut icon" href="{{ asset('assets/icon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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

                        <button id="btn_scroll_to_form_mobile">¡Participa aquí!</button>
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
                    <video controls>
                        <source src="{{ asset('assets/coexito-70.mp4') }}" type="video/mp4">
                    </video>
                </div>

                <div class="info-video-mobile">
                    <video controls>
                        <source src="{{ asset('assets/coexito-70.mp4') }}" type="video/mp4">
                    </video>
                </div>
            </div>
        </div>
        <div class="aliados-container">
            <div class="aliados-slider">
                <img src="{{ asset('assets/energiteca-logo.png') }}" alt="">
                <img src="{{ asset('assets/mac-logo.png') }}" alt="">
                <img src="{{ asset('assets/coexito-logo.png') }}" alt="">
                <img src="{{ asset('assets/magna-logo.png') }}" alt="">
                <img src="{{ asset('assets/optima-logo.png') }}" alt="">
                <img src="{{ asset('assets/tudor-logo.png') }}" alt="">
                <img src="{{ asset('assets/varta-logo.png') }}" alt="">
            </div>
            <div class="aliados-slider">
                <img src="{{ asset('assets/energiteca-logo.png') }}" alt="">
                <img src="{{ asset('assets/mac-logo.png') }}" alt="">
                <img src="{{ asset('assets/coexito-logo.png') }}" alt="">
                <img src="{{ asset('assets/magna-logo.png') }}" alt="">
                <img src="{{ asset('assets/optima-logo.png') }}" alt="">
                <img src="{{ asset('assets/tudor-logo.png') }}" alt="">
                <img src="{{ asset('assets/varta-logo.png') }}" alt="">
            </div>
        </div>
        <div class="main-forms-container" id="main_forms_container">
            {{-- Cerrar sesion --}}
            @guest
                <div class="codigos-form-container">
                    <div class="codigos-terminos">
                        <h2 class="codigos-terminos-title">¡Sigue participando por dos camionetas y dos motos!</h2>
                        {{-- <p>Inscribe tus códigos y participa con una emocionante ruleta donde podrás ganar bonos de gasolina
                            por 20.000, 30.000, 50.000 y 100.000 pesos al instante.</span></p> --}}
                    </div>
                </div>
                <div class="login-register-container" id="main_login_register_container">
                    <div class="login-form" id="login_form_id">
                        <h2 class="login-form-title">Iniciar sesión</h2>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <label for="email_login">Correo electrónico:</label>
                            <input type="email" id="email_login" name="email" placeholder="" required>
                            @error('email')
                                <span class="error">{{ $message }}</span>
                            @enderror
                            <label for="password_login">Contraseña:</label>
                            <input type="password" id="password_login" name="password" placeholder="" required>
                            @error('password')
                                <span class="error">{{ $message }}</span>
                            @enderror
                            <p>¿No tienes una cuenta? <span class="register-show" id="register_show">Regístrate
                                    aquí</span>
                            <p class="recuperar-cont"><a href="{{ route('password.request') }}">Olvid&eacute; mi
                                    contraseña </a></p>
                            <button type="submit">Iniciar</button>
                        </form>
                    </div>
                    <div class="register-form">
                        <h2 class="register-form-title">Registro</h2>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <label for="nombre_register">Nombre completo:</label>
                            <input id="nombre_register" name="nombre" value="{{ old('nombre') }}" placeholder=""
                                required />
                            @error('nombre')
                                <span class="error">{{ $message }}</span>
                            @enderror

                            <label for="email_register">Correo electrónico:</label>
                            <input type="email" id="email_register" name="email" value="{{ old('email') }}"
                                placeholder="" required />
                            @error('email')
                                <span class="error">{{ $message }}</span>
                            @enderror

                            <label for="documento_register">Documento:</label>
                            <input id="documento_register" name="documento" value="{{ old('documento') }}"
                                placeholder="" required />
                            @error('documento')
                                <span class="error">{{ $message }}</span>
                            @enderror

                            <label for="telefono_register">Teléfono:</label>
                            <input id="telefono_register" type="tel" name="telefono" value="{{ old('telefono') }}"
                                placeholder="" required />
                            @error('telefono')
                                <span class="error">{{ $message }}</span>
                            @enderror

                            <label for="direccion_register">Dirección:</label>
                            <input id="direccion_register" name="direccion" value="{{ old('direccion') }}"
                                placeholder="" required />
                            @error('direccion')
                                <span class="error">{{ $message }}</span>
                            @enderror

                            <livewire:ciudades-component>

                                <label for="password_register">Contraseña:</label>
                                <input id="password_register" type="password" name="password" placeholder="" />
                                @error('password')
                                    <span class="error">{{ $message }}</span>
                                @enderror

                                <label for="password_confirmation_register">Confirmar contraseña:</label>
                                <input id="password_confirmation_register" type="password" name="password_confirmation"
                                    placeholder="" />
                                @error('password_confirmation')
                                    <span class="error">{{ $message }}</span>
                                @enderror

                                <p>¿Ya tienes una cuenta? <span class="login-show" id="login_show">Inicia sesión</span>
                                </p>

                                <div class="checkbox-container">
                                    <input id="terminos_condiciones" type="checkbox" name="terminos_condiciones">
                                    <label for="terminos_condiciones">
                                        <a class="terminos-a" target="_blank"
                                            href="{{ asset('terminos_condiciones.pdf') }}" target="_blank">
                                            Términos y condiciones
                                        </a>
                                    </label>
                                </div>
                                @error('terminos_condiciones')
                                    <span class="error">{{ $message }}</span>
                                @enderror

                                <div class="checkbox-container">
                                    <input id="tratamiento_datos" type="checkbox" name="tratamiento_datos">
                                    <label for="tratamiento_datos">
                                        <a class="terminos-a" target="_blank"
                                            href="https://www.coexito.com.co/politica-datos" target="_blank">
                                            Tratamiento de datos
                                        </a>
                                    </label>
                                </div>
                                @error('tratamiento_datos')
                                    <span class="error">{{ $message }}</span>
                                @enderror

                                <button type="submit">Registrar</button>
                        </form>
                    </div>
                </div>
            @endguest
            @auth
                <div class="main-registro-codigos">
                    @if (auth()->user()->rol_id == 1)
                        <div class="info-codigos-form-container">
                            <div class="codigos-form-text">
                                <h2 class="codigos-form-text-title">Registra <span>tus códigos ahora </span></h2>
                                <p>Encuentra el código para participar <span>en la esquina señalada y gana premios al
                                        instante.</span></p> <br>
                                <p>Recibe un raspa y gana por cada $80.000 en compras de productos para auto y $40.000 en
                                    productos para moto
                                    participantes.</p>
                            </div>
                            {{-- <div class="image-raspaygana">
                                <img src="{{ asset('assets/raspa-y-gana.png') }}" alt="Imagenes raspa y gana">
                            </div> --}}

                        </div>
                        <div class="registro-historial-codigos">
                            <div class="historial-codigos-btn">
                                <button class="btn-active" id="show_registro_codigos">Registro códigos</button>
                                <button id="show_historial_codigos">Historial códigos</button>
                                <button id="show_historial_facturas">Historial facturas</button>
                                <a href="/logout">Cerrar sesión</a>
                            </div>
                            <livewire:registro-codigos>
                                <div class="historial-codigos">
                                    <h2 class="historial-codigos-title">Historial de códigos</h2>
                                    <div class="total-codigos"> Total códigos registrados: {{ $total_codigos }}</div>
                                    <table>
                                        <tr>
                                            <td>C&oacute;digo</td>
                                            <td>Factura</td>
                                            <td>Fecha</td>
                                        </tr>
                                        @foreach ($registros_codigo as $registro_codigo)
                                            <tr>
                                                <td>{{ $registro_codigo->codigo->codigo }}</td>
                                                <td>
                                                    @php
                                                        $foto_factura = str_replace(
                                                            'public/',
                                                            '',
                                                            $registro_codigo->factura->foto_factura,
                                                        );
                                                    @endphp
                                                    <a href='{{ asset("storage/$foto_factura") }}'
                                                        target="_blank">Ver</a>
                                                </td>
                                                <td>{{ $registro_codigo->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>

                                <div class="historial-facturas">
                                    <h2 class="historial-facturas-title">Historial de facturas</h2>
                                    {{-- <div class="total-codigos"> Total facturas registradas: {{ $total_facturas }}</div> --}}
                                    <table>
                                        <tr>
                                            <td>Factura</td>
                                            <td>Estado</td>
                                            <td>Observaciones</td>
                                            <td>Fecha</td>
                                        </tr>
                                        @foreach ($registros_factura as $registro_factura)
                                            <tr>
                                                <td>
                                                    @php
                                                        $foto_factura = str_replace(
                                                            'public/',
                                                            '',
                                                            $registro_factura->foto_factura,
                                                        );
                                                    @endphp
                                                    <a href='{{ asset("storage/$foto_factura") }}'
                                                        target="_blank">Ver</a>
                                                </td>
                                                <td>
                                                    @if ($registro_factura->estado_id == 1)
                                                        Aprobado
                                                    @elseif ($registro_factura->estado_id == 2)
                                                        En Revisión
                                                    @elseif ($registro_factura->estado_id == 3)
                                                        Inactivo
                                                    @else
                                                        Desconocido
                                                    @endif
                                                </td>
                                                <td>{{ $registro_factura->observaciones }}</td>
                                                <td>{{ $registro_factura->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                        </div>
                    @elseif(auth()->user()->rol_id == 2)
                        <div class="main-asesor-container">
                            <div class="asesor-menu">
                                {{-- <div class="asesor-menu-item">
                                    <button class="btn-active" id="registro_puntos">Registrar Puntos</button>
                                </div> --}}
                                <div class="asesor-menu-item">
                                    <button class="btn-active" id="puntos_registrados">Puntos Registrados</button>
                                </div>
                                <div class="asesor-menu-item">
                                    <button id="ranking_general">Ranking General</button>
                                </div>
                                <div class="asesor-menu-item">
                                    <button id="cerrar-sesion-btn">Cerrar sesión</button>
                                </div>
                            </div>
                            <div class="asesor-items">
                                <div class="registro-puntos-container">
                                    {{-- <livewire:registro-puntos> --}}
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
    <a href="https://api.whatsapp.com/send?phone=+573214198536&text=Hola,%20tengo%20una%20pregunta%20sobre%20la%20campa%C3%B1a%20de%20Co%C3%A9xito%2070%20a%C3%B1os%20contigo.%20%C2%BFMe%20puedes%20ayudar?"
        class="whatsapp-float" target="_blank">
        <i class="fab fa-whatsapp whatsapp-icon"></i>
    </a>

</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const btnScrolltoForm = document.getElementById('btn_scroll_to_form');
    const btnScrolltoFormMobile = document.getElementById('btn_scroll_to_form_mobile');
    const cerrarSesionBtn = document.getElementById('cerrar-sesion-btn');


    @if ($errors->any())
        Swal.fire({
            title: 'Errores encontrados',
            html: '{!! implode('<br>', $errors->all()) !!}',
            icon: 'error',
            confirmButtonText: 'Cerrar',
            customClass: {
                popup: 'custom-swal-popup',
                title: 'custom-swal-title',
                htmlContainer: 'custom-swal-html',
                confirmButton: 'custom-swal-confirm-button',
                cancelButton: 'custom-swal-cancel-button'
            }
        });
    @endif

    @if (session('popup'))
        Swal.fire({
            title: '¡Ya estás participando por 2 camionetas y 2 carros!',
            html: '<small>Los bonos de gasolina disponibles según los términos y condiciones ya se han agotado, pero aún tienes la oportunidad de ganar una camioneta o una moto.</small>',
            icon: 'success',
            confirmButtonText: 'Aceptar',
            customClass: {
                popup: 'custom-swal-popup',
                title: 'custom-swal-title',
                htmlContainer: 'custom-swal-html',
                confirmButton: 'custom-swal-confirm-button',
                cancelButton: 'custom-swal-cancel-button'
            }
        });
    @endif

    if (cerrarSesionBtn) {
        cerrarSesionBtn.addEventListener('click', () => {
            window.location.href = '/logout';
        });
    }

    if (btnScrolltoForm) {
        btnScrolltoForm.addEventListener('click', function() {

            const mainFormsContainer = document.getElementById('main_forms_container');

            if (mainFormsContainer) {
                mainFormsContainer.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    }

    if (btnScrolltoFormMobile) {
        btnScrolltoFormMobile.addEventListener('click', function() {

            const mainLoginRegisterContainer = document.getElementById('main_login_register_container');
            const mainFormsContainer = document.getElementById('main_forms_container');

            if (mainLoginRegisterContainer) {
                mainLoginRegisterContainer.scrollIntoView({
                    behavior: 'smooth'
                });
            } else if (mainFormsContainer) {
                mainFormsContainer.scrollIntoView({
                    behavior: 'smooth'
                });
            }
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

    const showRegistroCodigos = document.getElementById('show_registro_codigos');
    const showHistorialCodigos = document.getElementById('show_historial_codigos');
    const showHistorialFacturas = document.getElementById('show_historial_facturas');

    if (showRegistroCodigos) {
        showRegistroCodigos.addEventListener('click', () => {
            const registroCodigos = document.querySelector('.registro-codigos');
            const historialCodigos = document.querySelector('.historial-codigos');
            const historialFacturas = document.querySelector('.historial-facturas');

            registroCodigos.style.display = 'flex';
            historialCodigos.style.display = 'none';
            historialFacturas.style.display = 'none';

            showRegistroCodigos.classList.add('btn-active');
            showHistorialCodigos.classList.remove('btn-active');
            showHistorialFacturas.classList.remove('btn-active');
        });
    }

    if (showHistorialCodigos) {
        showHistorialCodigos.addEventListener('click', () => {
            const registroCodigos = document.querySelector('.registro-codigos');
            const historialCodigos = document.querySelector('.historial-codigos');
            const historialFacturas = document.querySelector('.historial-facturas');

            registroCodigos.style.display = 'none';
            historialCodigos.style.display = 'flex';
            historialFacturas.style.display = 'none';

            showRegistroCodigos.classList.remove('btn-active');
            showHistorialCodigos.classList.add('btn-active');
            showHistorialFacturas.classList.remove('btn-active');
        });
    }

    if (showHistorialFacturas) {
        showHistorialFacturas.addEventListener('click', () => {
            const registroCodigos = document.querySelector('.registro-codigos');
            const historialCodigos = document.querySelector('.historial-codigos');
            const historialFacturas = document.querySelector('.historial-facturas');

            registroCodigos.style.display = 'none';
            historialCodigos.style.display = 'none';
            historialFacturas.style.display = 'flex';

            showRegistroCodigos.classList.remove('btn-active');
            showHistorialCodigos.classList.remove('btn-active');
            showHistorialFacturas.classList.add('btn-active');
        });
    }
</script>

</html>
