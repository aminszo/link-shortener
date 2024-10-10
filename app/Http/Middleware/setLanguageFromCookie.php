<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class setLanguageFromCookie
{
    /**
     * Handle an incoming request to set the application's locale from a cookie.
     * 
     * This middleware checks if a 'user_lang' cookie is present in the incoming
     * HTTP request. If found, it sets the application's locale to the value stored
     * in the cookie. If the cookie is not present, it defaults to the locale set
     * in the application's configuration (`config('app.locale')`).
     * This is how the application implements its multi-language feature.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        /*
         * The 'user_lang' cookie is excluded from Laravel's automatic cookie encryption
         * because the default cookie decryption does not function correctly within
         * this middleware. The root cause of this issue is unknown.
        */
        $locale = $request->cookie('user_lang', config('app.locale')); // Default to the app locale if no cookie

        // Set the application locale
        App::setLocale($locale);

        return $next($request);
    }
}
