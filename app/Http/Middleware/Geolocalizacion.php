<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Geolocalizacion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Obtener la IP del usuario
        $ip = $request->ip();
        $token = env('IPINFO_TOKEN');

        // Usar un servicio de geolocalización para obtener el país
        $location = file_get_contents("http://api.ipinfo.io/lite/me?token={$token}");
        $locationData = json_decode($location, true);

        // Verificar si el país es Colombia
        if ($locationData['country'] !== 'Colombia') {
            abort(403, 'Acceso restringido, promoción solo válida en Colombia.');
        }

        return $next($request);
    }
}