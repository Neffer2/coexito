<form method="POST" action="{{ route('password.store') }}">
    @csrf

    <!-- Password Reset Token -->
    <input type="hidden" name="token" value="{{ $request->route('token') }}">

    <!-- Email Address -->
    <div>
        <label for="email" :value="__('Email')"></label>
        <input id="email" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
        @error('email')
            <span class="text-red-600">{{ $message }}</span>
        @enderror
    </div>

    <!-- Password -->
    <div class="mt-4">
        <label for="password" :value="__('Password')"></label>
        <input id="password" type="password" name="password" required autocomplete="new-password" />
        @error('password')
            <span class="text-red-600">{{ $message }}</span>
        @enderror
    </div>

    <!-- Confirm Password -->
    <div class="mt-4">
        <label for="password_confirmation" :value="__('Confirm Password')"></label>
        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
        @error('password_confirmation')
            <span class="text-red-600">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit">Reestablecer contraseña</button>
</form>
