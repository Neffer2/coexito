<div class="registro-puntos">
    <h2 class="registro-puntos-title">Registrar punto</h2>
    <h3 class="registro-puntos-subtitle">Registra los puntos de venta que deseas activar en la promo.</h3>

    <label for="razon_social">Raz&oacute;n social: </label>
    <input id="razon_social" wire:model.lazy="razon_social" type="text">
    @error('razon_social')
        {{ $message }}
    @enderror

    <label for="nom_comercial">Nombre Comercial: </label>
    <input id="nom_comercial" wire:model.lazy="nom_comercial" type="text">
    @error('nom_comercial')
        {{ $message }}
    @enderror

    <label for="nit">Ingresa el Nit del establecimiento: </label>
    <input id="nit" wire:model.lazy="nit" type="text">
    @error('nit')
        {{ $message }}
    @enderror
    @session('nit-error')
        <div class="error"> {{ session('nit-error') }}</div>
    @endsession

    <label for="departamento" class="register-form-label">Departamento</label>
    <select wire:model.live="departamento" id="departamento" class="register-form-input" name="departamento"
        value="{{ old('departamento') }}" required>
        <option>Seleccionar</option>
        @foreach ($departamentos as $departamento)
            <option value="{{ $departamento->id }}">{{ $departamento->descripcion }}</option>
        @endforeach
    </select>
    @error('departamento')
        <p class="register-form-error">{{ $message }}</p>
    @enderror

    <label for="ciudad" class="register-form-label">Ciudad</label>
    <select id="ciudad" class="register-form-input" name="ciudad" wire:model.change="ciudad"
        value="{{ old('ciudad') }}" required>
        <option>Seleccionar</option>
        @if ($this->departamento)
            @foreach ($departamentos->where('id', $this->departamento)->first()->ciudades as $ciudad)
                <option value="{{ $ciudad->descripcion }}">{{ $ciudad->descripcion }}</option>
            @endforeach
        @endif
    </select>
    @error('ciudad')
        <p class="register-form-error">{{ $message }}</p>
    @enderror

    <label for="direccion">Digita la direcci&oacute;n del establecimmiento: </label>
    <input id="direccion" wire:model.lazy="direccion" type="text">
    @error('direccion')
        <p class="register-form-error">{{ $message }}</p>
    @enderror

    <label for="maps">Enlace Maps: </label>
    <input id="maps" wire:model.lazy="maps" type="text">
    @error('maps')
        <p class="register-form-error">{{ $message }}</p>
    @enderror

    <label for="bonos_entregados">Bonos entregados: </label>
    <input id="bonos_entregados" wire:model.lazy="bonos_entregados" type="text">
    @error('bonos_entregados')
        <p class="register-form-error">{{ $message }}</p>
    @enderror

    <label for="telefono">Tel&eacute;fono: </label>
    <input id="telefono" wire:model.lazy="telefono" type="text">
    @error('telefono')
        <p class="register-form-error">{{ $message }}</p>
    @enderror

    <label for="nom_contacto">Nombre de contacto: </label>
    <input id="nom_contacto" wire:model.lazy="nom_contacto" type="text">
    @error('nom_contacto')
        <p class="register-form-error">{{ $message }}</p>
    @enderror

    @session('success')
        <div class="error">{{ session('success') }}</div>
    @endsession

    <button wire:click="ActivarPunto">Activar punto</button>
</div>
