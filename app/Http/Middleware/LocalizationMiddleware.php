<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LocalizationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $clientLang = match ($request->getPreferredLanguage()) {
            "tr", "tr_TR" => "tr_TR",
            "uz", "uz_UZ" => "uz_UZ",
            "ru", "ru_RU" => "ru_RU",
            "en", "en_US" => "en_US",
            default => "uz_UZ",
        };

        app()->setLocale($clientLang);
        return $next($request);
    }
}
