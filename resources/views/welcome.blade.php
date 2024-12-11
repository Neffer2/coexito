<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Coexitocontigo</title>
    </head>
    <body>
        @guest
            <div>
                <h2>Iniciar sesión</h2>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <input type="text" name="email" placeholder="Email">
                    <input type="password" name="password" placeholder="Password"> 
                    <button type="submit">Iniciar</button>
                </form>
            </div>
            <div>
                <h2>Registro</h2>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <input id="nombre" name="nombre" :value="old('nombre')" placeholder="Nombre"/>
                    <input id="email" name="email" :value="old('nombre')" placeholder="Correo"/>
                    <input id="documento" name="documento" :value="old('documento')" placeholder="Documento"/>
                    <input id="telefono" name="telefono" :value="old('telefono')" placeholder="Telefono"/>
                    <input id="direccion" name="direccion" :value="old('direccion')" placeholder="Direccion"/>
                    <select id="" name="" placeholder="Departamento">
                        <option value="1">Departamento</option>
                        <option value="2">Proveedor</option>
                    </select>
                    <select id="ciudad" name="ciudad" placeholder="Ciudad">
                        <option value="1">Ciudad</option>
                        <option value="2">Proveedor</option>
                    </select>
                    <input id="password" type="password" name="password" placeholder="Confirmar contraseña"/>
                    <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Confirmar contraseña"/>

                    <input id="terminos_condiciones" type="radio" name="terminos_condiciones"> Terminos y condiciones
                    <input id="tratamiento_datos" type="radio" name="tratamiento_datos"/> Tratamiento de datos

                    <button type="submit">Registrar</button>
                </form>
                @if ($errors->any())
                    <div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>

                @endif
            </div>
        @endguest
        @auth
            <h2>Registro de codigos</h2>
            <livewire:registro-codigos>
        @endauth
    </body>
</html>
