<div class="registro-codigos">
    <h2 class="registro-codigos-title">Registro de códigos</h2>

    <label for="productos">Elige qué productos compraste:</label>
    <div class="select-container">
        <label for="">Productos para auto</label>
        <select wire:model.change="productos_auto" multiple required>>
            <optgroup label="Bater&iacute;as">
                <option value="Mac_auto">Bater&aacute;s Mac</option>
                <option value="Baterias_coexito_auto">Coéxito baterías automotrices</option>
                <option value="Varta_auto">Bater&aacute;s Varta</option>
                <option value="Tudor_auto">Bater&aacute;s Tudor</option>
                <option value="Taxi_auto">Bater&aacute;s Power Taxi</option>
                <option value="Faico_auto">Bater&aacute;s Faico</option>
                <option value="Magna_auto">Bater&aacute;s Magna</option>
                <option value="optima_auto">Bater&aacute;s Optima</option>
            </optgroup>
            <optgroup label="Lubricantes">
                <option value="Lubricantes_coexito_auto">Co&eacute;xito Lubricantes</option>
            </optgroup>
            <optgroup label="Repuestos">
                <option value="Autopartes_coexito_auto">Co&eacute;xito Autopartes</option>
            </optgroup>
            <option value="N/A">NO APLICA</option>
        </select>
    </div>
    @error('productos_auto')
        <span class="error">{{ $message }}</span>
    @enderror

    <div class="select-container">
        <label for="">Productos para moto</label>
        <select wire:model.change="productos_moto" multiple required>
            <optgroup label="Bater&iacute;as">
                <option value="Magna_moto">Bater&aacute;s Magna</option>
                <option value="Baterias_coexito_auto">Co&eacute;xito baterías para moto</option>
            </optgroup>
            <optgroup label="Lubricantes">
                <option value="Lubricantes_magna_moto">Moto Magna Lub</option>
            </optgroup>
            <optgroup label="Repuestos">
                <option value="Autopartes_coexito_moto">Co&eacute;xito Motopartes</option>
            </optgroup>
            <option value="N/A">NO APLICA</option>
        </select>
    </div>
    @error('productos_moto')
        <span class="error">{{ $message }}</span>
    @enderror
    <div class="select-container">
        <label for="">Productos y servicios</label>
        <select wire:model.change="productos_energiteca_servicios" multiple required>>
            <option value="Energiteca">Energiteca</option>
        </select>
    </div>
    @error('productos_energiteca_servicios')
        <span class="error">{{ $message }}</span>
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
            <span class="error">{{ $message }}</span>
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
        <span class="error">{{ $message }}</span>
    @enderror
    @error('codigos')
        <span class="error">{{ $message }}</span>
    @enderror
    @session('codigo_error')
        <span class="error">{{ session('codigo_error') }}</span>
    @endsession

    <table class="codigos-table">
        <thead>
            <tr class="table-header">
                <th>C&oacute;digo</th>
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
