<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RoomController;
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

    /*
    |--------------------------------------------------------------------
    | Conta e Perfil (Qualquer Utilizador Autenticado)
    |--------------------------------------------------------------------
    */
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('auth.logout')
        ->withoutMiddleware([ValidateCsrfToken::class]);
    Route::post('/password/change', [AuthController::class, 'changePassword'])
        ->name('auth.password.change');
    Route::post('/profile/update', [AuthController::class, 'updateProfile'])
        ->name('auth.profile.update');

    /*
    |--------------------------------------------------------------------
    | Notificações (Qualquer Utilizador Autenticado)
    |--------------------------------------------------------------------
    */
    Route::get('/notifications', [NotificationController::class, 'index'])
        ->name('notifications.index');
    Route::patch('/notifications/{id}', [NotificationController::class, 'markAsRead'])
        ->name('notifications.mark-read')
        ->withoutMiddleware([ValidateCsrfToken::class]);
    Route::post('/notifications/test-email', [NotificationController::class, 'sendTestEmail'])
        ->name('notifications.test-email')
        ->middleware(['role:admin'])
        ->withoutMiddleware([ValidateCsrfToken::class]);

    /*
    |--------------------------------------------------------------------
    | Interface Web (UI) — Vistas Gerais
    |--------------------------------------------------------------------
    */
    Route::get('/ui', [UiController::class, 'index'])->name('ui.index');
    Route::get('/ui/profile', [UiController::class, 'profile'])->name('ui.profile');
    Route::get('/ui/tickets', [UiController::class, 'tickets'])->name('ui.tickets');
    Route::get('/ui/tickets/create', [UiController::class, 'ticketCreate'])
        ->name('ui.tickets.create')
        ->middleware('role:admin,user');
    Route::get('/ui/tickets/{id}', [UiController::class, 'ticketDetail'])->name('ui.tickets.show');
    Route::get('/ui/equipments', [UiController::class, 'equipments'])->name('ui.equipments');
    Route::get('/equipments', [UiController::class, 'getEquipments'])->name('equipments.list');

    /*
    |--------------------------------------------------------------------
    | Salas — Vistas da Interface
    |--------------------------------------------------------------------
    */
    Route::get('/ui/rooms', [UiController::class, 'rooms'])->name('ui.rooms');
    Route::get('/ui/rooms/{id}', [UiController::class, 'roomDetail'])->name('ui.rooms.show');

    /*
    |--------------------------------------------------------------------
    | API de Salas — Endpoints chamados pelo JavaScript (fetch)
    |--------------------------------------------------------------------
    */
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

    /*
    |--------------------------------------------------------------------
    | Tickets — Consultas e Interações (Dados / JSON)
    |--------------------------------------------------------------------
    */
    Route::get('/tickets/search', [TicketController::class, 'search'])->name('tickets.search');
    Route::get('/tickets/most-urgent', [TicketController::class, 'getMostUrgentOpenTicket'])
        ->name('tickets.most-urgent');
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/{id}', [TicketController::class, 'show'])->name('tickets.show');

    /*
    |--------------------------------------------------------------------
    | Tickets — Comentários e Fotografias
    |--------------------------------------------------------------------
    */
    Route::post('/tickets/{id}/comments', [TicketController::class, 'addComment'])
        ->name('tickets.comments.store')
        ->withoutMiddleware([ValidateCsrfToken::class]);
    Route::get('/tickets/{id}/comments', [TicketController::class, 'listComments'])
        ->name('tickets.comments.index');
    Route::post('/tickets/{id}/photos', [TicketController::class, 'uploadPhoto'])
        ->name('tickets.photos.store')
        ->withoutMiddleware([ValidateCsrfToken::class]);
    Route::get('/tickets/{id}/photos', [TicketController::class, 'listPhotos'])
        ->name('tickets.photos.index');
    Route::delete('/tickets/{id}/photos/{photoId}', [TicketController::class, 'deletePhoto'])
        ->name('tickets.photos.destroy')
        ->withoutMiddleware([ValidateCsrfToken::class]);

    /*
    |--------------------------------------------------------------------
    | Tickets — Fluxo de Estado
    |--------------------------------------------------------------------
    */
    Route::post('/tickets/{id}/reopen', [TicketController::class, 'reopenTicket'])
        ->name('tickets.reopen')
        ->withoutMiddleware([ValidateCsrfToken::class]);
    Route::post('/tickets/{id}/cancel', [TicketController::class, 'cancelTicket'])
        ->name('tickets.cancel')
        ->withoutMiddleware([ValidateCsrfToken::class]);
    Route::post('/tickets/{id}/schedule', [TicketController::class, 'scheduleTicket'])
        ->name('tickets.schedule')
        ->withoutMiddleware([ValidateCsrfToken::class]);

    /*
    |--------------------------------------------------------------------
    | Tickets — Fluxo Orçamental
    |--------------------------------------------------------------------
    */
    Route::post('/tickets/{id}/budget', [TicketController::class, 'submitEstimatedBudget'])
        ->name('tickets.budget')
        ->withoutMiddleware([ValidateCsrfToken::class]);
    Route::post('/tickets/{id}/close', [TicketController::class, 'closeTicketFinal'])
        ->name('tickets.close')
        ->withoutMiddleware([ValidateCsrfToken::class]);

    /*
    |--------------------------------------------------------------------
    | Tickets — Criação (Qualquer Utilizador Autenticado)
    |--------------------------------------------------------------------
    */
    Route::post('/tickets', [TicketController::class, 'store'])
        ->name('tickets.store')
        ->withoutMiddleware([ValidateCsrfToken::class]);

    /*
    |--------------------------------------------------------------------
    | Calendário Operacional
    |--------------------------------------------------------------------
    */
    Route::get('/calendar/events', [TicketController::class, 'calendarEvents'])
        ->name('calendar.events');
    Route::get('/calendar', [TicketController::class, 'calendarView'])
        ->name('calendar.view');

    /*
    |--------------------------------------------------------------------
    | Área Exclusiva do Técnico de Manutenção
    |--------------------------------------------------------------------
    */
    Route::middleware(['role:technician'])->group(function () {
        Route::put('/technician/tickets/{id}/start', [TicketController::class, 'startTicket'])
            ->name('technician.tickets.start')
            ->withoutMiddleware([ValidateCsrfToken::class]);
        Route::put('/technician/tickets/{id}/close', [TicketController::class, 'closeTicket'])
            ->name('technician.tickets.close')
            ->withoutMiddleware([ValidateCsrfToken::class]);
        Route::put('/technician/tickets/{id}/request-budget', [TicketController::class, 'requestBudget'])
            ->name('technician.tickets.request-budget')
            ->withoutMiddleware([ValidateCsrfToken::class]);
    });

    /*
    |--------------------------------------------------------------------
    | Área de Administração e Backoffice
    |--------------------------------------------------------------------
    */
    Route::middleware(['role:admin'])->group(function () {

        // UI de acessos restritos ao admin
        Route::get('/ui/users', [UiController::class, 'users'])->name('ui.users');
        Route::get('/ui/audits', [UiController::class, 'audits'])->name('ui.audits');
        Route::get('/ui/users/create', [UiController::class, 'userCreate'])->name('ui.users.create');
        Route::get('/ui/users/{id}/edit', [UiController::class, 'userEdit'])->name('ui.users.edit');
        Route::get('/ui/rooms/create', [UiController::class, 'roomCreate'])->name('ui.rooms.create');
        Route::get('/ui/rooms/{id}/edit', [UiController::class, 'roomEdit'])->name('ui.rooms.edit');
        Route::get('/ui/analytics', [UiController::class, 'analytics'])->name('ui.analytics');

        // Ações operacionais
        Route::get('/technician/tickets/open', [TicketController::class, 'openTickets'])
            ->name('technician.tickets.open');
        Route::post('/tickets/{id}/assign-technician', [TicketController::class, 'assignTechnician'])
            ->name('tickets.assign-technician')
            ->withoutMiddleware([ValidateCsrfToken::class]);

        // ========================================
        // Módulo Analítico e Relatórios (admin)
        // ========================================
        Route::get('/analytics', [AnalyticsController::class, 'stats'])->name('analytics.stats');
        Route::get('/analytics/charts', [AnalyticsController::class, 'charts'])->name('analytics.charts');
        Route::get('/analytics/export/csv', [AnalyticsController::class, 'exportCsv'])
            ->name('analytics.export.csv');
        Route::get('/analytics/export/pdf', [AnalyticsController::class, 'exportPdf'])
            ->name('analytics.export.pdf');
        Route::get('/analytics/export/excel', [AnalyticsController::class, 'exportExcel'])
            ->name('analytics.export.excel');

        // ========================================
        // Registo de Utilizadores (Apenas Admin)
        // ========================================
        Route::post('/admin/users/register', [AuthController::class, 'register'])
            ->name('admin.users.register')
            ->middleware(['rate.limit:5,1']);

        // ========================================
        // Motor de IA — Atribuição de Técnicos
        // ========================================
        Route::get('/admin/tickets/{id}', [TicketController::class, 'show'])
            ->name('admin.tickets.show');
        Route::patch('/admin/tickets/{id}/atribuir', [TicketController::class, 'atribuirTecnico'])
            ->name('admin.tickets.atribuir')
            ->withoutMiddleware([ValidateCsrfToken::class]);

        // ========================================
        // Logs de Auditoria
        // ========================================
        Route::get('/admin/audits', [AuditController::class, 'index'])->name('admin.audits.index');

        // ========================================
        // Gestão de Utilizadores (CRUD / Estado)
        // ========================================
        Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users.index');
        Route::post('/admin/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
        Route::patch('/admin/users/{id}', [AdminController::class, 'updateUser'])
            ->name('admin.users.update');
        Route::patch('/admin/users/{id}/inactive', [AdminController::class, 'inactivateUser'])
            ->name('admin.users.inactivate');
        Route::get('/admin/profiles', [AdminController::class, 'profiles'])->name('admin.profiles.index');

        // ========================================
        // Gestão do Inventário de Equipamentos
        // ========================================
        Route::get('/admin/equipment', [AdminController::class, 'equipments'])
            ->name('admin.equipment.index');
        Route::post('/admin/equipment', [AdminController::class, 'storeEquipment'])
            ->name('admin.equipment.store');
        Route::patch('/admin/equipment/{id}', [AdminController::class, 'updateEquipment'])
            ->name('admin.equipment.update');
        Route::delete('/admin/equipment/{id}', [AdminController::class, 'destroyEquipment'])
            ->name('admin.equipment.destroy');

        // ========================================
        // Gestão de Infraestrutura (Salas)
        // ========================================
        Route::get('/admin/rooms', [RoomController::class, 'indexRoom'])->name('admin.rooms.index');
        Route::post('/admin/rooms', [RoomController::class, 'storeRoom'])->name('admin.rooms.store');
        Route::patch('/admin/rooms/{id}', [RoomController::class, 'updateRoom'])
            ->name('admin.rooms.update');
        Route::patch('/admin/rooms/{id}/inactive', [RoomController::class, 'inactivateRoom'])
            ->name('admin.rooms.inactivate');

        // ========================================
        // Decisão Orçamental e Manutenção Preventiva
        // ========================================
        Route::post('/admin/preventive', [AdminController::class, 'storePreventive'])
            ->name('admin.preventive.store');
        Route::patch('/admin/tickets/{id}/approve-budget', [AdminController::class, 'approveBudget'])
            ->name('admin.tickets.approve-budget');
        Route::post('/admin/tickets/{id}/budget-decision', [AdminController::class, 'approveBudget'])
            ->name('admin.tickets.budget-decision')
            ->withoutMiddleware([ValidateCsrfToken::class]);
    });
});
