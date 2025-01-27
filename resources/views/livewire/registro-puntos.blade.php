<div class="registro-puntos">
    <h2 class="registro-puntos-title">Registro de puntos</h2>

    <label for="nit">Ingresa el Nit del establecimiento: </label>
    <input id="nit" wire:model.lazy="nit" type="text">
    @error('nit')
        {{ $message }}
    @enderror
    @session('nit-error')
        <div class="error"> {{ session('nit-error') }}</div>
    @endsession
    @session('success')
        <div class="error">{{ session('success') }}</div>
    @endsession

    <label for="direccion">Digita la direcci&oacute;n del establecimmiento: </label>
    <input id="direccion" wire:model.lazy="direccion" type="text">
    @error('direccion')
        {{ $message }}
    @enderror

    <label for="nombre">Cont&aacute;cto (nombre): </label>
    <input id="nombre" wire:model.lazy="nombre" type="text">
    @error('nombre')
        {{ $message }}
    @enderror

    <label for="telefono">Tel&eacute;fono: </label>
    <input id="telefono" wire:model.lazy="telefono" type="text">
    @error('telefono')
        {{ $message }}
    @enderror

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

    <div class="upload-container-codigos">
        <label for="foto_punto">Tómale foto al punto de venta:</label>
        <div class="upload-container" onclick="document.getElementById('foto_punto').click()">
            <input id="foto_punto" type="file" accept="image/*" style="display: none;">
            <img id="imagePreviewFactura" src="{{ $foto_punto ? $foto_punto->temporaryUrl() : '' }}">

            @if (!$foto_punto)
                <p class="camara-img"><i class="fas fa-camera"></i>
            @endif
        </div>
        @error('foto_punto')
            {{ $message }}
        @enderror
    </div>

    <button wire:click="ActivarPunto">Activar punto</button>
    @script
        <script>
            const MAX_WIDTH = 1020;
            const MAX_HEIGHT = 980;
            const MIME_TYPE = "image/jpeg";
            const QUALITY = 0.5;

            const foto_punto = document.getElementById("foto_punto");

            foto_punto.onchange = (ev) => {
                const file = ev.target.files[0]; // get the file
                const blobURL = URL.createObjectURL(file);
                const img = new Image();
                img.src = blobURL;

                img.onerror = () => {
                    URL.revokeObjectURL(this.src);
                    // Handle the failure properly
                    console.err("Cannot load image");
                };
                img.onload = () => {
                    URL.revokeObjectURL(this.src);
                    const [newWidth, newHeight] = calculateSize(img, MAX_WIDTH, MAX_HEIGHT);
                    const canvas = document.createElement("canvas");
                    canvas.width = newWidth;
                    canvas.height = newHeight;
                    const ctx = canvas.getContext("2d");
                    ctx.drawImage(img, 0, 0, newWidth, newHeight);
                    canvas.toBlob(
                        blob => {
                            upload_foto_punto(blob);
                        },
                        MIME_TYPE,
                        QUALITY);
                };
            };

            const calculateSize = (img, maxWidth, maxHeight) => {
                let width = img.width;
                let height = img.height;

                // calculate the width and height, constraining the proportions
                if (width > height) {
                    if (width > maxWidth) {
                        height = Math.round(height * maxWidth / width);
                        width = maxWidth;
                    }
                } else {
                    if (height > maxHeight) {
                        width = Math.round(width * maxHeight / height);
                        height = maxHeight;
                    }
                }

                return [width, height];
            }

            const upload_foto_punto = (file) => {
                $wire.upload('foto_punto', file, (uploadedFilename) => {});
            }
        </script>
    @endscript
</div>
