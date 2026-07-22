<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('Gestão de Avarias') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')

    <style>
        /* Transições suaves para a barra lateral em Desktop */
        #desktopSidebar.collapsed {
            width: 5rem !important;
            /* w-20 */
        }

        #desktopSidebar.collapsed .sidebar-text {
            display: none !important;
        }

        #desktopSidebar.collapsed nav {
            padding-left: 0.5rem !important;
            padding-right: 0.5rem !important;
        }

        #desktopSidebar.collapsed nav a {
            justify-content: center !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
            gap: 0 !important;
        }

        #desktopSidebar.collapsed #desktopBranding {
            padding-left: 1rem !important;
            padding-right: 1rem !important;
            justify-content: center !important;
        }

        #desktopSidebar.collapsed #authBoxContainer {
            display: none !important;
        }

        /* Prevenção de flashes visuais durante o carregamento inicial */
        .pre-collapsed #desktopSidebar {
            width: 5rem !important;
        }

        .pre-collapsed #desktopSidebar .sidebar-text,
        .pre-collapsed #desktopSidebar #authBoxContainer {
            display: none !important;
        }

        .pre-collapsed #desktopSidebar nav {
            padding-left: 0.5rem !important;
            padding-right: 0.5rem !important;
        }

        .pre-collapsed #desktopSidebar nav a {
            justify-content: center !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
            gap: 0 !important;
        }

        .pre-collapsed #desktopSidebar #desktopBranding {
            padding-left: 1rem !important;
            padding-right: 1rem !important;
            justify-content: center !important;
        }
    </style>

    <script>
        // Inicialização imediata do tema e estado do menu para evitar quebras visuais (FOUC)
        (() => {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark' || (!savedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
                document.documentElement.setAttribute('data-theme', 'dark');
            } else {
                document.documentElement.classList.remove('dark');
                document.documentElement.removeAttribute('data-theme');
            }

            const collapsed = localStorage.getItem('sidebar_collapsed') === 'true';
            if (collapsed) {
                document.documentElement.classList.add('pre-collapsed');
            }
        })();
    </script>
</head>

