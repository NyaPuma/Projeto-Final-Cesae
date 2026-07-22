<?php

use App\Http\Middleware\CustomAuthMiddleware;
use App\Http\Middleware\RateLimitMiddleware;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\SetLocaleMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            SetLocaleMiddleware::class,
        ]);

        // Registar os aliases para usar de forma limpa no ficheiro de rotas
        $middleware->alias([
            'custom.auth' => CustomAuthMiddleware::class,
            'role' => RoleMiddleware::class,
            'rate.limit' => RateLimitMiddleware::class,
        ]);

        // Adicionar middleware global para proteger contra CSRF em formulários web
        $middleware->validateCsrfTokens(except: [
            'login',
            'register',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
