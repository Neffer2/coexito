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
                <img src="{{ asset('assets/coexito-logo.png') }}" alt="">
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
        @guest
            <div class="login-register-container">
                <div class="login-form">
                    <h2>Iniciar sesión</h2>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <label for="email_login">Correo electrónico</label>
                        <input type="text" id="email_login" name="email" placeholder="Email">
                        <label for="password_login">Contraseña</label>
                        <input type="password" id="password_login" name="password" placeholder="Password">
                        {{-- <p>¿No tienes una cuenta? <span class="register-show" id="register_show">Registrate aquí</span></p> --}}
                        <button type="submit">Aceptar</button>
                    </form>
                </div>
                <div class="register-form">
                    <h2>Registro</h2>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <input id="nombre" name="nombre" :value="old('nombre')" placeholder="Nombre" />
                        <input id="email" name="email" :value="old('nombre')" placeholder="Correo" />
                        <input id="documento" name="documento" :value="old('documento')" placeholder="Documento" />
                        <input id="telefono" name="telefono" :value="old('telefono')" placeholder="Telefono" />
                        <input id="direccion" name="direccion" :value="old('direccion')" placeholder="Direccion" />
                        <select id="" name="" placeholder="Departamento">
                            <option value="1">Departamento</option>
                            <option value="2">Proveedor</option>
                        </select>
                        <select id="ciudad" name="ciudad" placeholder="Ciudad">
                            <option value="1">Ciudad</option>
                            <option value="2">Proveedor</option>
                        </select>
                        <input id="password" type="password" name="password" placeholder="Confirmar contraseña" />
                        <input id="password_confirmation" type="password" name="password_confirmation"
                            placeholder="Confirmar contraseña" />

                        <input id="terminos_condiciones" type="radio" name="terminos_condiciones"> Terminos y condiciones
                        <input id="tratamiento_datos" type="radio" name="tratamiento_datos" /> Tratamiento de datos

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

        @endguest
        @auth
            <h2>Registro de codigos</h2>
            <livewire:registro-codigos>
            @endauth
    </div>

</body>
<script>
    // const registroShow = document.getElementById('register_show');

    // registroShow.addEventListener('click', () => {
    //     const loginForm = document.querySelector('.login-form');
    //     const registerForm = document.querySelector('.register-form');

    //     loginForm.style.display = 'none';
    //     registerForm.style.display = 'flex';
    // });
</script>

</html>
