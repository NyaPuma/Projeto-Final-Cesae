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
</head>

<body class="min-h-screen bg-[var(--bg)] text-[var(--text)] overflow-x-hidden antialiased">
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-50 focus:rounded-xl focus:bg-primary focus:px-4 focus:py-2 focus:text-sm focus:font-semibold focus:text-[var(--on-primary)]">
        {{ __('Ir para o conteúdo') }}
    </a>

    {{-- Efeitos de Gradiente e Brilho de Fundo (Glow Blobs) --}}
    <div class="fixed inset-0 -z-50 pointer-events-none" aria-hidden="true">
        <div class="absolute inset-0 bg-[var(--bg)]"></div>
        <div class="absolute -top-60 left-1/2 -translate-x-1/2 h-[900px] w-[900px] rounded-full bg-primary/10 blur-[180px]"></div>
        <div class="absolute bottom-0 right-0 h-[600px] w-[600px] rounded-full bg-blue-500/10 blur-[180px]"></div>
        <div class="absolute top-40 left-0 h-[450px] w-[450px] rounded-full bg-orange-500/10 blur-[140px]"></div>
    </div>

    <div class="min-h-screen flex">

        {{-- Sidebar (Navegação Lateral) --}}
        <aside class="hidden lg:flex w-72 flex-col border-r border-[var(--border)] bg-[var(--sidebar)] backdrop-blur-xl">

            {{-- Branding --}}
            <div class="h-20 px-8 flex items-center border-b border-[var(--border)]">
                    <div class="flex items-center gap-4">
                        <div class="h-11 w-11 rounded-xl bg-primary text-[var(--on-primary)] font-black flex items-center justify-center shadow-md shadow-primary/20">
                            GA
                        </div>
                    <div>
                        <h1 class="font-bold text-sm tracking-tight text-[var(--text)]">
                            {{ __('Gestão de Avarias') }}
                        </h1>
                        <p class="text-[var(--text-soft)] text-xs font-medium">
                            {{ __('Enterprise Dashboard') }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Links de Navegação Dinâmicos --}}
            <nav class="flex-1 overflow-y-auto px-4 py-6 space-y-1" aria-label="{{ __('Navegação principal') }}">
                @php
                    $navItems = [
                        ['href' => '/', 'active' => '/', 'label' => 'Início', 'icon' => '🏠', 'exact' => true],
                        ['href' => 'ui', 'active' => 'ui', 'label' => 'Dashboard', 'icon' => '📊', 'exact' => true],
                        ['href' => 'ui/tickets', 'active' => 'ui/tickets*', 'label' => 'Tickets', 'icon' => '🎫', 'exact' => false],
                        ['href' => 'ui/equipments', 'active' => 'ui/equipments*', 'label' => 'Equipamentos', 'icon' => '🖥️', 'exact' => false],
                        ['href' => 'ui/users', 'active' => 'ui/users*', 'label' => 'Utilizadores', 'icon' => '👥', 'exact' => false],
                        ['href' => 'ui/audits', 'active' => 'ui/audits*', 'label' => 'Auditoria', 'icon' => '📝', 'exact' => false],
                        ['href' => 'ui/analytics', 'active' => 'ui/analytics*', 'label' => 'Analytics', 'icon' => '📈', 'exact' => false],
                        ['href' => 'calendar', 'active' => 'calendar*', 'label' => 'Agenda', 'icon' => '📅', 'exact' => false],
                        ['href' => 'docs/openapi', 'active' => 'docs/openapi*', 'label' => 'Swagger', 'icon' => '📚', 'exact' => false],
                    ];

                    foreach($navItems as $item) {
                        $isActive = request()->is($item['active']);
                @endphp

                        <a
                            href="{{ url($item['href'] === '/' ? '/' : $item['href']) }}"
                            class="group flex items-center gap-3.5 rounded-xl px-4 py-3 text-sm font-medium transition-all duration-200
                            {{ $isActive
                                ? 'bg-primary text-[var(--on-primary)] font-semibold shadow-sm shadow-primary/20'
                                : 'text-[var(--text)] hover:bg-[var(--surface-2)]'
                            }}"
                        >
                            <span class="text-lg filter {{ $isActive ? 'none' : 'grayscale opacity-80' }}">
                                {{ $item['icon'] }}
                            </span>
                            <span>{{ __($item['label']) }}</span>
                        </a>

                @php
                    }
                @endphp
            </nav>

            {{-- Caixa de Autenticação/Sessão (Bottom) --}}
            <div class="border-t border-[var(--border)] p-4 bg-[var(--surface-2)]/50">
                <div id="authBox"></div>
            </div>
        </aside>

        {{-- Mobile Sidebar (Hamburger) --}}
        <div class="lg:hidden fixed top-4 left-4 z-50">
            <button
                type="button"
                onclick="toggleMobileNav()"
                class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-[var(--border)] bg-[var(--surface)] text-sm shadow-sm transition-all hover:bg-[var(--surface-2)] cursor-pointer"
                aria-label="{{ __('Abrir menu') }}"
                id="mobileMenuBtn"
            >
                ☰
            </button>

            {{-- Overlay --}}
            <div id="mobileNavOverlay" class="fixed inset-0 bg-black/50 hidden z-40 transition-opacity duration-200" onclick="closeMobileNav()"></div>

            {{-- Drawer --}}
            <aside
                id="mobileNav"
                class="fixed inset-y-0 left-0 w-72 transform -translate-x-full transition-transform duration-250 bg-[var(--sidebar)] border-r border-[var(--border)] backdrop-blur-xl z-50 flex flex-col"
            >
                {{-- Branding --}}
                <div class="h-20 px-8 flex items-center border-b border-[var(--border)]">
                    <div class="flex items-center gap-4">
                        <div class="h-11 w-11 rounded-xl bg-primary text-[var(--on-primary)] font-black flex items-center justify-center shadow-md shadow-primary/20">
                            GA
                        </div>
                        <div>
                            <h1 class="font-bold text-sm tracking-tight text-[var(--text)]">
                                {{ __('Gestão de Avarias') }}
                            </h1>
                            <p class="text-[var(--text-soft)] text-xs font-medium">
                                {{ __('Enterprise Dashboard') }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Links --}}
                <nav class="flex-1 overflow-y-auto px-4 py-6 space-y-1" aria-label="{{ __('Navegação principal mobile') }}">
                    @foreach($navItems as $item)
                        @php
                            $isActive = request()->is($item['active']);
                        @endphp

                        <a
                            href="{{ url($item['href'] === '/' ? '/' : $item['href']) }}"
                            onclick="closeMobileNav()"
                            class="group flex items-center gap-3.5 rounded-xl px-4 py-3 text-sm font-medium transition-all duration-200
                            {{ $isActive
                            ? 'bg-primary text-[var(--on-primary)] font-semibold shadow-sm shadow-primary/20'
                                : 'text-[var(--text)] hover:bg-[var(--surface-2)]'
                            }}"
                        >
                            <span class="text-lg filter {{ $isActive ? 'none' : 'grayscale opacity-80' }}">
                                {{ $item['icon'] }}
                            </span>
                            <span>{{ __($item['label']) }}</span>
                        </a>
                    @endforeach
                </nav>

                {{-- Auth box --}}
                <div class="border-t border-[var(--border)] p-4 bg-[var(--surface-2)]/50">
                    <div id="authBoxMobile"></div>
                </div>
            </aside>
        </div>

        {{-- Área de Conteúdo Principal --}}
        <div class="flex-1 flex flex-col min-w-0">

            {{-- Topbar --}}
            <header class="sticky top-0 z-40 h-20 border-b border-[var(--border)] bg-[var(--topbar)] backdrop-blur-xl">
                <div class="h-full px-8 flex items-center justify-between">
                    <div class="pl-12 lg:pl-0">
                        <h2 class="text-lg font-bold tracking-tight text-[var(--text)]">
                            {{ __('Painel de Gestão') }}
                        </h2>
                        <p class="text-[var(--text-soft)] text-xs">
                            {{ __('Monitorização em tempo real') }}
                        </p>
                    </div>

                    {{-- Ações de Perfil, Idioma e Tema --}}
                    <div class="flex items-center gap-3">
                        {{-- Language Selector Dropdown --}}
                        <div class="relative inline-block text-left" id="langSelectorDropdown">
                            <button
                                type="button"
                                onclick="toggleLangDropdown()"
                                class="inline-flex h-10 px-3 items-center justify-center gap-1.5 rounded-xl border border-[var(--border)] bg-[var(--surface)] text-sm text-[var(--text)] shadow-sm transition-all hover:bg-[var(--surface-2)] cursor-pointer"
                                aria-label="{{ __('Alterar Idioma') }}"
                                aria-haspopup="true"
                                aria-expanded="false"
                                id="langDropdownBtn"
                            >
                                🌐
                                <span class="font-semibold text-xs uppercase text-[var(--text)]">{{ app()->getLocale() }}</span>
                                <svg class="h-3.5 w-3.5 text-[var(--text-soft)]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div id="langDropdown" class="hidden absolute right-0 mt-2 w-36 rounded-xl border border-[var(--border)] bg-[var(--surface)] shadow-lg py-1.5 z-50 animate-[fadeIn_0.15s_ease-out]">
                                <a href="/lang/pt" class="flex items-center px-4 py-2.5 text-xs font-semibold text-[var(--text)] hover:bg-[var(--surface-2)] {{ app()->getLocale() === 'pt' ? 'bg-primary/10 text-primary' : '' }}">
                                    🇵🇹 Português
                                </a>
                                <a href="/lang/en" class="flex items-center px-4 py-2.5 text-xs font-semibold text-[var(--text)] hover:bg-[var(--surface-2)] {{ app()->getLocale() === 'en' ? 'bg-primary/10 text-primary' : '' }}">
                                    🇬🇧 English
                                </a>
                            </div>
                        </div>

                        <button
                            type="button"
                            onclick="toggleTheme()"
                            class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-[var(--border)] bg-[var(--surface)] text-sm shadow-sm transition-all hover:bg-[var(--surface-2)] cursor-pointer"
                            aria-label="{{ __('Alternar Tema') }}"
                        >
                            🌙
                        </button>

                        <div class="h-8 w-px bg-[var(--border)]"></div>

                        <div id="topbarUser" class="flex items-center gap-3"></div>
                    </div>
                </div>
            </header>

            {{-- Viewport Injetada --}}
            <main id="main-content" role="main" tabindex="-1" class="flex-1 px-8 py-8 max-w-7xl w-full mx-auto outline-none">
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

    function toggleMobileNav() {
        const overlay = document.getElementById('mobileNavOverlay');
        const drawer = document.getElementById('mobileNav');

        if (!overlay || !drawer) return;

        const isOpen = drawer.getAttribute('data-open') === 'true';

        if (isOpen) {
            closeMobileNav();
            return;
        }

        drawer.setAttribute('data-open', 'true');
        drawer.style.transform = 'translateX(0)';
        overlay.classList.remove('hidden');
        overlay.style.display = 'block';
    }

    function closeMobileNav() {
        const overlay = document.getElementById('mobileNavOverlay');
        const drawer = document.getElementById('mobileNav');

        if (!overlay || !drawer) return;

        drawer.setAttribute('data-open', 'false');
        drawer.style.transform = 'translateX(-100%)';
        overlay.classList.add('hidden');
        overlay.style.display = 'none';
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

    // Close dropdown on click outside
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

    // Inicialização imediata do tema para prevenir flashes brancos (FOUC)
    (() => {
        const saved = localStorage.getItem('theme');
        if (saved === 'dark' || (!saved && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
            document.documentElement.setAttribute('data-theme', 'dark');
        } else {
            document.documentElement.classList.remove('dark');
            document.documentElement.removeAttribute('data-theme');
        }
    })();

    document.addEventListener('DOMContentLoaded', () => {
        if (typeof requireAuthOnLoad !== 'undefined' && requireAuthOnLoad) {
            requireAuth();
        }
        renderAuthBox();
        const token = localStorage.getItem('api_token');
        if (token) {
            const userName = localStorage.getItem('user_name') || 'Utilizador';
            const userRole = localStorage.getItem('user_role') || 'Utilizador';
            const topbarUser = document.getElementById('topbarUser');
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
        }
    });
    </script>

    @stack('scripts-top')
    @stack('scripts')
</body>

</html>
