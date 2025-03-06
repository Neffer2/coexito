<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use GuzzleHttp\Client;

class GeoLocation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $client = new Client();
        $response = $client->get("https://ipinfo.io/{$request->ip()}?token=25e53798e896ae");
        // $response = $client->get("https://ipinfo.io/201.184.127.202?token=25e53798e896ae");
        // Parse the JSON response
        $data = json_decode($response->getBody());
        $dataCollection = collect($data);

        // if ($dataCollection->get('country') !== 'CO') {
        //     return abort(404);
        // }

        // Pais - 

        return $next($request);
    }
}
