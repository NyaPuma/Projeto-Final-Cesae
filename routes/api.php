<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UiController;
use App\Http\Controllers\AuditController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\RoomController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Documentação da API
Route::redirect('/docs/openapi', '/api/documentation');

// Endpoints Públicos de Autenticação (Guest) - Com Throttle nativo do Laravel e isenção de CSRF
Route::post('/register', [AuthController::class, 'register'])
    ->middleware(['rate.limit:5,1'])
    ->withoutMiddleware([VerifyCsrfToken::class]);

Route::post('/login',    [AuthController::class, 'login'])
    ->middleware(['rate.limit:5,1'])
    ->withoutMiddleware([VerifyCsrfToken::class]);


// Fluxo Público de Password Reset enviado por Email
Route::get('/password/reset/{token}', function ($token) {
    return view('ui.auth-reset', ['token' => $token]);
})->name('password.reset');

Route::post('/password/reset', [AuthController::class, 'resetPassword'])
    ->name('password.update')
    ->withoutMiddleware([VerifyCsrfToken::class]);

