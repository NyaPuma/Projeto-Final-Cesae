<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        (function () {
            try {
                var theme = localStorage.getItem('theme');
                var isDark = theme === 'dark' || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches);
                var root = document.documentElement;
                root.classList.toggle('dark', isDark);
                if (isDark) { root.setAttribute('data-theme', 'dark'); } else { root.removeAttribute('data-theme'); }
            } catch (e) {}
        })();
    </script>

    <title>{{ __('Gestão de Avarias') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body data-page="@yield('page_key')" data-login-url="{{ route('ui.login') }}" class="min-h-screen overflow-x-hidden bg-[var(--bg)] text-[var(--text)] antialiased">

    @php
        $userRole = $user->profile->name ?? null;

        // Menu lateral: apenas Admin vê Utilizadores/Auditoria/Analytics/Swagger
        $navItems = [
            ['href' => 'ui', 'active' => 'ui', 'label' => 'Dashboard', 'icon' => '📊', 'exact' => true],
            ['href' => 'ui/tickets', 'active' => 'ui/tickets*', 'label' => 'Tickets', 'icon' => '🎫', 'exact' => false],
            [
                'href' => 'ui/equipments',
                'active' => 'ui/equipments*',
                'label' => 'Equipamentos',
                'icon' => '🖥️',
                'exact' => false,
            ],
            ['href' => 'ui/rooms', 'active' => 'ui/rooms*', 'label' => 'Salas', 'icon' => '🚪', 'exact' => false],
            ['href' => 'calendar', 'active' => 'calendar*', 'label' => 'Agenda', 'icon' => '📅', 'exact' => false],
        ];

        if ($userRole === 'admin') {
            $navItems = array_merge($navItems, [
                [
                    'href' => 'ui/users',
                    'active' => 'ui/users*',
                    'label' => 'Utilizadores',
                    'icon' => '👥',
                    'exact' => false,
                ],
                ['href' => 'ui/audits', 'active' => 'ui/audits*', 'label' => 'Auditoria', 'icon' => '📝', 'exact' => false],
                [
                    'href' => 'ui/analytics',
                    'active' => 'ui/analytics*',
                    'label' => 'Analytics',
                    'icon' => '📈',
                    'exact' => false,
                ],
                [
                    'href' => 'docs/openapi',
                    'active' => 'docs/openapi*',
                    'label' => 'Swagger',
                    'icon' => '📚',
                    'exact' => false,
                ],
            ]);
        }
    @endphp


    <a href="#main-content"
        class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-50 focus:rounded-xl focus:bg-primary focus:px-4 focus:py-2 focus:text-sm focus:font-semibold focus:text-[var(--on-primary)]">
        {{ __('Ir para o conteúdo') }}
    </a>

    {{-- Efeitos de Gradiente e Brilho de Fundo (Glow Blobs) --}}
    <div class="fixed inset-0 -z-50 pointer-events-none">
        @include('ui.partials.background-effects')
    </div>

    @include('ui.partials.mobile-nav', ['navItems' => $navItems])

    <div class="min-h-screen flex">
        @include('ui.partials.desktop-sidebar', ['navItems' => $navItems])

        {{-- Botão Hamburger para Mobile --}}
        <div class="lg:hidden fixed top-[18px] left-8 z-30">
            <x-ui.buttons.icon-button type="button" data-action="toggle-mobile-nav" variant="primary" size="md" class="shadow-md shadow-primary/20" aria-label="{{ __('Abrir menu') }}" id="mobileMenuBtn">
                ☰
            </x-ui.buttons.icon-button>
        </div>

        {{-- Área de Conteúdo Principal --}}
        <div id="mainWrapper" class="flex-1 flex flex-col min-w-0 lg:ml-72 transition-all duration-300">
            @include('ui.partials.topbar')

            {{-- Viewport Injetada --}}
            <main id="main-content" role="main" tabindex="-1"
                class="flex-1 px-8 py-8 max-w-7xl w-full mx-auto outline-none">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts-top')
    @stack('scripts')
</body>

</html>
