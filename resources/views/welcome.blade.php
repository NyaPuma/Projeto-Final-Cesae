<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Gestão de Avarias') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[var(--bg)] text-[var(--text)] antialiased">
    <div class="mx-auto max-w-7xl px-6 py-8 lg:px-8 lg:py-10">
        @component('ui.partials.page-card', [
            'title' => 'Gestão inteligente de avarias',
            'subtitle' => 'Centralize pedidos de assistência, inventário, manutenção preventiva, auditorias e indicadores operacionais numa experiência moderna e consistente.',
            'badge' => 'Sistema online',
            'actions' => '<div class="flex flex-wrap gap-2"><a href="/ui/login" class="inline-flex items-center rounded-2xl border border-[var(--border)] bg-[var(--surface)] px-3 py-2 text-sm font-semibold text-[var(--text)] transition hover:bg-[var(--surface-2)]">Entrar</a><a href="/ui" class="inline-flex items-center rounded-2xl bg-primary px-3 py-2 text-sm font-semibold text-black transition hover:opacity-90">Aceder ao painel</a></div>'
        ])
            <div class="grid gap-6 lg:grid-cols-[1.15fr_0.85fr]">
                <div class="space-y-6">
                    <div class="grid gap-4 sm:grid-cols-3">
                        <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-4">
                            <p class="text-3xl font-black text-[var(--text)]">99.9%</p>
                            <p class="mt-2 text-xs font-semibold uppercase tracking-[0.24em] text-[var(--text-soft)]">Disponibilidade</p>
                        </div>
                        <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-4">
                            <p class="text-3xl font-black text-[var(--text)]">24/7</p>
                            <p class="mt-2 text-xs font-semibold uppercase tracking-[0.24em] text-[var(--text-soft)]">Monitorização</p>
                        </div>
                        <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-4">
                            <p class="text-3xl font-black text-[var(--text)]">100%</p>
                            <p class="mt-2 text-xs font-semibold uppercase tracking-[0.24em] text-[var(--text-soft)]">Auditoria</p>
                        </div>
                    </div>

                    <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface-2)]/70 p-6">
                        <h2 class="text-xl font-semibold tracking-tight text-[var(--text)]">O que a plataforma oferece</h2>
                        <div class="mt-4 grid gap-3 sm:grid-cols-2">
                            <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-4">
                                <p class="font-semibold text-[var(--text)]">Tickets e intervenções</p>
                                <p class="mt-2 text-sm leading-7 text-[var(--text-soft)]">Registe, priorize e acompanhe ocorrências em tempo real.</p>
                            </div>
                            <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-4">
                                <p class="font-semibold text-[var(--text)]">Equipamentos e salas</p>
                                <p class="mt-2 text-sm leading-7 text-[var(--text-soft)]">Mantenha a frota tecnológica e a sua localização organizadas.</p>
                            </div>
                            <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-4">
                                <p class="font-semibold text-[var(--text)]">Analytics e relatórios</p>
                                <p class="mt-2 text-sm leading-7 text-[var(--text-soft)]">Aceda a indicadores e métricas para decisões operacionais.</p>
                            </div>
                            <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-4">
                                <p class="font-semibold text-[var(--text)]">API e documentação</p>
                                <p class="mt-2 text-sm leading-7 text-[var(--text-soft)]">Consuma a API com documentação integrada e fluxo seguro.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm">
                    <p class="text-[10px] font-bold uppercase tracking-[0.25em] text-[var(--text-soft)]">Visão rápida</p>
                    <h3 class="mt-3 text-2xl font-semibold tracking-tight text-[var(--text)]">Preparada para operações empresariais</h3>
                    <p class="mt-4 text-sm leading-8 text-[var(--text-soft)]">A plataforma centraliza o ciclo completo de gestão de avarias, desde a criação de tickets até à análise de desempenho e auditoria das ações.</p>
                    <div class="mt-6 space-y-3">
                        <div class="flex items-center justify-between rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3">
                            <span class="text-sm font-semibold text-[var(--text)]">API REST</span>
                            <span class="rounded-full bg-emerald-500/10 px-2.5 py-1 text-xs font-semibold text-emerald-600 dark:text-emerald-400">Operacional</span>
                        </div>
                        <div class="flex items-center justify-between rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3">
                            <span class="text-sm font-semibold text-[var(--text)]">Base de dados</span>
                            <span class="rounded-full bg-primary/10 px-2.5 py-1 text-xs font-semibold text-primary">Sincronizada</span>
                        </div>
                        <div class="flex items-center justify-between rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3">
                            <span class="text-sm font-semibold text-[var(--text)]">Segurança</span>
                            <span class="rounded-full bg-amber-500/10 px-2.5 py-1 text-xs font-semibold text-amber-600 dark:text-amber-400">TLS</span>
                        </div>
                    </div>
                </div>
            </div>
        @endcomponent
    </div>
