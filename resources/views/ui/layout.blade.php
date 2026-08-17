<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="{{ \App\Services\LocaleService::isRtl(app()->getLocale()) ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', __('common.Gestão de Avarias'))</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet">

    @vite('resources/js/early-theme.js')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ route('theme.custom') }}?v={{ \App\Http\Controllers\ThemeController::cacheBuster() }}">

    @include('ui.partials.theme-meta')

    @include('ui.partials.locale-config')

    @stack('styles')
</head>

<body data-page="@yield('page_key')"
      data-login-url="{{ route('ui.login') }}"
      data-auth-profile="{{ __('auth_box.profile') }}"
      data-auth-logout="{{ __('auth_box.logout') }}"
      data-auth-signin="{{ __('auth_box.signin') }}"
      data-auth-login-register="{{ __('auth_box.login_register') }}"
      data-room-equipment-count="{{ __('room.equipment_count') }}"
      data-room-edit="{{ __('room.edit') }}"
      data-room-details="{{ __('room.details') }}"
      data-room-empty="{{ __('room.empty') }}"
      data-stock-part-min="{{ __('stock_part.min') }}"
      data-stock-part-out="{{ __('stock_part.out') }}"
      data-stock-part-low="{{ __('stock_part.low') }}"
      data-stock-part-ok="{{ __('stock_part.ok') }}"
      data-stock-part-details="{{ __('stock_part.details') }}"
      data-stock-part-edit="{{ __('stock_part.edit') }}"
      data-stock-part-empty="{{ __('stock_part.empty') }}"
      data-pagination-previous="{{ __('pagination.previous') }}"
      data-pagination-next="{{ __('pagination.next') }}"
      data-pagination-page="{{ __('pagination.page') }}"
      data-pagination-of="{{ __('pagination.of') }}"
      data-plan-days="{{ __('maintenance_plan.days') }}"
      data-plan-usage-hours="{{ __('maintenance_plan.usage_hours') }}"
      data-plan-cycles="{{ __('maintenance_plan.cycles') }}"
      data-plan-active="{{ __('maintenance_plan.active') }}"
      data-plan-inactive="{{ __('maintenance_plan.inactive') }}"
      data-plan-parts="{{ __('maintenance_plan.parts') }}"
      data-plan-edit="{{ __('maintenance_plan.edit') }}"
      data-plan-delete="{{ __('maintenance_plan.delete') }}"
      data-plan-empty="{{ __('maintenance_plan.empty') }}"
      data-stock-dashboard-in-stock="{{ __('stock_dashboard.in_stock') }}"
      data-stock-dashboard-month="{{ __('stock_dashboard.month') }}"
      data-stock-dashboard-months="{{ __('stock_dashboard.months') }}"
      data-stock-dashboard-consumption="{{ __('stock_dashboard.consumption') }}"
      data-audit-all-events="{{ __('common.Todas as Ações') }}"
      data-audit-created="{{ __('auth.Registo Criado') }}"
      data-audit-updated="{{ __('auth.Registo Atualizado') }}"
      data-audit-deleted="{{ __('auth.Registo Eliminado') }}"
      data-analytics-resolution="{{ __('analytics.resolution') }}"
      data-analytics-waiting="{{ __('analytics.waiting') }}"
      data-analytics-open="{{ __('analytics.open') }}"
      data-analytics-resolved="{{ __('analytics.resolved') }}"
      data-analytics-mttr="{{ __('analytics.mttr') }}"
      data-analytics-assignment="{{ __('analytics.assignment') }}"
      data-analytics-active="{{ __('analytics.active') }}"
      data-analytics-completed="{{ __('analytics.completed') }}"
      data-analytics-minute="{{ __('analytics.minute') }}"
      data-analytics-minutes="{{ __('analytics.minutes') }}"
      data-analytics-hour="{{ __('analytics.hour') }}"
      data-analytics-hours="{{ __('analytics.hours') }}"
      data-analytics-day="{{ __('analytics.day') }}"
      data-analytics-days="{{ __('analytics.days') }}"
      data-analytics-tickets="{{ __('tickets.Tickets') }}"
      data-analytics-data-urgent="{{ __('analytics_data.urgent') }}"
      data-analytics-data-normal="{{ __('analytics_data.normal') }}"
      data-analytics-data-web="{{ __('analytics_data.web') }}"
      data-analytics-data-qr="{{ __('analytics_data.qr') }}"
      data-analytics-data-api="{{ __('analytics_data.api') }}"
      data-analytics-data-mobile="{{ __('analytics_data.mobile') }}"
      data-analytics-data-phone="{{ __('analytics_data.phone') }}"
      data-analytics-data-ticket-updated="{{ __('analytics_data.ticket_updated') }}"
      data-analytics-data-ticket-assigned="{{ __('analytics_data.ticket_assigned') }}"
      data-analytics-data-comment-added="{{ __('analytics_data.comment_added') }}"
      data-analytics-data-attachment-added="{{ __('analytics_data.attachment_added') }}"
      data-analytics-data-budget-request="{{ __('analytics_data.budget_request') }}"
      class="app-shell ui-shell{{ \App\Services\LocaleService::isRtl(app()->getLocale()) ? ' rtl' : '' }}">

    @php
        $userRole = $user?->profile?->name ?? null;

        // Menu lateral: apenas Admin vê Utilizadores/Auditoria/Analytics/Swagger
        $navItems = [
            ['href' => 'ui', 'active' => 'ui', 'label' => __('dashboard.Dashboard'), 'icon' => '📊', 'exact' => true],
            ['href' => 'ui/tickets', 'active' => 'ui/tickets*', 'label' => __('tickets.Tickets'), 'icon' => '🎫', 'exact' => false],
            [
                'href' => 'ui/equipments',
                'active' => 'ui/equipments*',
                'label' => __('equipment.Equipamentos'),
                'icon' => '🖥️',
                'exact' => false,
            ],
            ['href' => 'ui/rooms', 'active' => 'ui/rooms*', 'label' => __('room.Salas'), 'icon' => '🚪', 'exact' => false],
            ['href' => 'calendar', 'active' => 'calendar*', 'label' => __('common.Agenda'), 'icon' => '📅', 'exact' => false],
            ['href' => 'ui/stock', 'active' => 'ui/stock*', 'label' => __('stock.Stock'), 'icon' => '📦', 'exact' => false],
        ];

        if ($userRole === 'admin') {
            $navItems = array_merge($navItems, [
                [
                    'href' => 'ui/users',
                    'active' => 'ui/users*',
                    'label' => __('common.Utilizadores'),
                    'icon' => '👥',
                    'exact' => false,
                ],
                ['href' => 'ui/audits', 'active' => 'ui/audits*', 'label' => __('common.Auditoria'), 'icon' => '📝', 'exact' => false],
                [
                    'href' => 'ui/analytics',
                    'active' => 'ui/analytics*',
                    'label' => __('common.Analytics'),
                    'icon' => '📈',
                    'exact' => false,
                ],
                [
                    'href' => 'ui/definicoes/aparencia',
                    'active' => 'ui/definicoes/aparencia*',
                    'label' => __('ui.Tema'),
                    'icon' => '🎨',
                    'exact' => false,
                ],
                [
                    'href' => 'ui/definicoes/sistema',
                    'active' => 'ui/definicoes/sistema*',
                    'label' => __('common.Definições'),
                    'icon' => '⚙️',
                    'exact' => false,
                ],
                [
                    'href' => 'docs/openapi',
                    'active' => 'docs/openapi*',
                    'label' => __('common.Swagger'),
                    'icon' => '📚',
                    'exact' => false,
                ],
            ]);
        }
    @endphp


    <a href="#main-content" class="skip-link">
        {{ __('common.Ir para o conteúdo') }}
    </a>

    {{-- Efeitos de Gradiente e Brilho de Fundo (Glow Blobs) --}}
    <div class="fixed inset-0 -z-50 pointer-events-none">
        @include('ui.partials.background-effects')
    </div>

    @include('ui.partials.mobile-nav', ['navItems' => $navItems])

    <div class="page-wrapper">
        @include('ui.partials.desktop-sidebar', ['navItems' => $navItems])

        {{-- Área de Conteúdo Principal --}}
        <div id="mainWrapper" class="flex-1 transition-all duration-300">
            @include('ui.partials.topbar')

            {{-- Viewport Injetada --}}
            <main id="main-content" role="main" tabindex="-1" class="page-content outline-none">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts-top')
    @stack('scripts')

    @include('ui.partials.locale-modal')
    @include('ui.partials.localization-modal')
</body>

</html>
