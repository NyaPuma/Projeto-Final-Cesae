<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotas Públicas da API (Acesso Aberto)
|--------------------------------------------------------------------------
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('custom.auth')->name('api.user');

// Documentação da API: servida pelo l5-swagger em /docs/openapi

// Endpoints Públicos de Autenticação
Route::post('/login', [AuthController::class, 'login'])
    ->name('api.login')
    ->middleware(['rate.limit:5,1']);

Route::post('/password/email', [AuthController::class, 'sendResetLink'])
    ->name('api.password.email')
    ->middleware(['rate.limit:3,1']);

Route::get('/password/reset/{token}', function ($token) {
    return view('ui.auth-reset', ['token' => $token]);
})->name('api.password.reset.form');

Route::post('/password/reset', [AuthController::class, 'resetPassword'])
    ->name('api.password.reset')
    ->middleware(['rate.limit:5,1']);

/*
|--------------------------------------------------------------------------
| Rotas Protegidas da API (Autenticadas via X-Auth-Token)
|--------------------------------------------------------------------------
*/
Route::middleware(['custom.auth'])->group(function () {

    // API de Tickets: acessível a qualquer utilizador autenticado
    Route::get('/tickets', [TicketController::class, 'index'])->name('api.tickets.index');
    Route::post('/tickets', [TicketController::class, 'store'])->name('api.tickets.store');
    Route::get('/tickets/{id}', [TicketController::class, 'show'])->name('api.tickets.show');
    Route::post('/tickets/{id}/comments', [TicketController::class, 'addComment'])
        ->name('api.tickets.comments.store');
    Route::get('/tickets/{id}/comments', [TicketController::class, 'listComments'])
        ->name('api.tickets.comments.index');
    Route::post('/tickets/{id}/photos', [TicketController::class, 'uploadPhoto'])
        ->name('api.tickets.photos.store');
    Route::get('/tickets/{id}/photos', [TicketController::class, 'listPhotos'])
        ->name('api.tickets.photos.index');
    Route::delete('/tickets/{id}/photos/{photoId}', [TicketController::class, 'deletePhoto'])
        ->name('api.tickets.photos.destroy');

    // Workflow de tickets
    Route::post('/tickets/{id}/reopen', [TicketController::class, 'reopenTicket'])
        ->name('api.tickets.reopen');
    Route::post('/tickets/{id}/cancel', [TicketController::class, 'cancelTicket'])
        ->name('api.tickets.cancel');
    Route::post('/tickets/{id}/schedule', [TicketController::class, 'scheduleTicket'])
        ->name('api.tickets.schedule');

    // Rotas de técnico — requerem perfil técnico
    Route::middleware(['role:technician'])->group(function () {
        Route::put('/technician/tickets/{id}/start', [TicketController::class, 'startTicket'])
            ->name('api.technician.tickets.start');
        Route::put('/technician/tickets/{id}/close', [TicketController::class, 'closeTicket'])
            ->name('api.technician.tickets.close');
        Route::put('/technician/tickets/{id}/request-budget', [TicketController::class, 'requestBudget'])
            ->name('api.technician.tickets.request-budget');
    });

    // Rotas de administração — requerem perfil administrador
    Route::middleware(['role:admin'])->group(function () {
        // Gestão de Utilizadores
        Route::get('/admin/users', [AdminController::class, 'users'])->name('api.admin.users.index');
        Route::post('/admin/users', [AdminController::class, 'storeUser'])->name('api.admin.users.store');
        Route::patch('/admin/users/{id}', [AdminController::class, 'updateUser'])
            ->name('api.admin.users.update');
        Route::patch('/admin/users/{id}/inactive', [AdminController::class, 'inactivateUser'])
            ->name('api.admin.users.inactivate');
        Route::get('/admin/profiles', [AdminController::class, 'profiles'])
            ->name('api.admin.profiles.index');

        // Auditoria
        Route::get('/admin/audits', [AuditController::class, 'index'])->name('api.admin.audits.index');

        // Gestão de Equipamentos
        Route::get('/admin/equipment', [AdminController::class, 'equipments'])
            ->name('api.admin.equipment.index');
        Route::post('/admin/equipment', [AdminController::class, 'storeEquipment'])
            ->name('api.admin.equipment.store');
        Route::patch('/admin/equipment/{id}', [AdminController::class, 'updateEquipment'])
            ->name('api.admin.equipment.update');
        Route::delete('/admin/equipment/{id}', [AdminController::class, 'destroyEquipment'])
            ->name('api.admin.equipment.destroy');

        // Gestão de Salas
        Route::get('/admin/rooms', [RoomController::class, 'indexRoom'])
            ->name('api.admin.rooms.index');
        Route::post('/admin/rooms', [RoomController::class, 'storeRoom'])
            ->name('api.admin.rooms.store');
        Route::patch('/admin/rooms/{id}', [RoomController::class, 'updateRoom'])
            ->name('api.admin.rooms.update');
        Route::patch('/admin/rooms/{id}/inactive', [RoomController::class, 'inactivateRoom'])
            ->name('api.admin.rooms.inactivate');

        // Gestão de Orçamento e Manutenção Preventiva
        Route::post('/admin/preventive', [AdminController::class, 'storePreventive'])
            ->name('api.admin.preventive.store');
        Route::patch('/admin/tickets/{id}/approve-budget', [AdminController::class, 'approveBudget'])
            ->name('api.admin.tickets.approve-budget');
        Route::patch('/admin/tickets/{id}/atribuir', [TicketController::class, 'atribuirTecnico'])
            ->name('api.admin.tickets.atribuir');
    });

    // Analíticos — requer perfil técnico ou administrador (verificação no controller)
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/analytics/stats', [AnalyticsController::class, 'stats'])
            ->name('api.analytics.stats');
        Route::get('/analytics/charts', [AnalyticsController::class, 'charts'])
            ->name('api.analytics.charts');
        Route::get('/analytics/export/csv', [AnalyticsController::class, 'exportCsv'])
            ->name('api.analytics.export.csv');
        Route::get('/analytics/export/pdf', [AnalyticsController::class, 'exportPdf'])
            ->name('api.analytics.export.pdf');
        Route::get('/analytics/export/excel', [AnalyticsController::class, 'exportExcel'])
            ->name('api.analytics.export.excel');
    });

    // Notificações
    Route::get('/notifications', [NotificationController::class, 'index'])
        ->name('api.notifications.index');
    Route::patch('/notifications/{id}', [NotificationController::class, 'markAsRead'])
        ->name('api.notifications.mark-read');
    Route::post('/notifications/test-email', [NotificationController::class, 'sendTestEmail'])
        ->name('api.notifications.test-email');
});
