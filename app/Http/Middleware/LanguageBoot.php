<?php

namespace App\Http\Middleware;

use App\Providers\LanguageProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class LanguageBoot
{
    const LANGUAGE_SESSION = LanguageProvider::LANGUAGE_SESSION;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $sessionLang = $request->session()->get(self::LANGUAGE_SESSION);
        if (!$sessionLang) {
            return $next($request);
        }

        if ($sessionLang !== App::currentLocale()) {
            App::setLocale($sessionLang);
        }

        return $next($request);
    }
}
