<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UiController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\File;
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

// Rota de alteração de idioma (Pública e persistente)
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'pt'])) {
        session(['locale' => $locale]);
        app()->setLocale($locale);
        cookie()->queue(cookie()->forever('locale', $locale));
    }

    return redirect()->back();
})->name('lang.switch');

// Vista de Login
Route::get('/ui/login', function () {
    return view()->exists('ui.login') ? view('ui.login') : view('ui.auth');
})->name('ui.login');

// Processamento do Login (Obrigatório para autenticação)
Route::post('/login', [AuthController::class, 'login'])
    ->name('login')
    ->middleware(['rate.limit:5,1'])
    ->withoutMiddleware([VerifyCsrfToken::class]);

/*
|--------------------------------------------------------------------------
| Rotas Protegidas (Exigem Token de Autenticação Válido via custom.auth)
|--------------------------------------------------------------------------
*/
Route::middleware(['custom.auth'])->group(function () {

    Route::post('/tickets/{id}/release', [TicketController::class, 'releaseTicket']);

    Route::withoutMiddleware([VerifyCsrfToken::class])->group(function () {

        Route::match(['post', 'put'], '/tickets/{id}/claim', [TicketController::class, 'claimTicket']);

        // Ações de conta comuns
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/password/change', [AuthController::class, 'changePassword']);
        Route::post('/profile/update', [AuthController::class, 'updateProfile']);
        Route::get('/notifications', [NotificationController::class, 'index']);
        Route::patch('/notifications/{id}', [NotificationController::class, 'markAsRead']);
        Route::post('/notifications/test-email', [NotificationController::class, 'sendTestEmail']);

        // Rotas Gerais da Interface (UI)
        Route::get('/ui', [UiController::class, 'index']);
        Route::get('/ui/profile', [UiController::class, 'profile']);
        Route::get('/ui/tickets', [UiController::class, 'tickets']);
        Route::get('/ui/tickets/create', [UiController::class, 'ticketCreate'])->middleware('role:admin,user');
        Route::get('/ui/tickets/{id}', [UiController::class, 'ticketDetail']);
        Route::get('/ui/equipments', [UiController::class, 'equipments']);

        // 🚪 Salas - Vistas da Interface (UI)
        Route::get('/ui/rooms', [UiController::class, 'rooms']);
        Route::get('/ui/rooms/{id}', [UiController::class, 'roomDetail']);

        // 📡 API de Salas
        Route::get('/rooms', [RoomController::class, 'indexRoom']);
        Route::get('/api/rooms', [RoomController::class, 'indexRoom']);
        Route::post('/api/rooms', [RoomController::class, 'storeRoom']);
        Route::put('/api/rooms/{id}', [RoomController::class, 'updateRoom']);
        Route::patch('/api/rooms/{id}', [RoomController::class, 'updateRoom']);

        // 📦 API de Equipamentos (CRUD)
        Route::get('/equipments', [EquipmentController::class, 'index']);
        Route::post('/equipments', [EquipmentController::class, 'store']);
        Route::get('/equipments/{id}', [EquipmentController::class, 'show']);
        Route::put('/equipments/{id}', [EquipmentController::class, 'update']);
        Route::delete('/equipments/{id}', [EquipmentController::class, 'destroy']);

        // Endpoints de Tickets
        Route::get('/tickets/search', [TicketController::class, 'search']);
        Route::get('/tickets/my', [TicketController::class, 'myTickets']);
        Route::get('/tickets', [TicketController::class, 'index']);
        Route::get('/tickets/{id}', [TicketController::class, 'show']);
        Route::post('/tickets', [TicketController::class, 'store']);
        Route::post('/tickets/{id}/comments', [TicketController::class, 'addComment']);
        Route::get('/tickets/{id}/comments', [TicketController::class, 'listComments']);
        Route::post('/tickets/{id}/photos', [TicketController::class, 'uploadPhoto']);
        Route::get('/tickets/{id}/photos', [TicketController::class, 'listPhotos']);
        Route::delete('/tickets/{id}/photos/{photoId}', [TicketController::class, 'deletePhoto']);

        Route::post('/tickets/{id}/reopen', [TicketController::class, 'reopenTicket']);
        Route::post('/tickets/{id}/cancel', [TicketController::class, 'cancelTicket']);
        Route::post('/tickets/{id}/schedule', [TicketController::class, 'scheduleTicket']);

        // Submissão de valor pelo técnico
        Route::post('/tickets/{id}/submit-budget', [TicketController::class, 'submitEstimatedBudget']);

        // Decisão de aprovação pelo Administrador
        Route::match(['post', 'patch', 'put'], '/tickets/{id}/budget', [AdminController::class, 'approveBudget']);
        Route::match(['post', 'patch', 'put'], '/admin/tickets/{id}/approve-budget', [AdminController::class, 'approveBudget']);
        Route::match(['post', 'patch', 'put'], '/admin/tickets/{id}/budget-decision', [AdminController::class, 'approveBudget']);
        Route::match(['post', 'patch', 'put'], '/admin/tickets/{id}/budget', [AdminController::class, 'approveBudget']);

        Route::post('/tickets/{id}/close', [TicketController::class, 'closeTicketFinal']);

        // Calendário Operacional
        Route::get('/calendar/events', [TicketController::class, 'calendarEvents']);
        Route::get('/calendar', [TicketController::class, 'calendarView']);

        /*
        |--------------------------------------------------------------------------
        | Área Exclusiva do Técnico de Manutenção (Apenas Technicians)
        |--------------------------------------------------------------------------
        */
        Route::middleware(['role:technician'])->group(function () {
            Route::get('/ui/my-tickets', function () {
                return view('ui.my-tickets');
            })->name('ui.my-tickets');
        });

        /*
        |--------------------------------------------------------------------------
        | Área Exclusiva do Técnico de Manutenção e Administradores
        |--------------------------------------------------------------------------
        */
        Route::middleware(['role:technician,admin'])->group(function () {
            Route::match(['put', 'post'], '/technician/tickets/{id}/start', [TicketController::class, 'startTicket']);
            Route::match(['put', 'post'], '/technician/tickets/{id}/close', [TicketController::class, 'closeTicket']);
            Route::match(['put', 'post'], '/technician/tickets/{id}/request-budget', [TicketController::class, 'requestBudget']);
        });

        /*
        |--------------------------------------------------------------------------
        | Área Partilhada / Operacional de Administração
        |--------------------------------------------------------------------------
        */
        Route::middleware(['role:admin'])->group(function () {
            Route::get('/ui/users', [UiController::class, 'users']);
            Route::get('/ui/audits', [UiController::class, 'audits']);
            Route::get('/technician/tickets/open', [TicketController::class, 'openTickets']);
            Route::match(['post', 'patch'], '/admin/tickets/{id}/assign', [TicketController::class, 'assignTechnician']);
            Route::post('/tickets/{id}/assign-technician', [TicketController::class, 'assignTechnician']);
        });

        /*
        |--------------------------------------------------------------------------
        | Área de Administração e Backoffice (Sem Swagger)
        |--------------------------------------------------------------------------
        */
        Route::middleware(['role:admin'])->group(function () {
            Route::get('/analytics', [AnalyticsController::class, 'stats']);
            Route::get('/analytics/charts', [AnalyticsController::class, 'charts']);
            Route::get('/analytics/export/csv', [AnalyticsController::class, 'exportCsv']);
            Route::get('/analytics/export/pdf', [AnalyticsController::class, 'exportPdf']);
            Route::get('/analytics/export/excel', [AnalyticsController::class, 'exportExcel']);
            Route::get('/ui/analytics', [UiController::class, 'analytics']);
            Route::get('/ui/reports', [UiController::class, 'analytics']);
            Route::get('/reports', [UiController::class, 'analytics']);

            Route::post('/admin/users/register', [AuthController::class, 'register'])
                ->name('admin.users.register')
                ->middleware(['rate.limit:5,1']);

            Route::get('/admin/tickets/{id}', [TicketController::class, 'show'])->name('admin.tickets.show');
            Route::patch('/admin/tickets/{id}/atribuir', [TicketController::class, 'atribuirTecnico'])->name('admin.tickets.atribuir');

            Route::get('/admin/audits', [AuditController::class, 'index']);

            Route::get('/admin/users', [AdminController::class, 'users']);
            Route::post('/admin/users', [AdminController::class, 'storeUser']);
            Route::match(['post', 'patch', 'put'], '/admin/users/{id}', [AdminController::class, 'updateUser']);
            Route::patch('/admin/users/{id}/inactive', [AdminController::class, 'inactivateUser']);
            Route::get('/admin/profiles', [AdminController::class, 'profiles']);

            Route::get('/ui/users/create', [UiController::class, 'userCreate']);
            Route::get('/ui/users/{id}/edit', [UiController::class, 'userEdit']);

            Route::get('/admin/equipment', [AdminController::class, 'equipments']);
            Route::post('/admin/equipment', [AdminController::class, 'storeEquipment']);
            Route::patch('/admin/equipment/{id}', [AdminController::class, 'updateEquipment']);
            Route::delete('/admin/equipment/{id}', [AdminController::class, 'destroyEquipment']);

            Route::get('/ui/rooms/create', [UiController::class, 'roomCreate']);
            Route::get('/ui/rooms/{id}/edit', [UiController::class, 'roomEdit']);

            Route::post('/admin/preventive', [AdminController::class, 'storePreventive']);

            Route::get('/admin/rooms', [RoomController::class, 'indexRoom']);
            Route::post('/admin/rooms', [RoomController::class, 'storeRoom']);
            Route::patch('/admin/rooms/{id}', [RoomController::class, 'updateRoom']);
            Route::patch('/admin/rooms/{id}/inactive', [RoomController::class, 'inactivateRoom']);

            Route::post('/admin/tickets/{id}/override-priority-assignment', [AdminController::class, 'overridePriorityAndAssignment']);

            // Orçamentos
            Route::get('/ui/budgets', [AdminController::class, 'budgetsView'])->name('ui.budgets');
            Route::get('/admin/budgets/data', [AdminController::class, 'budgetsList']);
            Route::post('/admin/tickets/{id}/budget-decision', [AdminController::class, 'approveBudget']);
        });

        /*
        |--------------------------------------------------------------------------
        | Área Técnica de Engenharia / API (Exclusiva para Developer / Integrador)
        |--------------------------------------------------------------------------
        */
        Route::middleware(['role:developer,programador,integrador,dev'])->group(function () {
            
            Route::get('/docs/openapi', function () {
                $doc = 'default';
                $url = url('/docs/openapi.json');

                if (view()->exists('vendor.l5-swagger.index')) {
                    return view('vendor.l5-swagger.index', [
                        'documentation'       => $doc,
                        'documentationTitle'  => 'API Documentation - Swagger UI',
                        'urlToDocs'           => $url,
                        'urlsToDocs'          => [$doc => $url],
                        'operationsSorter'    => 'alpha',
                        'configUrl'           => null,
                        'validatorUrl'        => null,
                        'useAbsolutePath'     => true,
                    ]);
                }

                // Fallback seguro via Swagger UI Oficial em CDN
                return response()->make(<<<'HTML'
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>API Documentation - Swagger UI</title>
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/swagger-ui-dist@5/swagger-ui.css">
    <style>
        html { box-sizing: border-box; overflow-y: scroll; }
        *, *:before, *:after { box-sizing: inherit; }
        body { margin:0; background: #0f172a; }
        .topbar { display: none; }
        .swagger-ui .info .title { color: #f97316 !important; }
    </style>
</head>
<body>
    <div id="swagger-ui"></div>
    <script src="https://unpkg.com/swagger-ui-dist@5/swagger-ui-bundle.js"></script>
    <script src="https://unpkg.com/swagger-ui-dist@5/swagger-ui-standalone-preset.js"></script>
    <script>
    window.onload = function() {
        window.ui = SwaggerUIBundle({
            url: "/docs/openapi.json",
            dom_id: '#swagger-ui',
            deepLinking: true,
            presets: [
                SwaggerUIBundle.presets.apis,
                SwaggerUIStandalonePreset
            ],
            layout: "StandaloneLayout"
        });
    };
    </script>
</body>
</html>
HTML
                , 200, ['Content-Type' => 'text/html']);
            })->name('docs.openapi');

            // Serve a especificação OpenAPI em formato JSON
            Route::get('/docs/openapi.json', function () {
                $candidates = [
                    storage_path('api-docs/api-docs.json'),
                    public_path('docs/api-docs.json'),
                    public_path('swagger.json'),
                    base_path('openapi.json'),
                ];

                foreach ($candidates as $file) {
                    if (File::exists($file)) {
                        return response()->file($file, ['Content-Type' => 'application/json']);
                    }
                }

                return response()->json([
                    'openapi' => '3.0.0',
                    'info' => [
                        'title' => 'Gestão de Avarias - API',
                        'version' => '1.0.0',
                        'description' => 'Documentação técnica dos endpoints.'
                    ],
                    'paths' => new \stdClass()
                ]);
            });
        });

    });

    // Rota de Agendamento Preventivo
    Route::post('/admin/maintenance/schedule', [AdminController::class, 'scheduleMaintenance']);

    // Rota para todos os utilizadores autenticados
    Route::get('/ui/roadmap', function () {
        return view('ui.roadmap');
    })->name('ui.roadmap');

});