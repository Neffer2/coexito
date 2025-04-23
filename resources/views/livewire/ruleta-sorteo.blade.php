<div class="sorteo-container">
    <div class="puntero-img">
        <img src="{{ asset('assets/ruleta/desk/puntero.png') }}" alt="puntero" class="puntero" id="puntero">
    </div>
    <div class="ruleta-img">
        <img src="{{ asset('assets/ruleta/desk/ruleta_.png') }}" alt="Ruleta" class="ruleta" id="ruleta">
    </div>
    <div class="girar-img">
        <img src="{{ asset('assets/ruleta/desk/button.png') }}" alt="Girar" class="girar" id="girar-btn" onclick="girarRuleta()">
    </div>
</div>

<script>
    let currentRotation = 0; // Variable para mantener el estado de la rotación actual

    const girarRuleta = () => {
        const ruleta = document.getElementById('ruleta');
        ruleta.style.transition = 'transform 5s ease-out'; // Duración y suavidad de la animación
        const grados = Math.floor(Math.random() * 3600) + 360; // Rotación aleatoria
        currentRotation += grados; // Acumular la rotación para evitar reinicios visuales
        ruleta.style.transform = `rotate(${currentRotation}deg)`;
    };
</script>