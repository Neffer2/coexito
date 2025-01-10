<div class="registro-codigos">
    <label for="productos">Selecciona tu producto</label>
    <select id="productos" wire:model.change="tipo_producto">
        <option value="">Seleccionar</option>
        <option value="Bater&iacute;as para auto">Bater&iacute;as para auto</option>
        <option value="Bater&iacute;as para mot">Bater&iacute;as para moto</option>
        <option value="Lubricantes para auto">Lubricantes para auto</option>
        <option value="Lubricantes para moto">Lubricantes para moto</option>
        <option value="Productos y servicios en Energiteca y energiteca.com">Productos y servicios en Energiteca y energiteca.com</option>
    </select>
    @error('tipo_producto')
        {{ $message }}
    @enderror

    <label for="foto_factura">Sube tu factura</label>
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

    <label for="codigo">Ingresa tu código</label>
    <input id="codigo" wire:model.lazy="codigo" type="text">
    @error('codigo')
        {{ $message }}
    @enderror
    @session('codigo-error')
        {{ session('codigo-error') }}
    @endsession

    <button wire:click="register">Registrar</button>
    @script
        <script>
            const MAX_WIDTH = 1020;
            const MAX_HEIGHT = 980;
            const MIME_TYPE = "image/jpeg";
            const QUALITY = 0.5;

            const foto_factura = document.getElementById("foto_factura");

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