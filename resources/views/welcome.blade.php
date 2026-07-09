<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Central de Operações') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <style>
            :root {
                --bg: #f5f7fb;
                --surface: #ffffff;
                --surface-2: #f8fafc;
                --topbar: rgba(255, 255, 255, 0.8);
                --border: #e5e7eb;
                --text: #111827;
                --text-soft: #6b7280;
            }
            .dark {
                --bg: #0b0f19;
                --surface: #131b2e;
                --surface-2: #1e293b;
                --topbar: rgba(19, 27, 46, 0.8);
                --border: #1e293b;
                --text: #f8fafc;
                --text-soft: #94a3b8;
            }
            body { background-color: var(--bg); color: var(--text); font-family: 'Inter', sans-serif; }
            .card { background: var(--surface); border: 1px solid var(--border); border-radius: 16px; box-shadow: 0 1px 2px rgba(0,0,0,.05); }
            .btn { inline-flex; items-center; justify-center; padding: 0.6rem 1.2rem; border-radius: 12px; font-weight: 600; font-size: 0.875rem; transition: all 0.2s; cursor: pointer; }
            .btn-primary { background: #f59e0b; color: #000; }
            .btn-primary:hover { background: #d97706; }
            .btn-secondary { background: var(--surface-2); border: 1px solid var(--border); color: var(--text); }
            .text-soft { color: var(--text-soft); }
            .badge { display: inline-flex; align-items: center; padding: .3rem .7rem; border-radius: 999px; font-size: .75rem; font-weight: 700; }
            .badge-success { background: #22c55e22; color: #22c55e; }
        </style>
    @endif
</head>

<body class="min-h-screen bg-[var(--bg)] text-[var(--text)] overflow-x-hidden antialiased">

    <div class="fixed inset-0 -z-50 pointer-events-none" aria-hidden="true">
        <div class="absolute inset-0 bg-[var(--bg)]"></div>
        <div class="absolute -top-40 left-1/2 h-[700px] w-[700px] -translate-x-1/2 rounded-full bg-amber-500/10 blur-[160px]"></div>
        <div class="absolute bottom-0 right-0 h-[450px] w-[450px] rounded-full bg-blue-500/10 blur-[140px]"></div>
        <div class="absolute top-0 left-0 h-[400px] w-[400px] rounded-full bg-orange-500/10 blur-[120px]"></div>
    </div>

    <header class="sticky top-0 z-50 backdrop-blur-xl border-b border-[var(--border)] bg-[var(--topbar)]">
        <div class="max-w-7xl mx-auto h-20 px-8 flex items-center justify-between">

            <div class="flex items-center gap-5">
                <div class="h-12 w-12 rounded-2xl bg-amber-500 flex items-center justify-center text-black font-extrabold text-lg shadow-lg shadow-amber-500/20">
                    GA
                </div>
                <div>
                    <h1 class="text-lg font-black tracking-tight">
                        {{ config('app.name', 'Gestão de Avarias') }}
                    </h1>
                    <p class="text-sm text-soft font-medium">
                        Plataforma Enterprise
                    </p>
                </div>
            </div>

            <nav class="hidden lg:flex items-center gap-8 text-sm font-medium">
                <a href="#features" class="hover:text-amber-500 transition-colors">Funcionalidades</a>
                <a href="#stats" class="hover:text-amber-500 transition-colors">Estatísticas</a>
                <a href="#security" class="hover:text-amber-500 transition-colors">Segurança</a>
                <a href="#contact" class="hover:text-amber-500 transition-colors">Contacto</a>
            </nav>

            <div class="flex items-center gap-3">
                <button onclick="toggleTheme()" class="btn btn-secondary p-2.5" data-theme-toggle title="Alternar Tema">
                    🌙
                </button>

                @auth
                    <a href="{{ url('/ui') }}" class="btn btn-primary">
                        Dashboard
                    </a>
                @else
                    <a href="{{ url('/ui/login') }}" class="btn btn-secondary">
                        Entrar
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-primary">
                            Registar
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </header>

    <main>
        <section class="relative pt-28 pb-20">
            <div class="max-w-7xl mx-auto px-8">
                <div class="grid lg:grid-cols-2 gap-16 items-center">

                    <div data-animate>
                        <span class="inline-flex items-center gap-2 rounded-full border border-amber-500/20 bg-amber-500/10 px-5 py-2 text-sm font-bold text-amber-500">
                            <span class="h-2 w-2 rounded-full bg-amber-500 animate-pulse"></span>
                            Sistema Online
                        </span>

                        <h2 class="mt-8 text-5xl lg:text-6xl font-black leading-[1.15] tracking-tight">
                            Controle total
                            <br>
                            <span class="text-amber-500">das avarias</span>
                            <br>da sua infraestrutura.
                        </h2>

                        <p class="mt-8 text-lg text-soft leading-8 max-w-xl font-medium">
                            Uma plataforma desenvolvida para equipas técnicas que necessitam de rapidez,
                            rastreabilidade e monitorização completa dos equipamentos. Centralize tickets,
                            salas, auditorias e métricas numa única interface moderna.
                        </p>

                        <div class="mt-10 flex flex-wrap gap-4">
                            @auth
                                <a href="{{ url('/ui') }}" class="btn btn-primary px-8 py-3.5 shadow-lg shadow-amber-500/10">
                                    Entrar no Painel
                                </a>
                            @else
                                <a href="{{ url('/ui/login') }}" class="btn btn-primary px-8 py-3.5 shadow-lg shadow-amber-500/10">
                                    Iniciar Sessão
                                </a>
                                <a href="#features" class="btn btn-secondary px-8 py-3.5">
                                    Explorar Plataforma
                                </a>
                            @endauth
                        </div>

                        <div id="stats" class="grid grid-cols-3 gap-5 mt-14">
                            <div class="card p-5 border-soft surface-2 shadow-soft">
                                <div class="text-3xl font-black tracking-tight">99.9%</div>
                                <div class="text-soft text-xs mt-2 font-semibold uppercase tracking-wider">Disponibilidade</div>
                            </div>
                            <div class="card p-5 border-soft surface-2 shadow-soft">
                                <div class="text-3xl font-black tracking-tight">24/7</div>
                                <div class="text-soft text-xs mt-2 font-semibold uppercase tracking-wider">Monitorização</div>
                            </div>
                            <div class="card p-5 border-soft surface-2 shadow-soft">
                                <div class="text-3xl font-black tracking-tight">100%</div>
                                <div class="text-soft text-xs mt-2 font-semibold uppercase tracking-wider">Auditoria</div>
                            </div>
                        </div>
                    </div>

                    <div class="relative" data-animate>
                        <div class="card p-8 border-soft surface shadow-soft backdrop-blur-md">
                            <div class="flex items-center justify-between border-b border-[var(--border)] pb-6">
                                <div>
                                    <div class="text-soft text-xs font-bold uppercase tracking-wider">Estado da Plataforma</div>
                                    <div class="text-2xl font-black mt-1">Todos os Serviços Operacionais</div>
                                </div>
                                <span class="badge badge-success shadow-sm">ONLINE</span>
                            </div>

                            <div class="mt-8 space-y-6">
                                <div>
                                    <div class="flex justify-between text-sm font-bold mb-2">
                                        <span>Tickets Processados</span>
                                        <span class="text-soft">91%</span>
                                    </div>
                                    <div class="h-2.5 rounded-full bg-black/5 dark:bg-white/5 overflow-hidden">
                                        <div class="h-full rounded-full bg-amber-500 transition-all duration-1000" style="width: 91%"></div>
                                    </div>
                                </div>

                                <div>
                                    <div class="flex justify-between text-sm font-bold mb-2">
                                        <span>Infraestrutura</span>
                                        <span class="text-soft">98%</span>
                                    </div>
                                    <div class="h-2.5 rounded-full bg-black/5 dark:bg-white/5 overflow-hidden">
                                        <div class="h-full rounded-full bg-green-500 transition-all duration-1000" style="width: 98%"></div>
                                    </div>
                                </div>

                                <div>
                                    <div class="flex justify-between text-sm font-bold mb-2">
                                        <span>Sincronização Real-time</span>
                                        <span class="text-soft">100%</span>
                                    </div>
                                    <div class="h-2.5 rounded-full bg-black/5 dark:bg-white/5 overflow-hidden">
                                        <div class="h-full rounded-full bg-blue-500 transition-all duration-1000" style="width: 100%"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-8 pt-6 border-t border-[var(--border)] grid grid-cols-2 gap-4">
                                <div class="rounded-2xl border border-[var(--border)] surface-2 p-5">
                                    <div class="text-soft text-xs font-bold uppercase tracking-wider">Tickets Ativos</div>
                                    <div class="mt-2 text-4xl font-black tracking-tight">126</div>
                                    <div class="mt-2 text-xs font-semibold text-green-500 flex items-center gap-1">
                                        ▲ +12% esta semana
                                    </div>
                                </div>

                                <div class="rounded-2xl border border-[var(--border)] surface-2 p-5">
                                    <div class="text-soft text-xs font-bold uppercase tracking-wider">Equipamentos</div>
                                    <div class="mt-2 text-4xl font-black tracking-tight">847</div>
                                    <div class="mt-2 text-xs font-semibold text-blue-500">Todos Sincronizados</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section id="features" class="py-28 border-t border-[var(--border)] bg-black/[0.01] dark:bg-white/[0.01]">
            <div class="max-w-7xl mx-auto px-8">

                <div class="text-center max-w-3xl mx-auto">
                    <span class="text-amber-500 font-bold uppercase tracking-[0.2em] text-xs">
                        Módulos Core
                    </span>
                    <h2 class="mt-4 text-4xl lg:text-5xl font-black tracking-tight">
                        Tudo o que precisa para gerir a infraestrutura.
                    </h2>
                    <p class="mt-5 text-soft text-lg font-medium leading-8">
                        Concebido detalhadamente para departamentos de manutenção, informática,
                        infraestruturas e operações operacionais.
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mt-20">

                    <div class="card p-8 border-soft surface shadow-sm hover:shadow-md transition-shadow">
                        <div class="h-14 w-14 rounded-2xl bg-amber-500/10 flex items-center justify-center text-2xl shadow-inner">🎫</div>
                        <h3 class="mt-6 text-xl font-bold tracking-tight">Gestão de Tickets</h3>
                        <p class="mt-3 text-soft text-sm font-medium leading-6">
                            Criação, atribuição automática e acompanhamento em tempo real de incidentes com histórico auditável.
                        </p>
                    </div>

                    <div class="card p-8 border-soft surface shadow-sm hover:shadow-md transition-shadow">
                        <div class="h-14 w-14 rounded-2xl bg-green-500/10 flex items-center justify-center text-2xl shadow-inner">🖥️</div>
                        <h3 class="mt-6 text-xl font-bold tracking-tight">Inventário Global</h3>
                        <p class="mt-3 text-soft text-sm font-medium leading-6">
                            Controlo completo de equipamentos técnicos, mapeamento de salas físicas e ciclo de vida dos ativos.
                        </p>
                    </div>

                    <div class="card p-8 border-soft surface shadow-sm hover:shadow-md transition-shadow">
                        <div class="h-14 w-14 rounded-2xl bg-blue-500/10 flex items-center justify-center text-2xl shadow-inner">📈</div>
                        <h3 class="mt-6 text-xl font-bold tracking-tight">Analytics Avançado</h3>
                        <p class="mt-3 text-soft text-sm font-medium leading-6">
                            Métricas operacionais de desempenho, MTTR, taxas de resolução e relatórios dinâmicos.
                        </p>
                    </div>

                    <div class="card p-8 border-soft surface shadow-sm hover:shadow-md transition-shadow">
                        <div class="h-14 w-14 rounded-2xl bg-purple-500/10 flex items-center justify-center text-2xl shadow-inner">📅</div>
                        <h3 class="mt-6 text-xl font-bold tracking-tight">Agenda Integrada</h3>
                        <p class="mt-3 text-soft text-sm font-medium leading-6">
                            Planeamento visual de intervenções preventivas, manutenções agendadas e escalas técnicas.
                        </p>
                    </div>

                    <div class="card p-8 border-soft surface shadow-sm hover:shadow-md transition-shadow">
                        <div class="h-14 w-14 rounded-2xl bg-red-500/10 flex items-center justify-center text-2xl shadow-inner">📝</div>
                        <h3 class="mt-6 text-xl font-bold tracking-tight">Trilhas de Auditoria</h3>
                        <p class="mt-3 text-soft text-sm font-medium leading-6">
                            Registo completo e permanente de todas as mutações de dados para conformidade de segurança e logs.
                        </p>
                    </div>

                    <div class="card p-8 border-soft surface shadow-sm hover:shadow-md transition-shadow">
                        <div class="h-14 w-14 rounded-2xl bg-cyan-500/10 flex items-center justify-center text-2xl shadow-inner">🔐</div>
                        <h3 class="mt-6 text-xl font-bold tracking-tight">Segurança Confiável</h3>
                        <p class="mt-3 text-soft text-sm font-medium leading-6">
                            Controlo de acessos baseado em funções (RBAC), proteção CSRF robusta e comunicações totalmente encriptadas.
                        </p>
                    </div>

                </div>
            </div>
        </section>

        <section id="security" class="pb-28">
            <div class="max-w-7xl mx-auto px-8">
                <div class="card overflow-hidden border-soft shadow-lg surface">
                    <div class="grid lg:grid-cols-2">

                        <div class="p-12 lg:p-16 flex flex-col justify-center">
                            <span class="text-amber-500 uppercase font-bold tracking-[0.2em] text-xs">
                                Infraestrutura Resiliente
                            </span>
                            <h2 class="mt-4 text-3xl lg:text-4xl font-black tracking-tight">
                                Construído para utilização profissional de alta disponibilidade.
                            </h2>
                            <p class="mt-5 text-soft font-medium leading-8">
                                Desenvolvido para suportar fluxos operacionais ininterruptos, múltiplos utilizadores
                                em simultâneo e escalabilidade horizontal contínua de hardware, mantendo a integridade.
                            </p>

                            <ul class="mt-8 space-y-4 font-semibold text-sm">
                                <li class="flex items-center gap-3">
                                    <span class="badge badge-success h-5 w-5 p-0 flex items-center justify-center rounded-full text-[10px]">✓</span>
                                    Cópias de segurança automáticas e redundantes
                                </li>
                                <li class="flex items-center gap-3">
                                    <span class="badge badge-success h-5 w-5 p-0 flex items-center justify-center rounded-full text-[10px]">✓</span>
                                    Logs estruturados e centralizados do sistema
                                </li>
                                <li class="flex items-center gap-3">
                                    <span class="badge badge-success h-5 w-5 p-0 flex items-center justify-center rounded-full text-[10px]">✓</span>
                                    Controlo rígido de permissões por utilizador
                                </li>
                                <li class="flex items-center gap-3">
                                    <span class="badge badge-success h-5 w-5 p-0 flex items-center justify-center rounded-full text-[10px]">✓</span>
                                    REST API nativa otimizada para integrações de terceiros
                                </li>
                            </ul>
                        </div>

                        <div class="relative hidden lg:flex items-center justify-center p-12 bg-linear-to-br from-amber-500/5 via-transparent to-blue-500/5 border-l border-[var(--border)]">
                            <div class="w-full max-w-sm card p-6 border-soft surface-2 shadow-md">
                                <div class="flex items-center justify-between border-b border-[var(--border)] pb-4 mb-5">
                                    <div>
                                        <div class="text-soft text-[10px] font-bold uppercase tracking-wider">Métricas da Instância</div>
                                        <div class="text-lg font-bold mt-0.5">Status Geral</div>
                                    </div>
                                    <span class="badge badge-success py-1 px-2.5 text-[10px]">ONLINE</span>
                                </div>
                                <div class="space-y-4 text-xs font-semibold">
                                    <div class="flex justify-between">
                                        <span class="text-soft">API Endpoint</span>
                                        <span class="text-green-500">100% OK</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-soft">Base de Dados Cluster</span>
                                        <span class="text-blue-500">99.98%</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-soft">Canais Pusher WebSocket</span>
                                        <span class="text-amber-500">Ativo</span>
                                    </div>
                                </div>
                                <div class="mt-6 pt-4 border-t border-[var(--border)] grid grid-cols-2 gap-4 text-center">
                                    <div>
                                        <div class="text-soft text-[10px] uppercase">Salas</div>
                                        <div class="text-xl font-bold mt-1">18</div>
                                    </div>
                                    <div>
                                        <div class="text-soft text-[10px] uppercase">Técnicos</div>
                                        <div class="text-xl font-bold mt-1">42</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <section class="pb-28">
            <div class="max-w-7xl mx-auto px-8">
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="card p-6 text-center border-soft surface shadow-xs">
                        <div class="text-4xl font-black text-amber-500 tracking-tight">24/7</div>
                        <div class="mt-2 text-soft text-xs font-bold uppercase tracking-wider">Monitorização</div>
                    </div>
                    <div class="card p-6 text-center border-soft surface shadow-xs">
                        <div class="text-4xl font-black text-blue-500 tracking-tight">100%</div>
                        <div class="mt-2 text-soft text-xs font-bold uppercase tracking-wider">Histórico Auditável</div>
                    </div>
                    <div class="card p-6 text-center border-soft surface shadow-xs">
                        <div class="text-4xl font-black text-green-500 tracking-tight">TLS</div>
                        <div class="mt-2 text-soft text-xs font-bold uppercase tracking-wider">Ligações Seguras</div>
                    </div>
                    <div class="card p-6 text-center border-soft surface shadow-xs">
                        <div class="text-4xl font-black text-purple-500 tracking-tight">API</div>
                        <div class="mt-2 text-soft text-xs font-bold uppercase tracking-wider">Integração Completa</div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer id="contact" class="border-t border-[var(--border)] bg-[var(--surface)]">
        <div class="max-w-7xl mx-auto px-8 py-12">
            <div class="flex flex-col lg:flex-row justify-between items-center gap-8">

                <div>
                    <h3 class="font-black text-xl tracking-tight">
                        {{ config('app.name', 'Central de Operações') }}
                    </h3>
                    <p class="text-soft mt-2 text-sm font-medium max-w-sm leading-6">
                        Plataforma para gestão integrada de avarias, manutenção corretiva,
                        inventário de hardware e monitorização técnica operacional.
                    </p>
                </div>

                <div class="flex flex-wrap gap-8 text-sm font-semibold">
                    <a href="#features" class="hover:text-amber-500 transition-colors">Funcionalidades</a>
                    <a href="#stats" class="hover:text-amber-500 transition-colors">Estatísticas</a>
                    <a href="#security" class="hover:text-amber-500 transition-colors">Segurança</a>
                    @guest
                        <a href="{{ url('/ui/login') }}" class="hover:text-amber-500 transition-colors">Login</a>
                    @endguest
                </div>

            </div>

            <div class="mt-10 pt-8 border-t border-[var(--border)] flex flex-col lg:flex-row justify-between items-center gap-4 text-xs font-semibold text-soft">
                <div>
                    &copy; {{ date('Y') }} Central de Operações. Todos os direitos reservados.
                </div>
                <div class="flex items-center gap-3">
                    <span>Laravel 12</span>
                    <span>&bull;</span>
                    <span>Tailwind CSS 4</span>
                    <span>&bull;</span>
                    <span>Pusher</span>
                    <span>&bull;</span>
                    <span>Enterprise UI</span>
                    <span>&bull;</span>
                    <span>v2.4.0</span>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
