<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // ... previous customizations
        ResetPassword::toMailUsing(function (User $user, string $token) {
            $url = url(route('password.reset', [
                'token' => $token,
                'email' => $user->getEmailForPasswordReset(),
            ], false));

            return (new MailMessage)
                ->subject(config('app.name') . ': ' . __('Solicitud de restablecimiento de contraseña'))
                ->greeting(__('Hola!'))
                ->line(__('Te enviamos este correo porque recibimos una solicitud de reestablecimiento de contraseña para tu cuenta.'))
                ->action(__('Reestablecer contraseña'), $url)
                ->line(__('Este enlace de reestablecimiento expirará en :count minutos.', ['count' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire')]))
                ->line(__('Si no solicitaste cambio de contraseña, por favor ignora este mensaje.'))
                ->salutation(__('Saludos,') . "\n" . config('app.name').".");
        });
    }
}
