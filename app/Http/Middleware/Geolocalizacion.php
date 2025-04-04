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

        // Usar un servicio de geolocalización para obtener el país
        $location = file_get_contents("http://ipinfo.io/{$ip}/json");
        $locationData = json_decode($location, true);

        // Verificar si el país es Colombia
        if (isset($locationData['country']) && $locationData['country'] !== 'CO') {
            abort(403, 'Acceso restringido a usuarios en Colombia.');
        }

        return $next($request);
    }
}