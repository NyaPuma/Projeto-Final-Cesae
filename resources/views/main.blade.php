@extends('layouts.layout')

@section('content')
<div class="max-w-7xl mx-auto py-2">
    <div class="mb-8 flex flex-wrap items-center justify-between gap-4 rounded-3xl border border-[var(--border)] bg-[var(--surface)]/70 px-6 py-4 shadow-sm backdrop-blur">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[var(--text-soft)]">Gestão de Avarias</p>
            <h1 class="mt-2 text-2xl font-black tracking-tight">Centro de Controlo Operacional</h1>
        </div>
        <div class="flex items-center gap-3">
            <button type="button" onclick="toggleLandingTheme()" class="inline-flex h-11 w-11 items-center justify-center rounded-2xl border border-[var(--border)] bg-[var(--surface)] text-sm shadow-sm transition hover:bg-[var(--surface-2)]" aria-label="Alternar tema">🌙</button>
            <div id="landingAuthActions" class="flex items-center gap-3"></div>
        </div>
    </div>

    <header class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-8 mb-12">
        <div>
            <span class="inline-flex items-center gap-2 rounded-full border border-amber-500/20 bg-amber-500/10 px-4 py-2 text-sm font-semibold text-amber-500">
                <div class="h-2 w-2 rounded-full bg-amber-500 animate-pulse"></div>
                Painel Principal
            </span>
            <h1 class="mt-6 text-5xl font-black tracking-tight">
                Centro de Controlo
            </h1>
            <p class="mt-5 text-soft max-w-2xl leading-8">
                Gerencie ocorrências, equipamentos, utilizadores, auditorias e operações da infraestrutura através de um único painel moderno.
            </p>
        </div>
    </header>

    <section class="grid xl:grid-cols-4 gap-6 mb-10">
        <div class="card p-6">
            <div class="text-soft text-xs uppercase">
                Tickets Abertos
            </div>
            <div class="mt-3 text-4xl font-black">
                126
            </div>
            <div class="mt-2 text-green-500 text-sm">
                ▲ +8 hoje
            </div>
        </div>

        <div class="card p-6">
            <div class="text-soft text-xs uppercase">
                Equipamentos
            </div>
            <div class="mt-3 text-4xl font-black">
                847
            </div>
            <div class="mt-2 text-soft text-sm">
                Online
            </div>
        </div>

        <div class="card p-6">
            <div class="text-soft text-xs uppercase">
                Utilizadores
            </div>
            <div class="mt-3 text-4xl font-black">
                42
            </div>
            <div class="mt-2 text-soft text-sm">
                Ativos
            </div>
        </div>

        <div class="card p-6">
            <div class="text-soft text-xs uppercase">
                Disponibilidade
            </div>
            <div class="mt-3 text-4xl font-black text-green-500">
                99.9%
            </div>
            <div class="mt-2 text-soft text-sm">
                Sistema
            </div>
        </div>
    </section>

    <section class="grid lg:grid-cols-2 xl:grid-cols-3 gap-8">
        <a href="/ui/tickets" class="card p-8 hover:scale-[1.02] transition">
            <div class="flex justify-between items-start">
                <div class="h-14 w-14 rounded-2xl bg-amber-500/15 flex items-center justify-center text-3xl">
                    🎫
                </div>
                <span class="text-3xl">→</span>
            </div>
            <h2 class="mt-8 text-2xl font-bold">Tickets</h2>
            <p class="mt-4 text-soft leading-7">
                Consultar ocorrências, criar novos pedidos, acompanhar estados e histórico.
            </p>
        </a>

        <a href="/ui/equipments" class="card p-8 hover:scale-[1.02] transition">
            <div class="flex justify-between">
                <div class="h-14 w-14 rounded-2xl bg-blue-500/15 flex items-center justify-center text-3xl">
                    🖥️
                </div>
                <span class="text-3xl">→</span>
            </div>
            <h2 class="mt-8 text-2xl font-bold">Equipamentos</h2>
            <p class="mt-4 text-soft leading-7">
                Inventário, salas, ativos e informação técnica.
            </p>
        </a>

        <a href="/ui/users" class="card p-8 hover:scale-[1.02] transition">
            <div class="flex justify-between">
                <div class="h-14 w-14 rounded-2xl bg-purple-500/15 flex items-center justify-center text-3xl">
                    👥
                </div>
                <span class="text-3xl">→</span>
            </div>
            <h2 class="mt-8 text-2xl font-bold">Utilizadores</h2>
            <p class="mt-4 text-soft leading-7">
                Gestão de contas, permissões, equipas e perfis.
            </p>
        </a>

        <a href="/ui/audits" class="card p-8 hover:scale-[1.02] transition">
            <div class="flex justify-between">
                <div class="h-14 w-14 rounded-2xl bg-red-500/15 flex items-center justify-center text-3xl">
                    📝
                </div>
                <span class="text-3xl">→</span>
            </div>
            <h2 class="mt-8 text-2xl font-bold">Auditoria</h2>
            <p class="mt-4 text-soft leading-7">
                Histórico completo das alterações, logs do sistema, rastreabilidade e conformidade.
            </p>
        </a>

        <a href="/ui/analytics" class="card p-8 hover:scale-[1.02] transition">
            <div class="flex justify-between">
                <div class="h-14 w-14 rounded-2xl bg-green-500/15 flex items-center justify-center text-3xl">
                    📈
                </div>
                <span class="text-3xl">→</span>
            </div>
            <h2 class="mt-8 text-2xl font-bold">Analytics</h2>
            <p class="mt-4 text-soft leading-7">
                Indicadores em tempo real, gráficos, KPIs e desempenho operacional.
            </p>
        </a>

        <a href="/calendar" class="card p-8 hover:scale-[1.02] transition">
            <div class="flex justify-between">
                <div class="h-14 w-14 rounded-2xl bg-cyan-500/15 flex items-center justify-center text-3xl">
                    📅
                </div>
                <span class="text-3xl">→</span>
            </div>
            <h2 class="mt-8 text-2xl font-bold">Agenda</h2>
            <p class="mt-4 text-soft leading-7">
                Planeamento de intervenções, manutenções preventivas, calendário global.
            </p>
        </a>
    </section>

    <section class="mt-14">
        <div class="card overflow-hidden">
            <div class="grid lg:grid-cols-2">
                <div class="p-10">
                    <span class="text-amber-500 uppercase tracking-[0.3em] text-sm font-semibold">
                        Estado do Sistema
                    </span>
                    <h2 class="mt-5 text-4xl font-black">
                        Todos os serviços operacionais.
                    </h2>
                    <p class="mt-6 text-soft leading-8">
                        A infraestrutura encontra-se operacional, com sincronização contínua entre clientes, API, WebSockets e base de dados.
                    </p>

                    <div class="mt-10 space-y-6">
                        <div>
                            <div class="flex justify-between mb-2 text-sm">
                                <span>API</span>
                                <span>100%</span>
                            </div>
                            <div class="h-3 rounded-full bg-black/10 dark:bg-white/10 overflow-hidden">
                                <div class="h-full w-full bg-green-500 rounded-full"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between mb-2 text-sm">
                                <span>Base de Dados</span>
                                <span>99%</span>
                            </div>
                            <div class="h-3 rounded-full bg-black/10 dark:bg-white/10 overflow-hidden">
                                <div class="h-full w-[99%] bg-blue-500 rounded-full"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between mb-2 text-sm">
                                <span>WebSocket</span>
                                <span>100%</span>
                            </div>
                            <div class="h-3 rounded-full bg-black/10 dark:bg-white/10 overflow-hidden">
                                <div class="h-full w-full bg-amber-500 rounded-full"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between mb-2 text-sm">
                                <span>Backups</span>
                                <span>100%</span>
                            </div>
                            <div class="h-3 rounded-full bg-black/10 dark:bg-white/10 overflow-hidden">
                                <div class="h-full w-full bg-purple-500 rounded-full"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border-l border-[var(--border)] p-10 flex flex-col justify-center">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="card p-6 text-center">
                            <div class="text-4xl font-black text-amber-500">24/7</div>
                            <div class="mt-3 text-soft text-sm">Monitorização</div>
                        </div>
                        <div class="card p-6 text-center">
                            <div class="text-4xl font-black text-green-500">TLS</div>
                            <div class="mt-3 text-soft text-sm">Segurança</div>
                        </div>
                        <div class="card p-6 text-center">
                            <div class="text-4xl font-black text-blue-500">API</div>
                            <div class="mt-3 text-soft text-sm">Integração</div>
                        </div>
                        <div class="card p-6 text-center">
                            <div class="text-4xl font-black text-purple-500">99.9%</div>
                            <div class="mt-3 text-soft text-sm">Disponibilidade</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="mt-16 border-t border-[var(--border)]">
        <div class="py-10">
            <div class="flex flex-col xl:flex-row justify-between items-center gap-8">
                <div>
                    <h3 class="text-xl font-bold">Central de Operações</h3>
                    <p class="mt-3 text-soft max-w-lg leading-7">
                        Plataforma desenvolvida para centralizar a gestão de avarias, equipamentos, auditorias, utilizadores, calendário operacional e análise da infraestrutura.
                    </p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-sm">
                    <div>
                        <h4 class="font-semibold mb-4">Plataforma</h4>
                        <div class="space-y-2">
                            <a href="/ui" class="block hover:text-amber-500">Dashboard</a>
                            <a href="/ui/tickets" class="block hover:text-amber-500">Tickets</a>
                            <a href="/ui/equipments" class="block hover:text-amber-500">Equipamentos</a>
                        </div>
                    </div>

                    <div>
                        <h4 class="font-semibold mb-4">Gestão</h4>
                        <div class="space-y-2">
                            <a href="/ui/users" class="block hover:text-amber-500">Utilizadores</a>
                            <a href="/ui/audits" class="block hover:text-amber-500">Auditoria</a>
                            <a href="/ui/analytics" class="block hover:text-amber-500">Analytics</a>
                        </div>
                    </div>

                    <div>
                        <h4 class="font-semibold mb-4">Ferramentas</h4>
                        <div class="space-y-2">
                            <a href="/calendar" class="block hover:text-amber-500">Agenda</a>
                            <a href="/docs/openapi" class="block hover:text-amber-500">Swagger</a>
                        </div>
                    </div>

                    <div>
                        <h4 class="font-semibold mb-4">Estado</h4>
                        <div class="space-y-2">
                            <div class="flex items-center gap-2">
                                <span class="h-2 w-2 rounded-full bg-green-500 animate-pulse"></span>
                                <span>Online</span>
                            </div>
                            <div>API Operacional</div>
                            <div>TLS Ativo</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-[var(--border)] flex flex-col lg:flex-row items-center justify-between gap-6">
                <div class="text-soft text-sm">
                    © {{ date('Y') }} Central de Operações. Todos os direitos reservados.
                </div>
                <div class="flex flex-wrap justify-center gap-6 text-sm text-soft">
                    <span>Laravel 12</span>
                    <span>•</span>
                    <span>Tailwind CSS 4</span>
                    <span>•</span>
                    <span>Pusher</span>
                    <span>•</span>
                    <span>Enterprise UI</span>
                    <span>•</span>
                    <span>v2.4.0</span>
                </div>
            </div>
        </div>
    </footer>

