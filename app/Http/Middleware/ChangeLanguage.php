<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class ChangeLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = $request->get('lang', 'en'); // Default to 'en'
        if (in_array($locale, config('app.supported_locales', ['en', 'ar']))) {
            app()->setLocale($locale);
        }

        return $next($request);
    }
}
