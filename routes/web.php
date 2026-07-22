<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UiController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotas Públicas (Acesso Aberto)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('main');
});

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'pt'])) {
        session(['locale' => $locale]);

        return redirect()->back()->withCookie(cookie()->forever('locale', $locale));
    }

    return redirect()->back();
})->name('lang.switch');

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

// 🔒 SEGURANÇA CORRIGIDA: O endpoint público '/register' foi completamente removido daqui.
// Apenas o endpoint de login permanece aberto ao público (Guest) com Throttle e isenção de CSRF
Route::post('/login', [AuthController::class, 'login'])
    ->middleware(['rate.limit:5,1'])
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
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/password/change', [AuthController::class, 'changePassword']);
        Route::post('/profile/update', [AuthController::class, 'updateProfile']);
        Route::get('/notifications', [NotificationController::class, 'index']);
        Route::patch('/notifications/{id}', [NotificationController::class, 'markAsRead']);
        Route::post('/notifications/test-email', [NotificationController::class, 'sendTestEmail']);

        // ========================================
        // Rotas Gerais (Acesso para todos os autenticados)
        // ========================================
        Route::get('/ui', [UiController::class, 'index']);
        Route::get('/ui/profile', [UiController::class, 'profile']);
        Route::get('/ui/tickets', [UiController::class, 'tickets']);
        Route::get('/ui/tickets/create', [UiController::class, 'ticketCreate'])->middleware('role:admin,user');
        Route::get('/ui/tickets/{id}', [UiController::class, 'ticketDetail']); // Interface Web do Ticket
        Route::get('/ui/equipments', [UiController::class, 'equipments']);
        Route::get('/equipments', [UiController::class, 'getEquipments']);

        // 🚪 Salas - Vistas da Interface (UI)
        Route::get('/ui/rooms', [UiController::class, 'rooms']);
        Route::get('/ui/rooms/{id}', [UiController::class, 'roomDetail']);

        // 📡 API de Salas - Endpoints chamados pelo JavaScript (fetch)
        Route::get('/api/rooms', [RoomController::class, 'indexRoom']);
        Route::post('/api/rooms', [RoomController::class, 'storeRoom']);
        Route::put('/api/rooms/{id}', [RoomController::class, 'updateRoom']);
        Route::patch('/api/rooms/{id}', [RoomController::class, 'updateRoom']);

        // Consultas gerais e interações nos tickets (Endpoints de dados / JSON)
        Route::get('/tickets/search', [TicketController::class, 'search']);
        Route::get('/tickets', [TicketController::class, 'index']);
        Route::get('/tickets/{id}', [TicketController::class, 'show']); // Retorno de Dados Puro
        Route::post('/tickets/{id}/comments', [TicketController::class, 'addComment']);
        Route::get('/tickets/{id}/comments', [TicketController::class, 'listComments']);
        Route::post('/tickets/{id}/photos', [TicketController::class, 'uploadPhoto']);
        Route::get('/tickets/{id}/photos', [TicketController::class, 'listPhotos']);
        Route::delete('/tickets/{id}/photos/{photoId}', [TicketController::class, 'deletePhoto']);

        // Rotas de Fluxo Misto/Avançado
        Route::post('/tickets/{id}/reopen', [TicketController::class, 'reopenTicket']);
        Route::post('/tickets/{id}/cancel', [TicketController::class, 'cancelTicket']);
        Route::post('/tickets/{id}/schedule', [TicketController::class, 'scheduleTicket']);

        // 💰 Fluxo Orçamental - Submissão do orçamento pelo técnico
        Route::post('/tickets/{id}/budget', [TicketController::class, 'submitEstimatedBudget']);
        Route::post('/tickets/{id}/close', [TicketController::class, 'closeTicketFinal']);

        // 🛠️ MODELO IN-HOUSE ALINHADO: Qualquer utilizador autenticado pode reportar uma avaria.
        // Removido do middleware restritivo 'role:user' para que Técnicos e Admins também criem tickets em campo.
        Route::post('/tickets', [TicketController::class, 'store']);

        // 📅 Calendário Operacional - acessível a todos os utilizadores autenticados
        Route::get('/calendar/events', [TicketController::class, 'calendarEvents']);
        Route::get('/calendar', [TicketController::class, 'calendarView']);

        /*
         |-- Área Exclusiva do Técnico de Manutenção
         |----------------------------------------------------------------------*/
        Route::middleware(['role:technician'])->group(function () {
            Route::put('/technician/tickets/{id}/start', [TicketController::class, 'startTicket']);
            Route::put('/technician/tickets/{id}/close', [TicketController::class, 'closeTicket']);
            Route::put('/technician/tickets/{id}/request-budget', [TicketController::class, 'requestBudget']);
        });

        /*
         |-- Área Partilhada (Técnicos e Administradores)
         |----------------------------------------------------------------------*/
        Route::middleware(['role:admin'])->group(function () {
            // UI de acessos restritos ao admin
            Route::get('/ui/users', [UiController::class, 'users']);
            Route::get('/ui/audits', [UiController::class, 'audits']);

            // Ações operacionais
            Route::get('/technician/tickets/open', [TicketController::class, 'openTickets']);
            Route::post('/tickets/{id}/assign-technician', [TicketController::class, 'assignTechnician']);

            // (analytics fica apenas para admin)
        });

        /*
         |-- Área de Administração e Backoffice (Direção de Operações)
         |----------------------------------------------------------------------*/
        Route::middleware(['role:admin'])->group(function () {

            // ========================================
            // Módulo Analítico e Relatórios (apenas admin)
            // ========================================
            Route::get('/analytics', [AnalyticsController::class, 'stats']);
            Route::get('/analytics/charts', [AnalyticsController::class, 'charts']);
            Route::get('/analytics/export/csv', [AnalyticsController::class, 'exportCsv']);
            Route::get('/analytics/export/pdf', [AnalyticsController::class, 'exportPdf']);
            Route::get('/analytics/export/excel', [AnalyticsController::class, 'exportExcel']);
            Route::get('/ui/analytics', [UiController::class, 'analytics']);

            // 🔐 SEGURANÇA BLINDADA: Endpoint de registo movido para a área protegida do Administrador.

            // Protegido com o prefixo /admin e controlado pelo middleware de acessos baseado em roles.
            Route::post('/admin/users/register', [AuthController::class, 'register'])
                ->name('admin.users.register')
                ->middleware(['rate.limit:5,1']);

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
            Route::get('/admin/users', [AdminController::class, 'users']);
            Route::post('/admin/users', [AdminController::class, 'storeUser']);
            Route::patch('/admin/users/{id}', [AdminController::class, 'updateUser']);
            Route::patch('/admin/users/{id}/inactive', [AdminController::class, 'inactivateUser']);
            Route::get('/admin/profiles', [AdminController::class, 'profiles']);

            // UI de Utilizadores adicionais (Criação e Edição)
            Route::get('/ui/users/create', [UiController::class, 'userCreate']);
            Route::get('/ui/users/{id}/edit', [UiController::class, 'userEdit']);

            // Gestão do Inventário de Equipamentos
            Route::get('/admin/equipment', [AdminController::class, 'equipments']);
            Route::post('/admin/equipment', [AdminController::class, 'storeEquipment']);
            Route::patch('/admin/equipment/{id}', [AdminController::class, 'updateEquipment']);
            Route::delete('/admin/equipment/{id}', [AdminController::class, 'destroyEquipment']);

            // Consulta e criação de salas (UI Admin)
            Route::get('/ui/rooms/create', [UiController::class, 'roomCreate']);
            Route::get('/ui/rooms/{id}/edit', [UiController::class, 'roomEdit']);

            // Decisão Orçamental de Engenharia
            Route::post('/admin/preventive', [AdminController::class, 'storePreventive']);
            Route::patch('/admin/tickets/{id}/approve-budget', [AdminController::class, 'approveBudget']);
            Route::post('/admin/tickets/{id}/budget-decision', [AdminController::class, 'approveBudget']);

            // Gestão de Infraestrutura (Salas / Pavilhões) - Endpoints Admin legados
            Route::get('/admin/rooms', [RoomController::class, 'indexRoom']);
            Route::post('/admin/rooms', [RoomController::class, 'storeRoom']);
            Route::patch('/admin/rooms/{id}', [RoomController::class, 'updateRoom']);
            Route::patch('/admin/rooms/{id}/inactive', [RoomController::class, 'inactivateRoom']);
        });
    });
});
