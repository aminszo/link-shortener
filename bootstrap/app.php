<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\SetLanguageFromCookie;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // register "SetLanguageFromCookie" to middlewares.
        $middleware->append(SetLanguageFromCookie::class);

        /*
        * exclude the 'user_lang' cookie from laravel's automatic cookie encription.
        * this cookie is used to keep user preferd language. and then set it as the app locale
        * in "SetLanguageFromCookie" middleware.
        * the reason we exclude it, is that automatic cookie decription does not work within the
        * mentioned middlewaer, so insted of manually decripting it each time, we can exclude it
        * from being encripted, since it is not a sensitive value.
        */
        $middleware->encryptCookies(except: [
            'user_lang',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
