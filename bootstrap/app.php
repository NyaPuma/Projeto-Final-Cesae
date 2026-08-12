<?php

declare(strict_types=1);

use App\Http\Middleware\CustomAuthMiddleware;
use App\Http\Middleware\RateLimitMiddleware;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\SecurityHeaders;
use App\Http\Middleware\SetLocaleMiddleware;
use App\Http\Middleware\SetUserPreferencesMiddleware;
use App\Jobs\CheckLowStockJob;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Console\Scheduling\Schedule;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            SetLocaleMiddleware::class,
            SetUserPreferencesMiddleware::class,
            SecurityHeaders::class,
        ]);

        // Registar os aliases para usar de forma limpa no ficheiro de rotas
        $middleware->alias([
            'custom.auth' => CustomAuthMiddleware::class,
            'role' => RoleMiddleware::class,
            'rate.limit' => RateLimitMiddleware::class,
        ]);

        $middleware->encryptCookies(except: [
            'api_token',
            'auth_token',
        ]);
    })
    ->withSchedule(function (Schedule $schedule): void {
        $schedule->job(new CheckLowStockJob())->dailyAt('06:00');
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (\InvalidArgumentException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        });

        // Garante o locale (sessão/cookie/browser) também nas páginas de erro,
        // onde o middleware do grupo web já não corre.
        $exceptions->render(function (\Throwable $e, \Illuminate\Http\Request $request) {
            app()->setLocale(SetLocaleMiddleware::resolveFromRequest($request));
        });
    })->create();