</div>
@endsection

@push('scripts')
<script>
function toggleLandingTheme() {
    const html = document.documentElement;
    const dark = html.classList.toggle('dark');
    localStorage.setItem('theme', dark ? 'dark' : 'light');
}

(function () {
    const container = document.getElementById('landingAuthActions');
    if (!container) return;
    const token = localStorage.getItem('api_token');
    if (token) {
        const userName = localStorage.getItem('user_name') || 'Utilizador';
        container.innerHTML = `
            <a href="/ui/profile" class="inline-flex items-center justify-center rounded-2xl border border-[var(--border)] bg-[var(--surface)] px-4 py-2.5 text-sm font-semibold text-[var(--text)] transition hover:bg-[var(--surface-2)]">${userName}</a>
            <a href="/ui" class="inline-flex items-center justify-center rounded-2xl bg-primary px-4 py-2.5 text-sm font-semibold text-black transition hover:opacity-90">Abrir painel</a>
        `;
    } else {
        container.innerHTML = `
            <a href="/ui/login" class="inline-flex items-center justify-center rounded-2xl border border-[var(--border)] bg-[var(--surface)] px-4 py-2.5 text-sm font-semibold text-[var(--text)] transition hover:bg-[var(--surface-2)]">Login / Registo</a>
            <a href="/ui" class="inline-flex items-center justify-center rounded-2xl bg-primary px-4 py-2.5 text-sm font-semibold text-black transition hover:opacity-90">Ver dashboard</a>
        `;
    }
})();
</script>
@endpush
