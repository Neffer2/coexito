<div class="registro-codigos">
    <h2 class="registro-codigos-title">Registro de códigos</h2>

    <label for="productos">Elige qué productos compraste:</label>
    <div class="checkbox-container-codigos">
        <input id="baterias_auto" type="checkbox" wire:model.change="baterias_auto">
        <label for="baterias_auto">Bater&iacute;as para auto</label>
    </div>
    @error('baterias_auto')
        {{ $baterias_auto }}
    @enderror
    <div class="checkbox-container-codigos">
        <input id="baterias_moto" type="checkbox" wire:model.change="baterias_moto">
        <label for="baterias_moto">Bater&iacute;as para moto</label>
    </div>
    @error('baterias_moto')
        {{ $baterias_moto }}
    @enderror
    <div class="checkbox-container-codigos">
        <input id="lubricantes_auto" type="checkbox" wire:model.change="lubricantes_auto">
        <label for="lubricantes_auto">Lubricantes para auto</label>
    </div>
    @error('lubricantes_auto')
        {{ $lubricantes_auto }}
    @enderror
    <div class="checkbox-container-codigos">
        <input id="lubricantes_moto" type="checkbox" wire:model.change="lubricantes_moto">
        <label for="lubricantes_moto">Lubricantes para moto</label>
    </div>
    @error('lubricantes_moto')
        {{ $lubricantes_moto }}
    @enderror
    <div class="checkbox-container-codigos">
        <input id="energiteca" type="checkbox" wire:model.change="energiteca">
        <label for="energiteca">Productos y servicios en Energiteca y energiteca.com</label>
    </div>
    @error('energiteca')
        {{ $energiteca }}
    @enderror

    <div class="upload-container-codigos">
        <label for="foto_factura">Tómale foto a tu factura:</label>
        <div class="upload-container" onclick="document.getElementById('foto_factura_elem').click()">
            <input id="foto_factura_elem" type="file" accept="image/*" style="display: none;">
            <img id="imagePreviewFactura" src="{{ $foto_factura ? $foto_factura->temporaryUrl() : '' }}">

            @if (!$foto_factura)
                <p class="camara-img"><i class="fas fa-camera"></i>
            @endif
        </div>
        @error('foto_factura')
            {{ $message }}
        @enderror
    </div>
    <label for="codigo">Ingresa tus códigos:</label>
    <div class="ingresa-codigo-container">
        <div class="ingresa-codigo-input">
            <input id="codigo" wire:model.lazy="codigo" type="text">
        </div>

        <div class="ingresa-codigo-button">
            <button wire:click="addCodigo">Añadir</button>
        </div>
    </div>
    @error('codigo')
        {{ $message }}
    @enderror
    @error('codigos')
        {{ $message }}
    @enderror
    @session('codigo_error')
        <div class="error">{{ session('codigo_error') }}</div>
    @endsession

    <table class="codigos-table">
        <thead>
            <tr class="table-header">
                <th>Codigo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($codigos as $key => $codigo)
                <tr class="table-row">
                    <td class="codigo-cell">{{ $codigo['codigo'] }}</td>
                    <td class="acciones-cell"><button class="remove-button"
                            wire:click="removeCodigo({{ $key }})">X</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <button wire:click="register">Registrar</button>
    @script
        <script>
            const MAX_WIDTH = 1020;
            const MAX_HEIGHT = 980;
            const MIME_TYPE = "image/jpeg";
            const QUALITY = 0.5;

            const foto_factura_elem = document.getElementById("foto_factura_elem");

            foto_factura_elem.onchange = (ev) => {
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
        </script>
    @endscript
</div>
