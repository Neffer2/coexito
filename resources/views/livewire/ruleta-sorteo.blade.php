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
                @this.call('seleccionarParticipante').then(response => {
                    Swal.fire({
                        title: '¡Felicidades!',
                        html: `<p>Nombre: <strong>${response.nombre}</strong></p><br><p>Código: <strong>${response.codigo}</strong></p>`,
                        confirmButtonText: 'Cerrar',
                        customClass: {
                            popup: 'popup-ruleta-sorteo',
                            title: 'popup-ruleta-sorteo-title',
                            htmlContainer: 'popup-ruleta-sorteo-html',
                            confirmButton: 'popup-ruleta-sorteo-confirm-button',
                            cancelButton: 'popup-ruleta-sorteo-cancel-button'
                        }
                    });
                });

                girarBtn.style.pointerEvents = 'auto';
            }, 4800);
        };
    </script>
</div>
