<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\UserOtp;
use App\Services\SmsService;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
            // Validar credenciales sin iniciar sesión completa
            $request->ensureIsNotRateLimited();
            $user = User::where('email', $request->email)->first();
            if (! $user || ! \Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
                \Illuminate\Support\Facades\RateLimiter::hit($request->throttleKey());
                return back()->withErrors(['email' => trans('auth.failed')]);
            }
            \Illuminate\Support\Facades\RateLimiter::clear($request->throttleKey());

            // OTP ON
            // Generar OTP
            // $otp = rand(100000, 999999);
            // UserOtp::create([
            //     'user_id' => $user->id,
            //     'otp' => $otp,
            //     'expires_at' => Carbon::now()->addMinutes(5),
            //     'validated' => false,
            // ]);

            // // Enviar OTP por SMS
            // SmsService::sendAction($user->telefono, "Tu código de Coéxitocontigo es: $otp");

            // // Guardar user_id en sesión para el flujo OTP
            // $request->session()->put('otp_user_id', $user->id);

            // return redirect()->route('otp.show');

            // OTP OFF
            Auth::loginUsingId($user->id);
            $request->session()->regenerateToken();

            return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
