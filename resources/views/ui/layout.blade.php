<!doctype html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Gestão de Avarias</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="min-h-screen bg-[var(--bg)] text-[var(--text)] overflow-x-hidden antialiased">

    {{-- Efeitos de Gradiente e Brilho de Fundo (Glow Blobs) --}}
    <div class="fixed inset-0 -z-50 pointer-events-none">
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
                    <div class="h-11 w-11 rounded-xl bg-primary text-black font-black flex items-center justify-center shadow-md shadow-primary/20">
                        GA
                    </div>
                    <div>
                        <h1 class="font-bold text-sm tracking-tight text-[var(--text)]">
                            Gestão de Avarias
                        </h1>
                        <p class="text-[var(--text-soft)] text-xs font-medium">
                            Enterprise Dashboard
                        </p>
                    </div>
                </div>
            </div>

            {{-- Links de Navegação Dinâmicos --}}
            <nav class="flex-1 overflow-y-auto px-4 py-6 space-y-1">
                @php
                    $navItems = [
                        ['href' => '/', 'active' => '/', 'label' => 'Início', 'icon' => '🏠', 'exact' => true],
                        ['href' => 'ui', 'active' => 'ui', 'label' => 'Dashboard', 'icon' => '📊', 'exact' => true],

                        // Usar '*' apenas no pattern de active; o href tem de ser a rota real.
                        ['href' => 'ui/tickets', 'active' => 'ui/tickets*', 'label' => 'Tickets', 'icon' => '🎫', 'exact' => false],
                        ['href' => 'ui/equipments', 'active' => 'ui/equipments*', 'label' => 'Equipamentos', 'icon' => '🖥️', 'exact' => false],
                        ['href' => 'ui/users', 'active' => 'ui/users*', 'label' => 'Utilizadores', 'icon' => '👥', 'exact' => false],
                        ['href' => 'ui/audits', 'active' => 'ui/audits*', 'label' => 'Auditoria', 'icon' => '📝', 'exact' => false],
                        ['href' => 'ui/analytics', 'active' => 'ui/analytics*', 'label' => 'Analytics', 'icon' => '📈', 'exact' => false],
                        ['href' => 'calendar', 'active' => 'calendar*', 'label' => 'Agenda', 'icon' => '📅', 'exact' => false],
                        ['href' => 'docs/openapi', 'active' => 'docs/openapi*', 'label' => 'Swagger', 'icon' => '📚', 'exact' => false],
                    ];
                @endphp

                @foreach($navItems as $item)
                    @php
                        $isActive = $item['exact']
                            ? request()->is($item['active'])
                            : request()->is($item['active']);
                    @endphp

                    <a
                        href="{{ url($item['href'] === '/' ? '/' : $item['href']) }}"
                        class="group flex items-center gap-3.5 rounded-xl px-4 py-3 text-sm font-medium transition-all duration-200
                        {{ $isActive
                            ? 'bg-primary text-black font-semibold shadow-sm shadow-primary/20'
                            : 'text-[var(--text)] hover:bg-[var(--surface-2)]'
                        }}"
                    >
                        <span class="text-lg filter {{ $isActive ? 'none' : 'grayscale opacity-80' }}">
                            {{ $item['icon'] }}
                        </span>
                        <span>{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>

            {{-- Caixa de Autenticação/Sessão (Bottom) --}}
            <div class="border-t border-[var(--border)] p-4 bg-[var(--surface-2)]/50">
                <div id="authBox"></div>
            </div>
        </aside>

        {{-- Área de Conteúdo Principal --}}
        <div class="flex-1 flex flex-col min-w-0">

            {{-- Topbar --}}
            <header class="sticky top-0 z-40 h-20 border-b border-[var(--border)] bg-[var(--topbar)] backdrop-blur-xl">
                <div class="h-full px-8 flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-bold tracking-tight text-[var(--text)]">
                            Painel de Gestão
                        </h2>
                        <p class="text-[var(--text-soft)] text-xs">
                            Monitorização em tempo real
                        </p>
                    </div>

                    {{-- Ações de Perfil e Tema --}}
                    <div class="flex items-center gap-4">
                        <button
                            onclick="toggleTheme()"
                            class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-[var(--border)] bg-[var(--surface)] text-sm shadow-sm transition-all hover:bg-[var(--surface-2)] cursor-pointer"
                            aria-label="Alternar Tema"
                        >
                            🌙
                        </button>

                        <div class="h-8 w-px bg-[var(--border)]"></div>

                        <div class="flex items-center gap-3">
                            <div class="h-9 w-9 rounded-full bg-primary flex items-center justify-center font-bold text-xs text-black shadow-sm">
                                A
                            </div>
                            <div class="hidden md:block">
                                <div class="text-sm font-semibold text-[var(--text)] leading-none">
                                    Administrador
                                </div>
                                <div class="text-[9px] font-bold uppercase tracking-wider text-[var(--text-soft)] mt-1">
                                    Sistema
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Viewport Injetada --}}
            <main class="flex-1 px-8 py-8 max-w-7xl w-full mx-auto">
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

    function renderAuthBox() {
        const box = document.getElementById('authBox');
        if (!box) return;

        const token = localStorage.getItem('api_token');
        if (token) {
            box.innerHTML = `
                <button
                    onclick="logout()"
                    class="w-full inline-flex items-center justify-center rounded-xl bg-[var(--border)] hover:bg-red-500/10 hover:text-red-600 dark:hover:text-red-400 px-4 py-2.5 text-xs font-semibold text-[var(--text)] border border-transparent hover:border-red-500/20 transition-all duration-200 cursor-pointer"
                >
                    Terminar Sessão
                </button>
            `;
        } else {
            box.innerHTML = `
                <a
                    href="/ui/login"
                    class="w-full inline-flex items-center justify-center rounded-xl bg-primary px-4 py-2.5 text-xs font-bold text-black shadow-sm shadow-primary/10 transition-all duration-200 hover:opacity-90 text-center"
                >
                    Iniciar Sessão
                </a>
            `;
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
            document.cookie = 'api_token=; path=/; max-age=0; SameSite=Lax';
            window.location = '/ui/login';
        });
    }

    function toggleTheme() {
        const html = document.documentElement;
        const dark = html.classList.toggle('dark');
        localStorage.setItem('theme', dark ? 'dark' : 'light');
    }

    // Inicialização imediata do tema para prevenir flashes brancos (FOUC)
    (() => {
        const saved = localStorage.getItem('theme');
        if (saved === 'dark' || (!saved && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    })();

    document.addEventListener('DOMContentLoaded', () => {
        if (typeof requireAuthOnLoad !== 'undefined' && requireAuthOnLoad) {
            requireAuth();
        }
        renderAuthBox();
    });
    </script>

    @stack('scripts-top')
    @stack('scripts')
</body>

</html>
