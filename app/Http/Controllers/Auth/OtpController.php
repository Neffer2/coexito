<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Models\UserOtp;
use App\Services\SmsService;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Carbon\Carbon;

class OtpController extends Controller
{
    /**
     * Show OTP validation form.
     */
    public function show(Request $request)
    {
        $user_id = $request->session()->get('otp_user_id');
        if (!$user_id) {
            return redirect()->route('login')->withErrors(['email' => 'Sesión OTP no encontrada.']);
        }
        $user = User::find($user_id);
        $telefono = $user ? $user->telefono : '';
        $telefono_final = $telefono ? substr($telefono, -2) : '';
        return view('auth.otp', [
            'user_id' => $user_id,
            'telefono_final' => $telefono_final
        ]);
    }

    /**
     * Validate OTP code.
     */
    public function validateOtp(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'otp' => 'required|string',
        ]);

        $userOtp = UserOtp::where('user_id', $request->user_id)
            ->where('validated', false)
            ->where('expires_at', '>', Carbon::now())
            ->latest()
            ->first();

        if (!$userOtp || $userOtp->otp !== $request->otp) {
            return back()->withErrors(['otp' => 'El código OTP es incorrecto o ha expirado.']);
        }

        $userOtp->validated = true;
        $userOtp->save();

        Auth::loginUsingId($request->user_id);
        $request->session()->forget('otp_user_id');
        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Resend OTP code via SMS with cooldown.
     */
    public function resend(Request $request)
    {
        $user_id = $request->session()->get('otp_user_id');
        if (!$user_id) {
            return redirect()->route('login')->withErrors(['email' => 'Sesión OTP no encontrada.']);
        }
        $user = User::find($user_id);
        if (!$user) {
            return redirect()->route('login')->withErrors(['email' => 'Usuario no encontrado.']);
        }
        // Cooldown: chequear si ya se envió recientemente
        $lastOtp = UserOtp::where('user_id', $user_id)
            ->latest()
            ->first();
        if ($lastOtp && $lastOtp->created_at > now()->subSeconds(30)) {
            return back()->with('otp_cooldown', 60 - now()->diffInSeconds($lastOtp->created_at));
        }
        // Generar nuevo OTP
        $otp = rand(100000, 999999);
        UserOtp::create([
            'user_id' => $user->id,
            'otp' => $otp,
            'expires_at' => now()->addMinutes(5),
            'validated' => false,
        ]);
        SmsService::sendAction($user->telefono, "Tu nuevo código de Coexitocontigo es: $otp");
        return back()->with('otp_resent', true);
    }
}
