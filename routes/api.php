<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminEquipmentController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\Ticket\TicketAssignmentController;
use App\Http\Controllers\Ticket\TicketCloseController;
use App\Http\Controllers\Ticket\TicketLifecycleController;
use App\Http\Controllers\Ticket\TicketScheduleController;
use App\Http\Controllers\Ticket\TicketStartController;
use App\Http\Controllers\TicketAttachmentController;
use App\Http\Controllers\TicketBudgetController;
use App\Http\Controllers\TicketCommentController;
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

Route::post('/login', [AuthController::class, 'login'])
    ->name('api.login')
    ->middleware(['rate.limit:5,1']);

Route::post('/password/email', [PasswordResetController::class, 'sendResetLink'])
    ->name('api.password.email')
    ->middleware(['rate.limit:3,1']);

Route::get('/password/reset/{token}', function ($token) {
    return view('ui.auth-reset', ['token' => $token]);
})->name('api.password.reset.form');

Route::post('/password/reset', [PasswordResetController::class, 'resetPassword'])
    ->name('api.password.reset')
    ->middleware(['rate.limit:5,1']);

/*
|--------------------------------------------------------------------------
| Rotas Protegidas da API (Autenticadas via X-Auth-Token)
|--------------------------------------------------------------------------
*/
Route::middleware(['custom.auth'])->group(function () {

    // Tickets
    Route::get('/tickets', [TicketController::class, 'index'])->name('api.tickets.index');
    Route::post('/tickets', [TicketController::class, 'store'])->name('api.tickets.store');
    Route::get('/tickets/{id}', [TicketController::class, 'show'])->name('api.tickets.show');

    // Comentários
    Route::post('/tickets/{id}/comments', [TicketCommentController::class, 'store'])->name('api.tickets.comments.store');
    Route::get('/tickets/{id}/comments', [TicketCommentController::class, 'index'])->name('api.tickets.comments.index');

    // Fotos
    Route::post('/tickets/{id}/photos', [TicketAttachmentController::class, 'store'])->name('api.tickets.photos.store');
    Route::get('/tickets/{id}/photos', [TicketAttachmentController::class, 'index'])->name('api.tickets.photos.index');
    Route::delete('/tickets/{id}/photos/{photoId}', [TicketAttachmentController::class, 'destroy'])->name('api.tickets.photos.destroy');

    // Workflow
    Route::post('/tickets/{id}/reopen', [TicketLifecycleController::class, 'reopen'])->name('api.tickets.reopen');
    Route::post('/tickets/{id}/cancel', [TicketLifecycleController::class, 'cancel'])->name('api.tickets.cancel');
    Route::post('/tickets/{id}/schedule', TicketScheduleController::class)->name('api.tickets.schedule');

    // Técnico
    Route::middleware(['role:technician'])->group(function () {
        Route::put('/technician/tickets/{id}/start', TicketStartController::class)->name('api.technician.tickets.start');
        Route::put('/technician/tickets/{id}/close', [TicketCloseController::class, '__invoke'])->name('api.technician.tickets.close');
        Route::put('/technician/tickets/{id}/close-final', [TicketCloseController::class, 'closeFinal'])->name('api.technician.tickets.close-final');
        Route::put('/technician/tickets/{id}/request-budget', [TicketBudgetController::class, 'requestAuthorization'])->name('api.technician.tickets.request-budget');
    });

    // Admin
    Route::middleware(['role:admin'])->group(function () {
        // Utilizadores
        Route::get('/admin/users', [AdminUserController::class, 'index'])->name('api.admin.users.index');
        Route::post('/admin/users', [AdminUserController::class, 'store'])->name('api.admin.users.store');
        Route::patch('/admin/users/{id}', [AdminUserController::class, 'update'])->name('api.admin.users.update');
        Route::patch('/admin/users/{id}/inactive', [AdminUserController::class, 'inactivate'])->name('api.admin.users.inactivate');
        Route::get('/admin/profiles', [AdminUserController::class, 'profiles'])->name('api.admin.profiles.index');

        // Auditoria
        Route::get('/admin/audits', [AuditController::class, 'index'])->name('api.admin.audits.index');

        // Equipamentos
        Route::get('/admin/equipment', [AdminEquipmentController::class, 'index'])->name('api.admin.equipment.index');
        Route::post('/admin/equipment', [AdminEquipmentController::class, 'store'])->name('api.admin.equipment.store');
        Route::patch('/admin/equipment/{id}', [AdminEquipmentController::class, 'update'])->name('api.admin.equipment.update');
        Route::delete('/admin/equipment/{id}', [AdminEquipmentController::class, 'destroy'])->name('api.admin.equipment.destroy');

        // Salas
        Route::get('/admin/rooms', [RoomController::class, 'indexRoom'])->name('api.admin.rooms.index');
        Route::post('/admin/rooms', [RoomController::class, 'storeRoom'])->name('api.admin.rooms.store');
        Route::patch('/admin/rooms/{id}', [RoomController::class, 'updateRoom'])->name('api.admin.rooms.update');
        Route::patch('/admin/rooms/{id}/inactive', [RoomController::class, 'inactivateRoom'])->name('api.admin.rooms.inactivate');

        // Orçamento e Manutenção Preventiva
        Route::post('/admin/preventive', [AdminController::class, 'storePreventive'])->name('api.admin.preventive.store');
        Route::patch('/admin/tickets/{id}/approve-budget', [AdminController::class, 'approveBudget'])->name('api.admin.tickets.approve-budget');
        Route::patch('/admin/tickets/{id}/atribuir', TicketAssignmentController::class)->name('api.admin.tickets.atribuir');
    });

    // Analíticos
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/analytics/stats', [AnalyticsController::class, 'stats'])->name('api.analytics.stats');
        Route::get('/analytics/charts', [AnalyticsController::class, 'stats'])->name('api.analytics.charts');
        Route::get('/analytics/export/csv', [AnalyticsController::class, 'exportCsv'])->name('api.analytics.export.csv');
        Route::get('/analytics/export/pdf', [AnalyticsController::class, 'exportPdf'])->name('api.analytics.export.pdf');
        Route::get('/analytics/export/excel', [AnalyticsController::class, 'exportExcel'])->name('api.analytics.export.excel');
    });

    // Notificações
    Route::get('/notifications', [NotificationController::class, 'index'])->name('api.notifications.index');
    Route::patch('/notifications/{id}', [NotificationController::class, 'markAsRead'])->name('api.notifications.mark-read');
    Route::post('/notifications/test-email', [NotificationController::class, 'sendTestEmail'])->name('api.notifications.test-email');
});
