<div>
    <div class="register-form-group">
        <label for="departamento" class="register-form-label">Departamento:</label>
        <select wire:model.live="departamento" id="departamento" class="register-form-input" name="departamento" value="{{ old('departamento') }}" required>
            <option>Seleccionar</option>
            @foreach ($departamentos as $departamento)
                <option value="{{ $departamento->id }}">{{ $departamento->descripcion }}</option>
            @endforeach
        </select>
        @error('departamento')
            <p class="register-form-error">{{ $message }}</p>
        @enderror
    </div>

    <div class="register-form-group">
        <label for="ciudad" class="register-form-label">Ciudad:</label>
        <select id="ciudad" class="register-form-input" name="ciudad" value="{{ old('ciudad') }}" required>
            @if ($this->departamento)
                @foreach ($departamentos->where('id', $this->departamento)->first()->ciudades as $ciudad)
                    <option value="{{ $ciudad->descripcion }}">{{ $ciudad->descripcion }}</option>
                @endforeach
            @endif
        </select>
        @error('ciudad')
            <p class="register-form-error">{{ $message }}</p>
        @enderror
    </div>
</div>