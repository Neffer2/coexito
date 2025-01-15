<div class="registro-puntos">
    <h2>Registro de puntos</h2>

    <label for="nit">Ingresa el Nit del establecimiento: </label>
    <input id="nit" wire:model.lazy="nit" type="text">
    @error('nit')
        {{ $message }}
    @enderror
    @session('nit-error')
        {{ session('nit-error') }}
    @endsession
    @session('success')
        {{ session('success') }}
    @endsession

    <label for="direccion">Digita la direcci&oacute;n del establecimmiento: </label>
    <input id="direccion" wire:model.lazy="direccion" type="text">
    @error('direccion')
        {{ $message }}
    @enderror

    <label for="departamento" class="register-form-label">Departamento</label>
    <select wire:model.live="departamento" id="departamento" class="register-form-input" name="departamento" value="{{ old('departamento') }}" required>
        <option>Seleccionar</option>
        @foreach ($departamentos as $departamento)
            <option value="{{ $departamento->id }}">{{ $departamento->descripcion }}</option>
        @endforeach
    </select>
    @error('departamento')
        <p class="register-form-error">{{ $message }}</p>
    @enderror

    <label for="ciudad" class="register-form-label">Ciudad</label>
    <select id="ciudad" class="register-form-input" name="ciudad" wire:model.change="ciudad" value="{{ old('ciudad') }}" required>
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
 
    <label for="foto_factura">Sube una foto de tu factura: </label>
    <div class="upload-container" onclick="document.getElementById('foto_factura').click()">
        <input id="foto_factura" type="file" accept="image/*" style="display: none;">
        @if ($foto_factura)
            <img src="{{ $foto_factura->temporaryUrl() }}" alt="Foto factura" height="350" width="350">
        @else
            <p>Click aquí para subir tu factura</p> 
        @endif
    </div>
    @error('foto_factura')
        {{ $message }}
    @enderror

    <label for="foto_kit">Sube una foto del Kit inicial: </label>
    <div class="upload-container" onclick="document.getElementById('foto_kit').click()">
        <input id="foto_kit" type="file" accept="image/*" style="display: none;">
        @if ($foto_kit)
            <img src="{{ $foto_kit->temporaryUrl() }}" alt="Foto factura" height="350" width="350">
        @else
            <p>Sube una foto del Kit inicial</p>
        @endif
    </div>
    @error('foto_kit')
        {{ $message }}
    @enderror

    <button wire:click="ActivarPunto">Activar punto</button>
    @script
        <script>
            const MAX_WIDTH = 1020;
            const MAX_HEIGHT = 980;
            const MIME_TYPE = "image/jpeg";
            const QUALITY = 0.5;

            const foto_factura = document.getElementById("foto_factura");
            const foto_kit = document.getElementById("foto_kit");

            foto_factura.onchange = (ev) => {
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
                            upload_foto_factura(blob);
                        },
                        MIME_TYPE,
                        QUALITY);
                };
            };

            foto_kit.onchange = (ev) => {
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
                            upload_foto_kit(blob);
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

            const upload_foto_factura = (file) => {
                $wire.upload('foto_factura', file, (uploadedFilename) => {});
            }

            const upload_foto_kit = (file) => {
                $wire.upload('foto_kit', file, (uploadedFilename) => {});
            }
        </script>
    @endscript

    
</div>
