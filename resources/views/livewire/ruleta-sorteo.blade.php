<div class="sorteo-container">
    <div class="puntero-img">
        <img src="{{ asset('assets/ruleta/desk/puntero.png') }}" alt="puntero" class="puntero" id="puntero">
    </div>
    <div class="ruleta-img">
        <img src="{{ asset('assets/ruleta/desk/ruleta_.png') }}" alt="Ruleta" class="ruleta" id="ruleta">
    </div>
    <div class="girar-img">
        <img src="{{ asset('assets/ruleta/desk/button.png') }}" alt="Girar" class="girar" id="girar-btn"
            onclick="girarRuleta()">
    </div>

    <div class="texto">
        @if ($participante)
            <p>Has ganado un premio.</p>
            <p>Nombre: {{ $participante->nombre }}</p>
            <p>Código: {{ $participante->codigo }}</p>
        @endif
    </div>
    <script>
        let currentRotation = 0;

        const girarRuleta = () => {
            const ruleta = document.getElementById('ruleta');
            const girarBtn = document.getElementById('girar-btn');

            girarBtn.style.pointerEvents = 'none';

            ruleta.style.transition = 'transform 5s ease-out';
            const grados = 4500;
            currentRotation += grados;
            ruleta.style.transform = `rotate(${currentRotation}deg)`;

            setTimeout(() => {
                // Llama al método Livewire directamente
                @this.call('seleccionarParticipante');
                girarBtn.style.pointerEvents = 'auto';
            }, 5000);
        };
    </script>
</div>
