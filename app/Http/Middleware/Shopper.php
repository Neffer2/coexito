<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\RegistroFactura;

class Shopper
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if ($user && $user->estado_id == 4) {
            $factura = RegistroFactura::where('user_id', $user->id)->orderBy('id', 'desc')->first();
            return redirect()->route('ruleta', ['factura_id' => $factura->id]);
        }

        return $next($request);
    }
}
