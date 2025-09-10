
<x-guest-layout>
    <div class="otp-main-container">
        <!-- Formulario OTP -->
        <div class="resend-otp-container">
        <form method="POST" action="{{ route('otp.validate') }}" class="otp-form" id="otpFullForm">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user_id }}">
            <div class="otp-info-text">
                <span>Te ha llegado un mensaje SMS al número *********<strong>{{ $telefono_final }}</strong>. Ingresa el código recibido para continuar.</span>
            </div>
            <label for="otp">Código de verificación</label>
            <input id="otp" name="otp" type="text" required autofocus>
            @error('otp')
                <div class="error-otp">{{ $message }}</div>
            @enderror
            <button type="submit">Enviar Código</button>
        </form>

        <!-- Formulario Reenviar OTP -->
        
            <form method="POST" action="{{ route('otp.resend') }}" id="resendOtpForm">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user_id }}">
                <button type="submit" id="resendOtpBtn">Solicitar nuevo código</button>
            </form>
            @if (session('otp_resent'))
                <div class="otp-resent-msg">Código enviado correctamente.</div>
            @endif
            @if (session('otp_cooldown'))
                <div class="otp-cooldown-msg">Debes esperar {{ session('otp_cooldown') }} segundos para solicitar un nuevo código.</div>
            @endif
        </div>

        <script>
            let cooldown = {{ session('otp_cooldown', 0) }};
            const resendBtn = document.getElementById('resendOtpBtn');
            // Si hay cooldown del backend, lo respetamos
            if (cooldown > 0) {
                resendBtn.disabled = true;
                let interval = setInterval(() => {
                    cooldown--;
                    if (cooldown <= 0) {
                        resendBtn.disabled = false;
                        clearInterval(interval);
                    }
                }, 1000);
            } else {
                // Si no hay cooldown, deshabilitar por 15 segundos al cargar
                resendBtn.disabled = true;
                let localCooldown = 15;
                let interval = setInterval(() => {
                    localCooldown--;
                    if (localCooldown <= 0) {
                        resendBtn.disabled = false;
                        clearInterval(interval);
                    }
                }, 1000);
            }
        </script>
    </div>
</x-guest-layout>
