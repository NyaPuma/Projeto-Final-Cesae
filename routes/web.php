<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UiController;
use App\Http\Controllers\AuditController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\RoomController;

/*
|--------------------------------------------------------------------------
| Rotas Públicas (Acesso Aberto)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('main');
});

Route::get('/ui/login', function () {
    return view('ui.auth');
})->name('ui.login');

Route::get('/test-email', function () {
    Mail::raw('Teste de comunicação com Mailtrap!', function ($message) {
        $message->to('teste@exemplo.com')
            ->subject('Teste do Sistema de Avarias');
    });
    return 'E-mail enviado com sucesso!';
});

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


/*
|--------------------------------------------------------------------------
| Rotas Protegidas (Exigem Token de Autenticação Válido via custom.auth)
|--------------------------------------------------------------------------
*/
Route::middleware(['custom.auth'])->group(function () {

    Route::withoutMiddleware([VerifyCsrfToken::class])->group(function () {

        // Ações de conta comuns a qualquer utilizador logado
        // ----------------------------------------------------------------------
        Route::post('/logout',                  [AuthController::class, 'logout']);
        Route::post('/password/change',         [AuthController::class, 'changePassword']);
        Route::post('/profile/update',          [AuthController::class, 'updateProfile']);
        Route::get('/notifications',            [NotificationController::class, 'index']);
        Route::patch('/notifications/{id}',     [NotificationController::class, 'markAsRead']);
        Route::post('/notifications/test-email', [NotificationController::class, 'sendTestEmail']);

        // ========================================
        // Rotas Gerais (Acesso para todos os autenticados)
        // ========================================
        Route::get('/ui',              [UiController::class, 'index']);
        Route::get('/ui/profile',      [UiController::class, 'profile']);
        Route::get('/ui/tickets',      [UiController::class, 'tickets']);
        Route::get('/ui/tickets/create', [UiController::class, 'ticketCreate']);
        Route::get('/ui/tickets/{id}', [UiController::class, 'ticketDetail']); // Interface Web do Ticket
        Route::get('/ui/equipments',   [UiController::class, 'equipments']);
        Route::get('/equipments',      [UiController::class, 'getEquipments']);

        // Consultas gerais e interações nos tickets (Endpoints de dados / JSON)
        Route::get('/tickets/search',             [TicketController::class, 'search']);
        Route::get('/tickets',                    [TicketController::class, 'index']);
        Route::get('/tickets/{id}',               [TicketController::class, 'show']); // Retorno de Dados Puro
        Route::post('/tickets/{id}/comments',     [TicketController::class, 'addComment']);
        Route::get('/tickets/{id}/comments',      [TicketController::class, 'listComments']);
        Route::post('/tickets/{id}/photos',       [TicketController::class, 'uploadPhoto']);
        Route::get('/tickets/{id}/photos',        [TicketController::class, 'listPhotos']);

        // Rotas de Fluxo Misto/Avançado
        Route::post('/tickets/{id}/reopen',   [TicketController::class, 'reopenTicket']);
        Route::post('/tickets/{id}/cancel',   [TicketController::class, 'cancelTicket']);
        Route::post('/tickets/{id}/schedule', [TicketController::class, 'scheduleTicket']);

        /*
         |-- Área do Funcionário / Operário Comum
         |----------------------------------------------------------------------*/
        Route::middleware(['role:user'])->group(function () {
            Route::post('/tickets', [TicketController::class, 'store']);
        });

        /*
         |-- Área Exclusiva do Técnico de Manutenção
         |----------------------------------------------------------------------*/
        Route::middleware(['role:technician'])->group(function () {
            Route::put('/technician/tickets/{id}/start',          [TicketController::class, 'startTicket']);
            Route::put('/technician/tickets/{id}/close',          [TicketController::class, 'closeTicket']);
            Route::put('/technician/tickets/{id}/request-budget', [TicketController::class, 'requestBudget']);
        });

        /*
         |-- Área Partilhada (Técnicos e Administradores)
         |----------------------------------------------------------------------*/
        Route::middleware(['role:technician,admin'])->group(function () {
            // UI de acessos partilhados
            Route::get('/ui/users',  [UiController::class, 'users']);
            Route::get('/ui/audits', [UiController::class, 'audits']);

            // Ações operacionais
            Route::get('/technician/tickets/open',         [TicketController::class, 'openTickets']);
            Route::post('/tickets/{id}/assign-technician', [TicketController::class, 'assignTechnician']);

            // Calendário Operacional
            Route::get('/calendar/events', [TicketController::class, 'calendarEvents']);
            Route::get('/calendar',        [TicketController::class, 'calendarView']);

            // Módulo Analítico e Relatórios
            Route::get('/analytics',                [AnalyticsController::class, 'stats']);
            Route::get('/analytics/charts',         [AnalyticsController::class, 'charts']);
            Route::get('/analytics/export/csv',     [AnalyticsController::class, 'exportCsv']);
            Route::get('/analytics/export/pdf',     [AnalyticsController::class, 'exportPdf']);
            Route::get('/analytics/export/excel',   [AnalyticsController::class, 'exportExcel']);

            // UI de Analytics
            Route::get('/ui/analytics',             [UiController::class, 'analytics']);
        });

        /*
         |-- Área de Administração e Backoffice (Direção de Operações)
         |----------------------------------------------------------------------*/
        Route::middleware(['role:admin'])->group(function () {

            // ========================================
            // 🤖 MOTOR DE INTELIGÊNCIA ARTIFICIAL (Módulo Assistido)
            // ========================================
            // Interface de decisão onde o administrador visualiza a avaria com a sugestão da IA
            Route::get('/admin/tickets/{id}', [TicketController::class, 'show'])->name('admin.tickets.show');

            // Submissão imediata para gravar a recomendação escolhida pela IA no MySQL
            Route::patch('/admin/tickets/{id}/atribuir', [TicketController::class, 'atribuirTecnico'])->name('admin.tickets.atribuir');


            // Logs de Auditoria do Sistema
            Route::get('/admin/audits', [AuditController::class, 'index']);

            // Gestão de Utilizadores (CRUD / Estado)
            Route::get('/admin/users',                [AdminController::class, 'users']);
            Route::patch('/admin/users/{id}/inactive', [AdminController::class, 'inactivateUser']);

            // Gestão do Inventário de Equipamentos
            Route::get('/admin/equipment',         [AdminController::class, 'equipments']);
            Route::post('/admin/equipment',        [AdminController::class, 'storeEquipment']);
            Route::patch('/admin/equipment/{id}',  [AdminController::class, 'updateEquipment']);
            Route::delete('/admin/equipment/{id}', [AdminController::class, 'destroyEquipment']);

            // Consulta e criação de salas
            Route::get('/ui/rooms', [UiController::class, 'rooms']);
            Route::get('/ui/rooms/create', [UiController::class, 'roomCreate']);
            Route::get('/ui/rooms/{id}',     [UiController::class, 'roomDetail']);
            Route::get('/ui/rooms/{id}/edit', [UiController::class, 'roomEdit']);

            // Decisão Orçamental de Engenharia
            Route::post('/admin/preventive', [AdminController::class, 'storePreventive']);
            Route::patch('/admin/tickets/{id}/approve-budget', [AdminController::class, 'approveBudget']);

            // Gestão de Infraestrutura (Salas / Pavilhões)
            // Gestão de Infraestrutura (Salas / Pavilhões)
            Route::get('/admin/rooms',                  [RoomController::class, 'indexRoom']);
            Route::post('/admin/rooms',                 [RoomController::class, 'storeRoom']);
            Route::patch('/admin/rooms/{id}',           [RoomController::class, 'updateRoom']);
            Route::patch('/admin/rooms/{id}/inactive',  [RoomController::class, 'inactivateRoom']);
        });
    });
});