<body class="min-h-screen bg-[var(--bg)] text-[var(--text)] overflow-x-hidden antialiased">

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
    <div class="fixed inset-0 -z-50 pointer-events-none" aria-hidden="true">
        <div class="absolute inset-0 bg-[var(--bg)]"></div>
        <div
            class="absolute -top-60 left-1/2 -translate-x-1/2 h-[900px] w-[900px] rounded-full bg-primary/10 blur-[180px]">
        </div>
        <div class="absolute bottom-0 right-0 h-[600px] w-[600px] rounded-full bg-blue-500/10 blur-[180px]"></div>
        <div class="absolute top-40 left-0 h-[450px] w-[450px] rounded-full bg-orange-500/10 blur-[140px]"></div>
    </div>

    {{-- Overlay Escuro para Mobile --}}
    <div id="mobileNavOverlay" class="fixed inset-0 bg-black/60 hidden opacity-0 transition-opacity duration-300 z-40"
        onclick="closeMobileNav()"></div>

    {{-- Drawer / Menu Lateral Móvel --}}
    <aside id="mobileNav"
        class="fixed inset-y-0 left-0 w-72 -translate-x-full transition-transform duration-300 ease-in-out bg-[var(--sidebar)] border-r border-[var(--border)] backdrop-blur-xl z-50 flex flex-col shadow-2xl lg:hidden">
        {{-- Branding Mobile --}}
        <div class="h-20 px-8 flex items-center border-b border-[var(--border)]">
            <div class="flex items-center gap-4">
                <button type="button" onclick="closeMobileNav()"
                    class="h-11 w-11 rounded-xl bg-primary text-[var(--on-primary)] font-black flex items-center justify-center shadow-md shadow-primary/20 cursor-pointer hover:opacity-90 transition-all flex-shrink-0"
                    aria-label="{{ __('Fechar menu') }}">
                    ☰
                </button>
            </div>
        </div>

        {{-- Links Mobile --}}
        <nav class="flex-1 overflow-y-auto px-4 py-6 space-y-1" aria-label="{{ __('Navegação principal mobile') }}">
            @foreach ($navItems as $item)
                @php
                    $isActive = request()->is($item['active']);
                @endphp

                <a href="{{ url($item['href'] === '/' ? '/' : $item['href']) }}" onclick="closeMobileNav()"
                    class="group flex items-center gap-3.5 rounded-xl px-4 py-3 text-sm font-medium transition-all duration-200
                    {{ $isActive
                        ? 'bg-primary text-[var(--on-primary)] font-semibold shadow-sm shadow-primary/20'
                        : 'text-[var(--text)] hover:bg-[var(--surface-2)]' }}">
                    <span class="text-lg filter {{ $isActive ? 'none' : 'grayscale opacity-80' }}">
                        {{ $item['icon'] }}
                    </span>
                    <span>{{ __($item['label']) }}</span>
                </a>
            @endforeach
        </nav>

        {{-- Auth Box Mobile --}}
        <div class="border-t border-[var(--border)] p-4 bg-[var(--surface-2)]/50">
            <div id="authBoxMobile"></div>
        </div>
    </aside>

    <div class="min-h-screen flex">

        {{-- Sidebar Desktop --}}
        <aside id="desktopSidebar"
            class="hidden lg:flex fixed left-0 top-0 h-screen w-72 flex-col border-r border-[var(--border)] bg-[var(--sidebar)] backdrop-blur-xl transition-all duration-300 ease-in-out z-30">
            {{-- Branding Desktop --}}
            <div id="desktopBranding"
                class="h-20 px-8 flex items-center border-b border-[var(--border)] transition-all duration-300">
                <div class="flex items-center gap-4">
                    <button type="button" onclick="toggleDesktopSidebar()"
                        class="h-11 w-11 rounded-xl bg-primary text-[var(--on-primary)] font-black flex items-center justify-center shadow-md shadow-primary/20 cursor-pointer hover:opacity-90 transition-all flex-shrink-0"
                        aria-label="{{ __('Recolher menu') }}">
                        ☰
                    </button>
                </div>
            </div>

            {{-- Links de Navegação Desktop --}}
            <nav class="flex-1 overflow-y-auto px-4 py-6 space-y-1 transition-all duration-300"
                aria-label="{{ __('Navegação principal') }}">
                @foreach ($navItems as $item)
                    @php
                        $isActive = request()->is($item['active']);
                    @endphp

                    <a href="{{ url($item['href'] === '/' ? '/' : $item['href']) }}"
                        class="group flex items-center gap-3.5 rounded-xl px-4 py-3 text-sm font-medium transition-all duration-200
                        {{ $isActive
                            ? 'bg-primary text-[var(--on-primary)] font-semibold shadow-sm shadow-primary/20'
                            : 'text-[var(--text)] hover:bg-[var(--surface-2)]' }}">
                        <span class="text-lg filter {{ $isActive ? 'none' : 'grayscale opacity-80' }} flex-shrink-0">
                            {{ $item['icon'] }}
                        </span>
                        <span class="sidebar-text transition-all duration-300">{{ __($item['label']) }}</span>
                    </a>
                @endforeach
            </nav>

            {{-- Caixa de Autenticação Desktop --}}
            <div id="authBoxContainer"
                class="border-t border-[var(--border)] p-4 bg-[var(--surface-2)]/50 transition-all duration-300">
                <div id="authBox"></div>
            </div>
        </aside>

        {{-- Botão Hamburger para Mobile --}}
        <div class="lg:hidden fixed top-[18px] left-8 z-30">
            <button type="button" onclick="toggleMobileNav()"
                class="inline-flex h-11 w-11 items-center justify-center rounded-xl bg-primary text-[var(--on-primary)] shadow-md shadow-primary/20 transition-all hover:opacity-90 cursor-pointer text-base"
                aria-label="{{ __('Abrir menu') }}" id="mobileMenuBtn">
                ☰
            </button>
        </div>

        {{-- Área de Conteúdo Principal --}}
        <div id="mainWrapper" class="flex-1 flex flex-col min-w-0 lg:ml-72 transition-all duration-300">

            {{-- Topbar --}}
            <header class="sticky top-0 z-20 h-20 border-b border-[var(--border)] bg-[var(--topbar)] backdrop-blur-xl">
                <div class="h-full px-8 flex items-center justify-between">
                    {{-- Espaçador para manter o botão mobile livre sem sobrepor conteúdo --}}
                    <div class="pl-14 lg:pl-0"></div>

                    {{-- Ações de Perfil, Idioma e Tema --}}
                    <div class="flex items-center gap-3">
                        {{-- Language Selector Dropdown --}}
                        <div class="relative inline-block text-left" id="langSelectorDropdown">
                            <button type="button" onclick="toggleLangDropdown()"
                                class="inline-flex h-10 px-3 items-center justify-center gap-1.5 rounded-xl border border-[var(--border)] bg-[var(--surface)] text-sm text-[var(--text)] shadow-sm transition-all hover:bg-[var(--surface-2)] cursor-pointer"
                                aria-label="{{ __('Alterar Idioma') }}" aria-haspopup="true" aria-expanded="false"
                                id="langDropdownBtn">
                                🌐
                                <span
                                    class="font-semibold text-xs uppercase text-[var(--text)]">{{ app()->getLocale() }}</span>
                                <svg class="h-3.5 w-3.5 text-[var(--text-soft)]" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div id="langDropdown"
                                class="hidden absolute right-0 mt-2 w-36 rounded-xl border border-[var(--border)] bg-[var(--surface)] shadow-lg py-1.5 z-50 animate-[fadeIn_0.15s_ease-out]">
                                <a href="/lang/pt"
                                    class="flex items-center px-4 py-2.5 text-xs font-semibold text-[var(--text)] hover:bg-[var(--surface-2)] {{ app()->getLocale() === 'pt' ? 'bg-primary/10 text-primary' : '' }}">
                                    🇵🇹 Português
                                </a>
                                <a href="/lang/en"
                                    class="flex items-center px-4 py-2.5 text-xs font-semibold text-[var(--text)] hover:bg-[var(--surface-2)] {{ app()->getLocale() === 'en' ? 'bg-primary/10 text-primary' : '' }}">
                                    🇬🇧 English
                                </a>
                            </div>
                        </div>

                        {{-- 🔔 Notificações - Sino com contador --}}
                        <div class="relative" id="notificationBellContainer">
                            <button type="button" onclick="toggleNotifications()"
                                class="relative inline-flex h-10 w-10 items-center justify-center rounded-xl border border-[var(--border)] bg-[var(--surface)] text-sm shadow-sm transition-all hover:bg-[var(--surface-2)] cursor-pointer"
                                aria-label="{{ __('Notificações') }}" id="notificationBellBtn">
                                🔔
                                <span id="notificationBadge"
                                    class="hidden absolute -top-1 -right-1 inline-flex items-center justify-center h-4.5 min-w-[18px] px-1 rounded-full bg-rose-500 text-[9px] font-extrabold text-white shadow-sm shadow-rose-500/30 leading-none"
                                    style="font-size:9px;line-height:1">
                                    0
                                </span>
                            </button>
                            {{-- Dropdown de Notificações --}}
                            <div id="notificationDropdown"
                                class="hidden absolute right-0 mt-2 w-96 rounded-xl border border-[var(--border)] bg-[var(--surface)] shadow-2xl py-2 z-50 animate-[fadeIn_0.15s_ease-out] max-h-[420px] flex flex-col">
                                <div class="px-4 pb-2 border-b border-[var(--border)] flex items-center justify-between">
                                    <h4 class="text-xs font-bold uppercase tracking-wider text-[var(--text)]">{{ __('Notificações') }}</h4>
                                    <span id="notifCountLabel" class="text-[10px] text-[var(--text-soft)]">0 {{ __('por ler') }}</span>
                                </div>
                                <div id="notificationList" class="overflow-y-auto flex-1 py-1 space-y-0.5 px-1">
                                    <p class="text-xs text-[var(--text-soft)] text-center py-6 italic">{{ __('A carregar...') }}</p>
                                </div>
                                <div class="border-t border-[var(--border)] pt-2 px-4">
                                    <a href="/ui/tickets" class="text-[10px] font-bold uppercase tracking-wider text-primary hover:underline block text-center py-1">
                                        {{ __('Ver todos os tickets') }} →
                                    </a>
                                </div>
                            </div>
                        </div>

                        <button type="button" onclick="toggleTheme()"
                            class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-[var(--border)] bg-[var(--surface)] text-sm shadow-sm transition-all hover:bg-[var(--surface-2)] cursor-pointer"
                            aria-label="{{ __('Alternar Tema') }}">
                            🌙
                        </button>

                        <div class="h-8 w-px bg-[var(--border)]"></div>

                        <div id="topbarUser" class="flex items-center gap-3"></div>
                    </div>
                </div>
            </header>

            {{-- Viewport Injetada --}}
            <main id="main-content" role="main" tabindex="-1"
                class="flex-1 px-8 py-8 max-w-7xl w-full mx-auto outline-none">
                @yield('content')
            </main>
        </div>
    </div>

    {{-- Core Auth & Engine Scripts --}}
    <script>
        function authHeader() {
            const token = localStorage.getItem('api_token');
            const headers = {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            };

            if (token) {
                headers['X-Auth-Token'] = token;
            }
            return headers;
        }

        function isAuthenticated() {
            return !!localStorage.getItem('api_token');
        }

        function requireAuth() {
            if (!isAuthenticated()) {
                window.location = '/ui/login';
                return false;
            }
            return true;
        }

        // Toggle para recolher Sidebar em Desktop
        function toggleDesktopSidebar() {
            const sidebar = document.getElementById('desktopSidebar');
            const wrapper = document.getElementById('mainWrapper');

            if (!sidebar || !wrapper) return;

            const isCollapsed = sidebar.classList.toggle('collapsed');

            if (isCollapsed) {
                wrapper.classList.remove('lg:ml-72');
                wrapper.classList.add('lg:ml-20');
            } else {
                wrapper.classList.remove('lg:ml-20');
                wrapper.classList.add('lg:ml-72');
            }

            localStorage.setItem('sidebar_collapsed', isCollapsed ? 'true' : 'false');
        }

        // Gestão dinâmica da navegação móvel via classes Tailwind
        function toggleMobileNav() {
            const overlay = document.getElementById('mobileNavOverlay');
            const drawer = document.getElementById('mobileNav');

            if (!overlay || !drawer) return;

            const isOpen = drawer.classList.contains('translate-x-0');

            if (isOpen) {
                closeMobileNav();
            } else {
                overlay.classList.remove('hidden');
                void overlay.offsetWidth; // Força reflow para animação perfeita
                overlay.classList.remove('opacity-0');
                overlay.classList.add('opacity-100');

                drawer.classList.remove('-translate-x-full');
                drawer.classList.add('translate-x-0');
            }
        }

        function closeMobileNav() {
            const overlay = document.getElementById('mobileNavOverlay');
            const drawer = document.getElementById('mobileNav');

            if (!overlay || !drawer) return;

            overlay.classList.remove('opacity-100');
            overlay.classList.add('opacity-0');

            drawer.classList.remove('translate-x-0');
            drawer.classList.add('-translate-x-full');

            setTimeout(() => {
                if (!drawer.classList.contains('translate-x-0')) {
                    overlay.classList.add('hidden');
                }
            }, 300);
        }

        function toggleLangDropdown() {
            const dropdown = document.getElementById('langDropdown');
            const btn = document.getElementById('langDropdownBtn');
            if (!dropdown) return;
            const isHidden = dropdown.classList.contains('hidden');
            if (isHidden) {
                dropdown.classList.remove('hidden');
                btn.setAttribute('aria-expanded', 'true');
            } else {
                dropdown.classList.add('hidden');
                btn.setAttribute('aria-expanded', 'false');
            }
        }

        // Fechar dropdowns ao clicar fora
        document.addEventListener('click', (e) => {
            const dropdown = document.getElementById('langDropdown');
            const container = document.getElementById('langSelectorDropdown');
            if (dropdown && container && !container.contains(e.target)) {
                dropdown.classList.add('hidden');
                document.getElementById('langDropdownBtn')?.setAttribute('aria-expanded', 'false');
            }
        });

        function renderAuthBox() {
            const box = document.getElementById('authBox');
            const boxMobile = document.getElementById('authBoxMobile');
            const topbarUser = document.getElementById('topbarUser');

            if (!box && !boxMobile && !topbarUser) return;

            const token = localStorage.getItem('api_token');
            if (token) {
                const userName = localStorage.getItem('user_name') || 'Utilizador';
                const userRole = localStorage.getItem('user_role') || 'Utilizador';

                if (box) {
                    box.innerHTML = `
                    <div class="space-y-2">
                        <a href="/ui/profile" class="w-full inline-flex items-center justify-center rounded-xl bg-primary px-4 py-2.5 text-xs font-bold text-[var(--on-primary)] shadow-sm shadow-primary/20 hover:bg-[var(--primary-hover)] transition-all duration-200 text-center">
                            {{ __('Ver Perfil') }}
                        </a>
                        <button
                            onclick="logout()"
                            class="w-full inline-flex items-center justify-center rounded-xl bg-[var(--border)] hover:bg-red-500/10 hover:text-red-600 dark:hover:text-red-400 px-4 py-2.5 text-xs font-semibold text-[var(--text)] border border-transparent hover:border-red-500/20 transition-all duration-200 cursor-pointer"
                        >
                            {{ __('Terminar Sessão') }}
                        </button>
                    </div>
                `;
                }

                if (boxMobile) {
                    boxMobile.innerHTML = `
                    <div class="space-y-2">
                        <a href="/ui/profile" class="w-full inline-flex items-center justify-center rounded-xl bg-primary px-4 py-2.5 text-xs font-bold text-[var(--on-primary)] shadow-sm shadow-primary/20 hover:bg-[var(--primary-hover)] transition-all duration-200 text-center">
                            {{ __('Ver Perfil') }}
                        </a>
                        <button
                            onclick="logout()"
                            class="w-full inline-flex items-center justify-center rounded-xl bg-[var(--border)] hover:bg-red-500/10 hover:text-red-600 dark:hover:text-red-400 px-4 py-2.5 text-xs font-semibold text-[var(--text)] border border-transparent hover:border-red-500/20 transition-all duration-200 cursor-pointer"
                        >
                            {{ __('Terminar Sessão') }}
                        </button>
                    </div>
                `;
                }

                if (topbarUser) {
                    topbarUser.innerHTML = `
                    <a href="/ui/profile" class="flex items-center gap-3 rounded-xl border border-[var(--border)] bg-[var(--surface)] px-3 py-2 transition hover:bg-[var(--surface-2)]">
                        <div class="flex h-9 w-9 items-center justify-center rounded-full bg-primary font-bold text-xs text-[var(--on-primary)] shadow-sm">
                            ${userName.charAt(0).toUpperCase()}
                        </div>
                        <div class="hidden md:block">
                            <div class="text-sm font-semibold text-[var(--text)] leading-none">${userName}</div>
                            <div class="mt-1.5 text-[9px] font-bold uppercase tracking-wider text-[var(--text-soft)]">${userRole}</div>
                        </div>
                    </a>
                `;
                }
            } else {
                if (box) {
                    box.innerHTML = `
                    <a
                        href="/ui/login"
                        class="w-full inline-flex items-center justify-center rounded-xl bg-primary px-4 py-2.5 text-xs font-bold text-[var(--on-primary)] shadow-sm shadow-primary/10 transition-all duration-200 hover:opacity-90 text-center"
                    >
                        {{ __('Iniciar Sessão') }}
                    </a>
                `;
                }

                if (boxMobile) {
                    boxMobile.innerHTML = `
                    <a
                        href="/ui/login"
                        class="w-full inline-flex items-center justify-center rounded-xl bg-primary px-4 py-2.5 text-xs font-bold text-[var(--on-primary)] shadow-sm shadow-primary/10 transition-all duration-200 hover:opacity-90 text-center"
                    >
                        {{ __('Iniciar Sessão') }}
                    </a>
                `;
                }

                if (topbarUser) {
                    topbarUser.innerHTML = `
                    <a href="/ui/login" class="inline-flex items-center justify-center rounded-xl bg-primary px-4 py-2.5 text-xs font-bold text-[var(--on-primary)] shadow-sm shadow-primary/10 transition-all duration-200 hover:opacity-90">
                        {{ __('Login / Registo') }}
                    </a>
                `;
                }
            }
        }

        function logout() {
            const token = localStorage.getItem('api_token');
            if (!token) return;

            fetch('/logout', {
                    method: 'POST',
                    headers: Object.assign({
                        'Content-Type': 'application/json'
                    }, authHeader())
                })
                .finally(() => {
                    localStorage.removeItem('api_token');
                    localStorage.removeItem('user_name');
                    localStorage.removeItem('user_role');
                    document.cookie = 'api_token=; path=/; max-age=0; SameSite=Lax';
                    window.location = '/ui/login';
                });
        }

        function toggleTheme() {
            const html = document.documentElement;
            const dark = html.classList.toggle('dark');
            localStorage.setItem('theme', dark ? 'dark' : 'light');
            if (dark) {
                html.setAttribute('data-theme', 'dark');
            } else {
                html.removeAttribute('data-theme');
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.getElementById('desktopSidebar');
            const wrapper = document.getElementById('mainWrapper');

            const collapsed = localStorage.getItem('sidebar_collapsed') === 'true';

            if (sidebar && collapsed) {
                sidebar.classList.add('collapsed');
            }

            if (wrapper) {
                wrapper.classList.toggle('lg:ml-72', !collapsed);
                wrapper.classList.toggle('lg:ml-20', collapsed);
            }

            document.documentElement.classList.remove('pre-collapsed');

            if (typeof requireAuthOnLoad !== 'undefined' && requireAuthOnLoad) {
                requireAuth();
            }

            renderAuthBox();
        });
    </script>

    {{-- 🔔 Notificações - Lógica JS --}}
    <script>
        // Estado das notificações
        let notificationCount = 0;
        let notificationsVisible = false;
        let notifPollInterval = null;

        function toggleNotifications() {
            const dropdown = document.getElementById('notificationDropdown');
            if (!dropdown) return;
            notificationsVisible = !notificationsVisible;
            dropdown.classList.toggle('hidden', !notificationsVisible);
            if (notificationsVisible) {
                fetchNotifications();
            }
        }

        async function fetchNotifications() {
            const list = document.getElementById('notificationList');
            const badge = document.getElementById('notificationBadge');
            const countLabel = document.getElementById('notifCountLabel');
            if (!list) return;

            try {
                const res = await fetch('/notifications', { headers: authHeader() });
                if (!res.ok) throw new Error('Failed');

                const data = await res.json();
                const notifications = data.notifications || data.data || data || [];

                // Se não houver notificações
                if (!notifications.length || notifications.length === 0) {
                    list.innerHTML = `
                        <p class="text-xs text-[var(--text-soft)] text-center py-6 italic">
                            🔕 {{ __('Sem notificações') }}
                        </p>
                    `;
                    if (badge) badge.classList.add('hidden');
                    if (countLabel) countLabel.innerText = '0 {{ __('por ler') }}';
                    notificationCount = 0;
                    return;
                }

                // Contar não lidas
                const unreadCount = notifications.filter(n => !n.is_read && !n.read_at).length;
                notificationCount = unreadCount;

                // Atualizar badge
                if (badge) {
                    if (unreadCount > 0) {
                        badge.innerText = unreadCount > 99 ? '99+' : unreadCount;
                        badge.classList.remove('hidden');
                    } else {
                        badge.classList.add('hidden');
                    }
                }
                if (countLabel) {
                    countLabel.innerText = unreadCount + ' {{ __('por ler') }}';
                }

                // Renderizar lista (mostrar últimas 20)
                const items = notifications.slice(0, 20);
                list.innerHTML = items.map(n => {
                    const isUnread = !n.is_read && !n.read_at;
                    const icon = n.type?.includes('approved') ? '✅' :
                                n.type?.includes('rejected') ? '❌' :
                                n.type?.includes('budget_request') ? '💰' :
                                n.type?.includes('auto_approved') ? '🟢' :
                                n.type?.includes('closed') ? '🔧' :
                                n.type?.includes('budget_submitted') ? '📋' :
                                n.type?.includes('priority_override') ? '⚠️' : '📌';
                    return `
                        <div class="flex items-start gap-3 px-3 py-2.5 rounded-xl hover:bg-[var(--surface-2)] transition-all ${isUnread ? 'bg-primary/5 border-l-2 border-primary' : ''} ${n.link ? 'cursor-pointer' : ''}" onclick="${n.link ? `window.location='${n.link}'; markNotifRead(${n.id})` : ''}">
                            <span class="text-base flex-shrink-0 mt-0.5">${icon}</span>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-bold text-[var(--text)] leading-tight ${isUnread ? '' : 'opacity-70'}">${n.title || ''}</p>
                                <p class="text-[10px] text-[var(--text-soft)] mt-0.5 line-clamp-2">${n.message || n.description || ''}</p>
                                <p class="text-[9px] text-[var(--text-soft)] mt-1 opacity-50">${n.created_at ? new Date(n.created_at).toLocaleDateString('pt-PT', { day: 'numeric', month: 'short', hour: '2-digit', minute: '2-digit' }) : ''}</p>
                            </div>
                            ${isUnread ? '<span class="w-2 h-2 rounded-full bg-primary flex-shrink-0 mt-1.5"></span>' : ''}
                        </div>
                    `;
                }).join('') + (notifications.length > 20 ? `
                    <div class="text-center pt-2">
                        <span class="text-[9px] text-[var(--text-soft)] font-medium">+${notifications.length - 20} {{ __('mais') }}</span>
                    </div>
                ` : '');
            } catch (e) {
                console.warn('Erro ao carregar notificações:', e);
                if (list) {
                    list.innerHTML = `
                        <p class="text-xs text-[var(--text-soft)] text-center py-6 italic">⚠️ {{ __('Erro ao carregar') }}</p>
                    `;
                }
            }
        }

        async function markNotifRead(id) {
            try {
                await fetch('/notifications/' + id, {
                    method: 'PATCH',
                    headers: authHeader()
                });
                fetchNotifications();
            } catch (e) {}
        }

        // Polling automático a cada 30 segundos se autenticado
        function startNotificationPolling() {
            if (notifPollInterval) clearInterval(notifPollInterval);
            // Buscar imediatamente
            if (isAuthenticated()) {
                fetchNotifications();
            }
            // Repetir a cada 30s
            notifPollInterval = setInterval(() => {
                if (isAuthenticated()) {
                    fetchNotifications();
                }
            }, 30000);
        }

        // Fechar dropdown ao clicar fora
        document.addEventListener('click', (e) => {
            const container = document.getElementById('notificationBellContainer');
            const dropdown = document.getElementById('notificationDropdown');
            if (container && dropdown && !container.contains(e.target) && !dropdown.classList.contains('hidden')) {
                dropdown.classList.add('hidden');
                notificationsVisible = false;
            }
        });

        // Iniciar polling após DOM carregado
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(startNotificationPolling, 500);
        });
    </script>

    @stack('scripts-top')
    @stack('scripts')
</body>

</html>
