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

// Endpoints Públicos de Autenticação (Guest) - Apenas login e password reset
Route::post('/login',    [AuthController::class, 'login'])
    ->middleware(['rate.limit:5,1'])
    ->withoutMiddleware([VerifyCsrfToken::class]);

// Password reset - público (fluxo de email)
Route::get('/password/reset/{token}', function ($token) {
    return view('ui.auth-reset', ['token' => $token]);
})->name('password.reset');

Route::post('/password/reset', [AuthController::class, 'resetPassword'])
    ->name('password.update')
    ->withoutMiddleware([VerifyCsrfToken::class]);

/*
|--------------------------------------------------------------------------
| Rotas Protegidas da API (Autenticadas via Sanctum / X-Auth-Token)
|--------------------------------------------------------------------------
*/
Route::middleware(['custom.auth'])->group(function () {

    // API de Tickets: acessível a qualquer utilizador autenticado
    Route::get('/tickets',                    [TicketController::class, 'index']);
    Route::post('/tickets',                   [TicketController::class, 'store']);
    Route::get('/tickets/{id}',               [TicketController::class, 'show']);
    Route::post('/tickets/{id}/comments',     [TicketController::class, 'addComment']);
    Route::get('/tickets/{id}/comments',      [TicketController::class, 'listComments']);
    Route::post('/tickets/{id}/photos',       [TicketController::class, 'uploadPhoto']);
    Route::get('/tickets/{id}/photos',        [TicketController::class, 'listPhotos']);
    Route::delete('/tickets/{id}/photos/{photoId}', [TicketController::class, 'deletePhoto']);

    // Workflow de tickets
    Route::post('/tickets/{id}/reopen',   [TicketController::class, 'reopenTicket']);
    Route::post('/tickets/{id}/cancel',   [TicketController::class, 'cancelTicket']);
    Route::post('/tickets/{id}/schedule', [TicketController::class, 'scheduleTicket']);

    // Rotas de técnico
    Route::put('/technician/tickets/{id}/start',          [TicketController::class, 'startTicket']);
    Route::put('/technician/tickets/{id}/close',          [TicketController::class, 'closeTicket']);
    Route::put('/technician/tickets/{id}/request-budget', [TicketController::class, 'requestBudget']);

    // Rotas de administração
    Route::get('/admin/users',                [AdminController::class, 'users']);
    Route::post('/admin/users',               [AdminController::class, 'storeUser']);
    Route::patch('/admin/users/{id}',         [AdminController::class, 'updateUser']);
    Route::patch('/admin/users/{id}/inactive', [AdminController::class, 'inactivateUser']);
    Route::get('/admin/profiles',             [AdminController::class, 'profiles']);
    Route::get('/admin/audits',               [AuditController::class, 'index']);

    // Gestão de Equipamentos via API
    Route::get('/admin/equipment',            [AdminController::class, 'equipments']);
    Route::post('/admin/equipment',           [AdminController::class, 'storeEquipment']);
    Route::patch('/admin/equipment/{id}',     [AdminController::class, 'updateEquipment']);
    Route::delete('/admin/equipment/{id}',    [AdminController::class, 'destroyEquipment']);

    // Gestão de Salas via API
    Route::get('/admin/rooms',                [RoomController::class, 'indexRoom']);
    Route::post('/admin/rooms',               [RoomController::class, 'storeRoom']);
    Route::patch('/admin/rooms/{id}',         [RoomController::class, 'updateRoom']);
    Route::patch('/admin/rooms/{id}/inactive', [RoomController::class, 'inactivateRoom']);

    // Analíticos
    Route::get('/analytics/stats',            [AnalyticsController::class, 'stats']);
    Route::get('/analytics/charts',           [AnalyticsController::class, 'charts']);
    Route::get('/analytics/export/csv',       [AnalyticsController::class, 'exportCsv']);
    Route::get('/analytics/export/pdf',       [AnalyticsController::class, 'exportPdf']);
    Route::get('/analytics/export/excel',     [AnalyticsController::class, 'exportExcel']);

    // Notificações
    Route::get('/notifications',              [NotificationController::class, 'index']);
    Route::patch('/notifications/{id}',       [NotificationController::class, 'markAsRead']);
    Route::post('/notifications/test-email',  [NotificationController::class, 'sendTestEmail']);

    // Gestão de Orçamento
    Route::post('/admin/preventive',                  [AdminController::class, 'storePreventive']);
    Route::patch('/admin/tickets/{id}/approve-budget', [AdminController::class, 'approveBudget']);
    Route::patch('/admin/tickets/{id}/atribuir',       [TicketController::class, 'atribuirTecnico']);
});


