<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Visitor;
use Illuminate\Support\Facades\Http;

class LogVisitor
{
    public function handle($request, Closure $next)
    {
        if (!session()->has('visitor_logged')) {
            $ip = $request->ip();

            try {
                $response = Http::get("http://ip-api.com/json/{$ip}?fields=status,country,countryCode");
                $data = $response->json();

                Visitor::create([
                    'ip_address'   => $ip,
                    'country'      => $data['status'] === 'success' ? $data['country'] : 'Unknown',
                    'country_code' => $data['status'] === 'success' ? $data['countryCode'] : null,
                ]);
            } catch (\Exception $e) {
                Visitor::create([
                    'ip_address' => $ip,
                    'country'    => 'Unknown',
                ]);
            }

            session()->put('visitor_logged', true);
        }

        return $next($request);
    }
}