</body>
</html>

                                <div class="space-y-4">

                                    <div class="status-card">

                                        <div>

                                            <h4 class="font-semibold">
                                                Gestão de Avarias
                                            </h4>

                                            <p class="text-sm text-secondary">
                                                Registo e acompanhamento em tempo real.
                                            </p>

                                        </div>

                                        <span class="badge badge-success">
                                            Online
                                        </span>

                                    </div>


                                    <div class="status-card">

                                        <div>

                                            <h4 class="font-semibold">
                                                Inventário
                                            </h4>

                                            <p class="text-sm text-secondary">
                                                Equipamentos e ativos sincronizados.
                                            </p>

                                        </div>

                                        <span class="badge badge-success">
                                            Ativo
                                        </span>

                                    </div>


                                    <div class="status-card">

                                        <div>

                                            <h4 class="font-semibold">
                                                Calendário
                                            </h4>

                                            <p class="text-sm text-secondary">
                                                Planeamento das intervenções.
                                            </p>

                                        </div>

                                        <span class="badge badge-warning">
                                            Agenda
                                        </span>

                                    </div>


                                    <div class="status-card">

                                        <div>

                                            <h4 class="font-semibold">
                                                Analytics
                                            </h4>

                                            <p class="text-sm text-secondary">
                                                Indicadores e relatórios operacionais.
                                            </p>

                                        </div>

                                        <span class="badge badge-primary">
                                            Disponível
                                        </span>

                                    </div>

                                </div>


                                <div class="mt-8 grid gap-4 sm:grid-cols-2">

                                    <div class="metric-card">

                                        <span class="metric-value">
                                            +2 540
                                        </span>

                                        <span class="metric-label">
                                            Avarias resolvidas
                                        </span>

                                    </div>


                                    <div class="metric-card">

                                        <span class="metric-value">
                                            18 min
                                        </span>

                                        <span class="metric-label">
                                            Tempo médio
                                        </span>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        <section id="features" class="landing-section py-24">

            <div class="container mx-auto px-6 lg:px-8">

                <div class="mx-auto max-w-3xl text-center">

                    <span class="badge badge-primary">
                        Plataforma Completa
                    </span>

                    <h2 class="mt-6 text-4xl font-black lg:text-5xl">
                        Tudo o que necessita para gerir a manutenção
                    </h2>

                    <p class="mt-6 text-lg text-secondary">

                        A plataforma integra todos os módulos necessários para
                        acompanhar o ciclo completo de uma avaria, desde a abertura
                        até à resolução e análise dos indicadores.

                    </p>

                </div>


                <div class="mt-16 grid gap-8 md:grid-cols-2 xl:grid-cols-3">

                    <article class="card feature-card">

                        <div class="card-body">

                            <div class="feature-icon">
                                🎫
                            </div>

                            <h3 class="mt-6 text-xl font-bold">
                                Gestão de Avarias
                            </h3>

                            <p class="mt-4 text-secondary">

                                Registo, acompanhamento e resolução de ocorrências
                                em tempo real.

                            </p>

                        </div>

                    </article>


                    <article class="card feature-card">

                        <div class="card-body">

                            <div class="feature-icon">
                                🖥️
                            </div>

                            <h3 class="mt-6 text-xl font-bold">
                                Inventário
                            </h3>

                            <p class="mt-4 text-secondary">

                                Gestão completa de equipamentos,
                                salas e ativos tecnológicos.

                            </p>

                        </div>

                    </article>


                    <article class="card feature-card">

                        <div class="card-body">

                            <div class="feature-icon">
                                📊
                            </div>

                            <h3 class="mt-6 text-xl font-bold">
                                Analytics
                            </h3>

                            <p class="mt-4 text-secondary">

                                Dashboards interativos e indicadores
                                para apoio à decisão.

                            </p>

                        </div>

                    </article>


                    <article class="card feature-card">

                        <div class="card-body">

                            <div class="feature-icon">
                                📅
                            </div>

                            <h3 class="mt-6 text-xl font-bold">
                                Planeamento
                            </h3>

                            <p class="mt-4 text-secondary">

                                Agenda de intervenções e
                                manutenção preventiva.

                            </p>

                        </div>

                    </article>


                    <article class="card feature-card">

                        <div class="card-body">

                            <div class="feature-icon">
                                🤖
                            </div>

                            <h3 class="mt-6 text-xl font-bold">
                                Inteligência Artificial
                            </h3>

                            <p class="mt-4 text-secondary">

                                Apoio automático à atribuição
                                de técnicos e priorização.

                            </p>

                        </div>

                    </article>


                    <article class="card feature-card">

                        <div class="card-body">

                            <div class="feature-icon">
                                🔔
                            </div>

                            <h3 class="mt-6 text-xl font-bold">
                                Notificações
                            </h3>

                            <p class="mt-4 text-secondary">

                                Alertas em tempo real por email
                                e dentro da plataforma.

                            </p>

                        </div>

                    </article>

                </div>

            </div>

        </section>

        <section id="analytics" class="landing-section py-24">

            <div class="container mx-auto px-6 lg:px-8">

                <div class="grid gap-16 lg:grid-cols-2">

                    <div>

                        <span class="badge badge-primary">
                            Monitorização
                        </span>

                        <h2 class="mt-6 text-4xl font-black lg:text-5xl">
                            Indicadores em tempo real
                        </h2>

                        <p class="mt-6 text-lg text-secondary">

                            Visualize o desempenho da equipa técnica,
                            acompanhe a evolução das intervenções e tome
                            decisões baseadas em dados.

                        </p>

                    </div>


                    <div class="grid gap-6 sm:grid-cols-2">

                        <article class="card metric-card-large">

                            <div class="card-body">

                                <span class="metric-title">
                                    Tickets Abertos
                                </span>

                                <h3 class="metric-value-large">
                                    128
                                </h3>

                                <span class="metric-trend trend-up">
                                    +12 esta semana
                                </span>

                            </div>

                        </article>


                        <article class="card metric-card-large">

                            <div class="card-body">

                                <span class="metric-title">
                                    Resolvidos
                                </span>

                                <h3 class="metric-value-large">
                                    2 540
                                </h3>

                                <span class="metric-trend trend-up">
                                    98% concluídos
                                </span>

                            </div>

                        </article>


                        <article class="card metric-card-large">

                            <div class="card-body">

                                <span class="metric-title">
                                    Equipamentos
                                </span>

                                <h3 class="metric-value-large">
                                    1 483
                                </h3>

                                <span class="metric-trend">
                                    Inventário ativo
                                </span>

                            </div>

                        </article>


                        <article class="card metric-card-large">

                            <div class="card-body">

                                <span class="metric-title">
                                    Técnicos
                                </span>

                                <h3 class="metric-value-large">
                                    34
                                </h3>

                                <span class="metric-trend">
                                    Disponíveis hoje
                                </span>

                            </div>

                        </article>

                    </div>

                </div>


                <div class="mt-16 grid gap-6 lg:grid-cols-4">

                    <article class="card">

                        <div class="card-body">

                            <span class="metric-title">
                                Tempo Médio
                            </span>

                            <h3 class="text-4xl font-black mt-4">
                                18 min
                            </h3>

                            <p class="mt-3 text-secondary">
                                Primeira resposta
                            </p>

                        </div>

                    </article>


                    <article class="card">

                        <div class="card-body">

                            <span class="metric-title">
                                SLA
                            </span>

                            <h3 class="text-4xl font-black mt-4">
                                99,7%
                            </h3>

                            <p class="mt-3 text-secondary">
                                Cumprimento
                            </p>

                        </div>

                    </article>


                    <article class="card">

                        <div class="card-body">

                            <span class="metric-title">
                                Auditorias
                            </span>

                            <h3 class="text-4xl font-black mt-4">
                                100%
                            </h3>

                            <p class="mt-3 text-secondary">
                                Rastreabilidade
                            </p>

                        </div>

                    </article>


                    <article class="card">

                        <div class="card-body">

                            <span class="metric-title">
                                Disponibilidade
                            </span>

                            <h3 class="text-4xl font-black mt-4">
                                24/7
                            </h3>

                            <p class="mt-3 text-secondary">
                                Operacional
                            </p>

                        </div>

                    </article>

                </div>

            </div>

        </section>

        <section id="security" class="landing-section py-24">

            <div class="container mx-auto px-6 lg:px-8">

                <div class="mx-auto max-w-3xl text-center">

                    <span class="badge badge-success">
                        Fluxo Operacional
                    </span>

                    <h2 class="mt-6 text-4xl font-black lg:text-5xl">
                        Todo o ciclo de uma avaria numa única plataforma
                    </h2>

                    <p class="mt-6 text-lg text-secondary">

                        Desde a abertura do pedido até ao encerramento da intervenção,
                        todas as etapas são registadas, monitorizadas e auditadas.

                    </p>

                </div>


                <div class="mt-20 grid gap-8 lg:grid-cols-5">

                    <article class="card workflow-card">

                        <div class="card-body text-center">

                            <div class="workflow-icon">
                                👤
                            </div>

                            <h3 class="mt-6 text-xl font-bold">
                                Utilizador
                            </h3>

                            <p class="mt-4 text-secondary">

                                Reporta uma avaria e acompanha todo o processo.

                            </p>

                        </div>

                    </article>


                    <article class="card workflow-card">

                        <div class="card-body text-center">

                            <div class="workflow-icon">
                                🛠️
                            </div>

                            <h3 class="mt-6 text-xl font-bold">
                                Técnico
                            </h3>

                            <p class="mt-4 text-secondary">

                                Recebe, executa e atualiza o estado da intervenção.

                            </p>

                        </div>

                    </article>


                    <article class="card workflow-card">

                        <div class="card-body text-center">

                            <div class="workflow-icon">
                                🤖
                            </div>

                            <h3 class="mt-6 text-xl font-bold">
                                IA
                            </h3>

                            <p class="mt-4 text-secondary">

                                Sugere prioridades e auxilia a atribuição de técnicos.

                            </p>

                        </div>

                    </article>


                    <article class="card workflow-card">

                        <div class="card-body text-center">

                            <div class="workflow-icon">
                                👨‍💼
                            </div>

                            <h3 class="mt-6 text-xl font-bold">
                                Administração
                            </h3>

                            <p class="mt-4 text-secondary">

                                Aprova decisões, acompanha indicadores e gere recursos.

                            </p>

                        </div>

                    </article>


                    <article class="card workflow-card">

                        <div class="card-body text-center">

                            <div class="workflow-icon">
                                📈
                            </div>

                            <h3 class="mt-6 text-xl font-bold">
                                Relatórios
                            </h3>

                            <p class="mt-4 text-secondary">

                                Toda a atividade fica disponível para auditoria e análise.

                            </p>

                        </div>

                    </article>

                </div>


                <div class="mt-20 grid gap-8 lg:grid-cols-2">

                    <article class="card">

                        <div class="card-header">

                            <h3 class="text-2xl font-bold">
                                Segurança Empresarial
                            </h3>

                        </div>

                        <div class="card-body">

                            <ul class="space-y-4">

                                <li class="flex items-center gap-3">

                                    <span class="badge badge-success">
                                        ✓
                                    </span>

                                    Autenticação por perfis

                                </li>

                                <li class="flex items-center gap-3">

                                    <span class="badge badge-success">
                                        ✓
                                    </span>

                                    Auditoria completa das ações

                                </li>

                                <li class="flex items-center gap-3">

                                    <span class="badge badge-success">
                                        ✓
                                    </span>

                                    Gestão de permissões

                                </li>

                                <li class="flex items-center gap-3">

                                    <span class="badge badge-success">
                                        ✓
                                    </span>

                                    Histórico de intervenções

                                </li>

                            </ul>

                        </div>

                    </article>


                    <article class="card">

                        <div class="card-header">

                            <h3 class="text-2xl font-bold">
                                Tecnologias
                            </h3>

                        </div>

                        <div class="card-body">

                            <div class="flex flex-wrap gap-3">

                                <span class="badge badge-primary">Laravel 12</span>

                                <span class="badge badge-primary">MySQL</span>

                                <span class="badge badge-primary">Tailwind CSS</span>

                                <span class="badge badge-primary">JavaScript</span>

                                <span class="badge badge-primary">REST API</span>

                                <span class="badge badge-primary">OpenAPI</span>

                                <span class="badge badge-primary">Pusher</span>

                                <span class="badge badge-primary">IA</span>

                            </div>

                        </div>

                    </article>

                </div>

            </div>

        </section>

        <section id="contact" class="landing-section landing-cta py-24">

            <div class="container mx-auto px-6 lg:px-8">

                <div class="card">

                    <div class="card-body py-16">

                        <div class="mx-auto max-w-4xl text-center">

                            <span class="badge badge-primary">
                                Plataforma Pronta
                            </span>

                            <h2 class="mt-6 text-4xl font-black lg:text-5xl">

                                Comece hoje a gerir todas as avarias
                                numa única plataforma.

                            </h2>

                            <p class="mt-6 text-lg text-secondary">

                                Reduza tempos de resposta, melhore a comunicação entre
                                utilizadores e técnicos e acompanhe toda a operação
                                através de indicadores em tempo real.

                            </p>


                            <div class="mt-12 flex flex-wrap justify-center gap-4">

                                @auth

                                    <a href="{{ url('/ui') }}" class="btn btn-primary btn-lg">
                                        Abrir Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('ui.login') }}" class="btn btn-primary btn-lg">
                                        Iniciar Sessão
                                    </a>

                                @endauth


                                <a href="{{ url('/docs/openapi') }}" class="btn btn-secondary btn-lg">
                                    Documentação API
                                </a>

                            </div>


                            <div class="mt-16 grid gap-6 md:grid-cols-3">

                                <div class="cta-stat">

                                    <h3 class="text-4xl font-black">
                                        24/7
                                    </h3>

                                    <p class="mt-2 text-secondary">
                                        Monitorização
                                    </p>

                                </div>


                                <div class="cta-stat">

                                    <h3 class="text-4xl font-black">
                                        REST
                                    </h3>

                                    <p class="mt-2 text-secondary">
                                        API OpenAPI
                                    </p>

                                </div>


                                <div class="cta-stat">

                                    <h3 class="text-4xl font-black">
                                        IA
                                    </h3>

                                    <p class="mt-2 text-secondary">
                                        Assistência Inteligente
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        <footer class="landing-footer py-16">

            <div class="container mx-auto px-6 lg:px-8">

                <div class="grid gap-12 lg:grid-cols-4">

                    <div>

                        <div class="flex items-center gap-4">

                            <div class="brand-logo">

                                <span>GA</span>

                            </div>

                            <div>

                                <h3 class="text-xl font-bold">
                                    {{ config('app.name', 'Gestão de Avarias') }}
                                </h3>

                                <p class="text-secondary">
                                    Plataforma Enterprise
                                </p>

                            </div>

                        </div>

                        <p class="mt-6 text-secondary">

                            Plataforma desenvolvida para centralizar
                            a gestão de avarias, manutenção preventiva,
                            inventário e indicadores operacionais.

                        </p>

                    </div>


                    <div>

                        <h4 class="text-lg font-semibold">
                            Plataforma
                        </h4>

                        <ul class="mt-6 space-y-3">

                            <li>

                                <a href="#features" class="footer-link">
                                    Funcionalidades
                                </a>

                            </li>

                            <li>

                                <a href="#analytics" class="footer-link">
                                    Analytics
                                </a>

                            </li>

                            <li>

                                <a href="#security" class="footer-link">
                                    Segurança
                                </a>

                            </li>

                            <li>

                                <a href="{{ url('/docs/openapi') }}" class="footer-link">
                                    API
                                </a>

                            </li>

                        </ul>

                    </div>


                    <div>

                        <h4 class="text-lg font-semibold">
                            Tecnologias
                        </h4>

                        <div class="mt-6 flex flex-wrap gap-2">

                            <span class="badge badge-primary">
                                Laravel
                            </span>

                            <span class="badge badge-primary">
                                PHP
                            </span>

                            <span class="badge badge-primary">
                                MySQL
                            </span>

                            <span class="badge badge-primary">
                                Tailwind
                            </span>

                            <span class="badge badge-primary">
                                JavaScript
                            </span>

                            <span class="badge badge-primary">
                                REST API
                            </span>

                        </div>

                    </div>


                    <div>

                        <h4 class="text-lg font-semibold">
                            Estado do Sistema
                        </h4>

                        <div class="mt-6 space-y-4">

                            <div class="flex items-center justify-between">

                                <span class="text-secondary">
                                    Plataforma
                                </span>

                                <span class="badge badge-success">
                                    Online
                                </span>

                            </div>

                            <div class="flex items-center justify-between">

                                <span class="text-secondary">
                                    API
                                </span>

                                <span class="badge badge-success">
                                    Ativa
                                </span>

                            </div>

                            <div class="flex items-center justify-between">

                                <span class="text-secondary">
                                    Monitorização
                                </span>

                                <span class="badge badge-success">
                                    24/7
                                </span>

                            </div>

                        </div>

                    </div>

                </div>


                <div
                    class="mt-16 flex flex-col gap-6 border-t border-default pt-8 lg:flex-row lg:items-center lg:justify-between">

                    <p class="text-sm text-secondary">

                        © {{ date('Y') }}
                        {{ config('app.name', 'Gestão de Avarias') }}.
                        Todos os direitos reservados.

                    </p>

                    <div class="flex items-center gap-4 text-sm text-secondary">

                        <span>
                            Laravel 12
                        </span>

                        <span>•</span>

                        <span>
                            Versão 1.0
                        </span>

                    </div>

                </div>

            </div>

        </footer>

    </main>

</body>

</html>
