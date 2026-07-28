<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminEquipmentController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
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
use App\Http\Controllers\UiController;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotas Públicas (Acesso Aberto)
|--------------------------------------------------------------------------
*/

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/lang/{locale}', [PageController::class, 'switchLang'])->name('lang.switch');
Route::get('/ui/login', [PageController::class, 'login'])->name('ui.login');
Route::get('/test-email', [PageController::class, 'testEmail'])->name('test.email');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login')
    ->middleware(['rate.limit:5,1'])
    ->withoutMiddleware([ValidateCsrfToken::class]);

/*
|--------------------------------------------------------------------------
| Rotas Protegidas (Exigem Token de Autenticação Válido via custom.auth)
|--------------------------------------------------------------------------
*/
Route::middleware(['custom.auth'])->group(function () {

    // --- Conta e Perfil ---
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('auth.logout')
        ->withoutMiddleware([ValidateCsrfToken::class]);
    Route::post('/password/change', [ProfileController::class, 'changePassword'])
        ->name('auth.password.change');
    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])
        ->name('auth.profile.update');

    // --- Notificações ---
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::patch('/notifications/{id}', [NotificationController::class, 'markAsRead'])
        ->name('notifications.mark-read')
        ->withoutMiddleware([ValidateCsrfToken::class]);
    Route::post('/notifications/test-email', [NotificationController::class, 'sendTestEmail'])
        ->name('notifications.test-email')
        ->middleware(['role:admin'])
        ->withoutMiddleware([ValidateCsrfToken::class]);

    // --- Interface Web (UI) ---
    Route::get('/ui', [UiController::class, 'index'])->name('ui.index');
    Route::get('/ui/profile', [UiController::class, 'profile'])->name('ui.profile');
    Route::get('/ui/tickets', [UiController::class, 'tickets'])->name('ui.tickets');
    Route::get('/ui/tickets/create', [UiController::class, 'ticketCreate'])
        ->name('ui.tickets.create')
        ->middleware('role:admin,user');
    Route::get('/ui/tickets/{id}', [UiController::class, 'ticketDetail'])->name('ui.tickets.show');
    Route::get('/ui/equipments', [UiController::class, 'equipments'])->name('ui.equipments');
    Route::get('/equipments', [UiController::class, 'getEquipments'])->name('equipments.list');

    // --- Salas ---
    Route::get('/ui/rooms', [UiController::class, 'rooms'])->name('ui.rooms');
    Route::get('/ui/rooms/{id}', [UiController::class, 'roomDetail'])->name('ui.rooms.show');

    // --- API de Salas ---
    Route::get('/api/rooms', [RoomController::class, 'indexRoom'])->name('rooms.index');
    Route::post('/api/rooms', [RoomController::class, 'storeRoom'])
        ->name('rooms.store')
        ->withoutMiddleware([ValidateCsrfToken::class]);
    Route::put('/api/rooms/{id}', [RoomController::class, 'updateRoom'])
        ->name('rooms.update')
        ->withoutMiddleware([ValidateCsrfToken::class]);
    Route::patch('/api/rooms/{id}', [RoomController::class, 'updateRoom'])
        ->name('rooms.update-patch')
        ->withoutMiddleware([ValidateCsrfToken::class]);

    // --- Tickets ---
    Route::get('/tickets/search', [TicketController::class, 'search'])->name('tickets.search');
    Route::get('/tickets/most-urgent', [TicketController::class, 'getMostUrgentOpenTicket'])->name('tickets.most-urgent');
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/{id}', [TicketController::class, 'show'])->name('tickets.show');
    Route::post('/tickets', [TicketController::class, 'store'])
        ->name('tickets.store')
        ->withoutMiddleware([ValidateCsrfToken::class]);

    // --- Tickets: Comentários ---
    Route::post('/tickets/{id}/comments', [TicketCommentController::class, 'store'])
        ->name('tickets.comments.store')
        ->withoutMiddleware([ValidateCsrfToken::class]);
    Route::get('/tickets/{id}/comments', [TicketCommentController::class, 'index'])->name('tickets.comments.index');

    // --- Tickets: Fotografias ---
    Route::post('/tickets/{id}/photos', [TicketAttachmentController::class, 'store'])
        ->name('tickets.photos.store')
        ->withoutMiddleware([ValidateCsrfToken::class]);
    Route::get('/tickets/{id}/photos', [TicketAttachmentController::class, 'index'])->name('tickets.photos.index');
    Route::delete('/tickets/{id}/photos/{photoId}', [TicketAttachmentController::class, 'destroy'])
        ->name('tickets.photos.destroy')
        ->withoutMiddleware([ValidateCsrfToken::class]);

    // --- Tickets: Fluxo de Estado ---
    Route::post('/tickets/{id}/reopen', [TicketLifecycleController::class, 'reopen'])
        ->name('tickets.reopen')
        ->withoutMiddleware([ValidateCsrfToken::class]);
    Route::post('/tickets/{id}/cancel', [TicketLifecycleController::class, 'cancel'])
        ->name('tickets.cancel')
        ->withoutMiddleware([ValidateCsrfToken::class]);
    Route::post('/tickets/{id}/schedule', [TicketScheduleController::class, '__invoke'])
        ->name('tickets.schedule')
        ->withoutMiddleware([ValidateCsrfToken::class]);

    // --- Tickets: Fluxo Orçamental ---
    Route::post('/tickets/{id}/budget', [TicketBudgetController::class, 'submitEstimate'])
        ->name('tickets.budget')
        ->withoutMiddleware([ValidateCsrfToken::class]);
    Route::post('/tickets/{id}/close', [TicketCloseController::class, 'closeFinal'])
        ->name('tickets.close')
        ->withoutMiddleware([ValidateCsrfToken::class]);

    // --- Calendário ---
    Route::get('/calendar/events', [CalendarController::class, 'events'])->name('calendar.events');
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.view');

    // --- Área do Técnico ---
    Route::middleware(['role:technician'])->group(function () {
        Route::put('/technician/tickets/{id}/start', TicketStartController::class)
            ->name('technician.tickets.start')
            ->withoutMiddleware([ValidateCsrfToken::class]);
        Route::put('/technician/tickets/{id}/close', [TicketCloseController::class, '__invoke'])
            ->name('technician.tickets.close')
            ->withoutMiddleware([ValidateCsrfToken::class]);
        Route::put('/technician/tickets/{id}/request-budget', [TicketBudgetController::class, 'requestAuthorization'])
            ->name('technician.tickets.request-budget')
            ->withoutMiddleware([ValidateCsrfToken::class]);
    });

    // --- Área de Administração ---
    Route::middleware(['role:admin'])->group(function () {

        // UI de admin
        Route::get('/ui/users', [UiController::class, 'users'])->name('ui.users');
        Route::get('/ui/audits', [UiController::class, 'audits'])->name('ui.audits');
        Route::get('/ui/users/create', [UiController::class, 'userCreate'])->name('ui.users.create');
        Route::get('/ui/users/{id}/edit', [UiController::class, 'userEdit'])->name('ui.users.edit');
        Route::get('/ui/rooms/create', [UiController::class, 'roomCreate'])->name('ui.rooms.create');
        Route::get('/ui/rooms/{id}/edit', [UiController::class, 'roomEdit'])->name('ui.rooms.edit');
        Route::get('/ui/analytics', [UiController::class, 'analytics'])->name('ui.analytics');

        // Tickets abertos
        Route::get('/technician/tickets/open', [TicketController::class, 'openTickets'])->name('technician.tickets.open');
        Route::post('/tickets/{id}/assign-technician', [TicketAssignmentController::class, '__invoke'])
            ->name('tickets.assign-technician')
            ->withoutMiddleware([ValidateCsrfToken::class]);

        // Analíticos
        Route::get('/analytics', [AnalyticsController::class, 'stats'])->name('analytics.stats');
        Route::get('/analytics/export/csv', [AnalyticsController::class, 'exportCsv'])->name('analytics.export.csv');
        Route::get('/analytics/export/pdf', [AnalyticsController::class, 'exportPdf'])->name('analytics.export.pdf');
        Route::get('/analytics/export/excel', [AnalyticsController::class, 'exportExcel'])->name('analytics.export.excel');

        // Registo de utilizadores
        Route::post('/admin/users/register', [RegisterController::class, '__invoke'])
            ->name('admin.users.register')
            ->middleware(['rate.limit:5,1']);

        // IA
        Route::get('/admin/tickets/{id}', [TicketController::class, 'show'])->name('admin.tickets.show');
        Route::patch('/admin/tickets/{id}/atribuir', [TicketAssignmentController::class, '__invoke'])
            ->name('admin.tickets.atribuir')
            ->withoutMiddleware([ValidateCsrfToken::class]);

        // Auditoria
        Route::get('/admin/audits', [AuditController::class, 'index'])->name('admin.audits.index');

        // Gestão de Utilizadores
        Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
        Route::post('/admin/users', [AdminUserController::class, 'store'])->name('admin.users.store');
        Route::patch('/admin/users/{id}', [AdminUserController::class, 'update'])->name('admin.users.update');
        Route::patch('/admin/users/{id}/inactive', [AdminUserController::class, 'inactivate'])->name('admin.users.inactivate');
        Route::get('/admin/profiles', [AdminUserController::class, 'profiles'])->name('admin.profiles.index');

        // Gestão de Equipamentos
        Route::get('/admin/equipment', [AdminEquipmentController::class, 'index'])->name('admin.equipment.index');
        Route::post('/admin/equipment', [AdminEquipmentController::class, 'store'])->name('admin.equipment.store');
        Route::patch('/admin/equipment/{id}', [AdminEquipmentController::class, 'update'])->name('admin.equipment.update');
        Route::delete('/admin/equipment/{id}', [AdminEquipmentController::class, 'destroy'])->name('admin.equipment.destroy');

        // Gestão de Salas
        Route::get('/admin/rooms', [RoomController::class, 'indexRoom'])->name('admin.rooms.index');
        Route::post('/admin/rooms', [RoomController::class, 'storeRoom'])->name('admin.rooms.store');
        Route::patch('/admin/rooms/{id}', [RoomController::class, 'updateRoom'])->name('admin.rooms.update');
        Route::patch('/admin/rooms/{id}/inactive', [RoomController::class, 'inactivateRoom'])->name('admin.rooms.inactivate');

        // Orçamento e Manutenção Preventiva
        Route::post('/admin/preventive', [AdminController::class, 'storePreventive'])->name('admin.preventive.store');
        Route::patch('/admin/tickets/{id}/approve-budget', [AdminController::class, 'approveBudget'])
            ->name('admin.tickets.approve-budget')
            ->withoutMiddleware([ValidateCsrfToken::class]);
    });
});
