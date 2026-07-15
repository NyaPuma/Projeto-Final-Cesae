@extends('layouts.layout')

@section('content')

<div class="dashboard-page">

    <div class="container mx-auto max-w-7xl px-6 py-8">

        <header class="dashboard-header">

            <div class="flex flex-col gap-8 lg:flex-row lg:items-center lg:justify-between">

                <div>

                    <span class="badge badge-warning">

                        <span class="status-dot"></span>

                        Painel Principal

                    </span>

                    <h1 class="mt-6 text-5xl font-black tracking-tight">

                        Centro de Controlo Operacional

                    </h1>

                    <p class="mt-6 max-w-3xl text-lg text-secondary">

                        Gerencie ocorrências, equipamentos,
                        utilizadores, auditorias e toda a
                        infraestrutura através de um único painel.

                    </p>

                </div>


                <div class="flex flex-wrap items-center gap-3">

                    <button
                        id="theme-toggle"
                        type="button"
                        class="btn btn-secondary btn-icon"
                        aria-label="Alternar tema"
                    >

                        <span class="theme-icon">🌙</span>

                    </button>


                    <div
                        id="landingAuthActions"
                        class="flex flex-wrap items-center gap-3"
                    >

                    </div>

                </div>

            </div>

        </header>

                <section class="dashboard-overview mt-12">

            <div class="grid gap-6 xl:grid-cols-4">

                <article class="card stat-card">

                    <div class="card-body">

                        <span class="stat-label">
                            Tickets Abertos
                        </span>

                        <h2 class="stat-value">
                            126
                        </h2>

                        <span class="stat-change positive">
                            ▲ +8 hoje
                        </span>

                    </div>

                </article>


                <article class="card stat-card">

                    <div class="card-body">

                        <span class="stat-label">
                            Equipamentos
                        </span>

                        <h2 class="stat-value">
                            847
                        </h2>

                        <span class="stat-change">
                            Inventário ativo
                        </span>

                    </div>

                </article>


                <article class="card stat-card">

                    <div class="card-body">

                        <span class="stat-label">
                            Utilizadores
                        </span>

                        <h2 class="stat-value">
                            42
                        </h2>

                        <span class="stat-change">
                            Contas ativas
                        </span>

                    </div>

                </article>


                <article class="card stat-card">

                    <div class="card-body">

                        <span class="stat-label">
                            Disponibilidade
                        </span>

                        <h2 class="stat-value text-success">
                            99.9%
                        </h2>

                        <span class="stat-change">
                            Sistema operacional
                        </span>

                    </div>

                </article>

            </div>

        </section>

                <section class="dashboard-modules mt-12">

            <div class="grid gap-8 lg:grid-cols-2 xl:grid-cols-3">

                <a
                    href="/ui/tickets"
                    class="card module-card"
                >

                    <div class="card-body">

                        <div class="flex items-start justify-between">

                            <div class="module-icon">
                                🎫
                            </div>

                            <span class="module-arrow">
                                →
                            </span>

                        </div>

                        <h2 class="mt-8 text-2xl font-bold">
                            Tickets
                        </h2>

                        <p class="mt-4 text-secondary">

                            Consultar ocorrências, criar novos pedidos,
                            acompanhar estados e histórico das intervenções.

                        </p>

                    </div>

                </a>


                <a
                    href="/ui/equipments"
                    class="card module-card"
                >

                    <div class="card-body">

                        <div class="flex items-start justify-between">

                            <div class="module-icon">
                                🖥️
                            </div>

                            <span class="module-arrow">
                                →
                            </span>

                        </div>

                        <h2 class="mt-8 text-2xl font-bold">
                            Equipamentos
                        </h2>

                        <p class="mt-4 text-secondary">

                            Inventário completo, ativos tecnológicos,
                            salas e informação técnica.

                        </p>

                    </div>

                </a>


                <a
                    href="/ui/users"
                    class="card module-card"
                >

                    <div class="card-body">

                        <div class="flex items-start justify-between">

                            <div class="module-icon">
                                👥
                            </div>

                            <span class="module-arrow">
                                →
                            </span>

                        </div>

                        <h2 class="mt-8 text-2xl font-bold">
                            Utilizadores
                        </h2>

                        <p class="mt-4 text-secondary">

                            Gestão de contas, equipas,
                            permissões e perfis de acesso.

                        </p>

                    </div>

                </a>


                <a
                    href="/ui/audits"
                    class="card module-card"
                >

                    <div class="card-body">

                        <div class="flex items-start justify-between">

                            <div class="module-icon">
                                📝
                            </div>

                            <span class="module-arrow">
                                →
                            </span>

                        </div>

                        <h2 class="mt-8 text-2xl font-bold">
                            Auditoria
                        </h2>

                        <p class="mt-4 text-secondary">

                            Histórico de alterações,
                            rastreabilidade e conformidade.

                        </p>

                    </div>

                </a>


                <a
                    href="/ui/analytics"
                    class="card module-card"
                >

                    <div class="card-body">

                        <div class="flex items-start justify-between">

                            <div class="module-icon">
                                📊
                            </div>

                            <span class="module-arrow">
                                →
                            </span>

                        </div>

                        <h2 class="mt-8 text-2xl font-bold">
                            Analytics
                        </h2>

                        <p class="mt-4 text-secondary">

                            Dashboards, KPIs,
                            indicadores e relatórios operacionais.

                        </p>

                    </div>

                </a>


                <a
                    href="/calendar"
                    class="card module-card"
                >

                    <div class="card-body">

                        <div class="flex items-start justify-between">

                            <div class="module-icon">
                                📅
                            </div>

                            <span class="module-arrow">
                                →
                            </span>

                        </div>

                        <h2 class="mt-8 text-2xl font-bold">
                            Agenda
                        </h2>

                        <p class="mt-4 text-secondary">

                            Planeamento de intervenções,
                            manutenção preventiva e calendário global.

                        </p>

                    </div>

                </a>

            </div>

        </section>

                <section class="dashboard-status mt-14">

            <div class="card">

                <div class="grid gap-0 lg:grid-cols-2">

                    <div class="card-body p-10 lg:p-12">

                        <span class="badge badge-success">
                            Estado do Sistema
                        </span>

                        <h2 class="mt-6 text-4xl font-black">

                            Todos os serviços operacionais

                        </h2>

                        <p class="mt-6 text-lg text-secondary leading-8">

                            A infraestrutura encontra-se operacional, com
                            sincronização contínua entre clientes, API,
                            WebSockets e base de dados.

                        </p>


                        <div class="mt-10 space-y-8">

                            <div>

                                <div class="mb-2 flex items-center justify-between">

                                    <span class="font-medium">
                                        API REST
                                    </span>

                                    <span class="text-secondary">
                                        100%
                                    </span>

                                </div>

                                <div class="progress">

                                    <div
                                        class="progress-bar bg-success"
                                        style="width:100%"
                                    ></div>

                                </div>

                            </div>


                            <div>

                                <div class="mb-2 flex items-center justify-between">

                                    <span class="font-medium">
                                        Base de Dados
                                    </span>

                                    <span class="text-secondary">
                                        99%
                                    </span>

                                </div>

                                <div class="progress">

                                    <div
                                        class="progress-bar bg-primary"
                                        style="width:99%"
                                    ></div>

                                </div>

                            </div>


                            <div>

                                <div class="mb-2 flex items-center justify-between">

                                    <span class="font-medium">
                                        WebSockets
                                    </span>

                                    <span class="text-secondary">
                                        100%
                                    </span>

                                </div>

                                <div class="progress">

                                    <div
                                        class="progress-bar bg-warning"
                                        style="width:100%"
                                    ></div>

                                </div>

                            </div>


                            <div>

                                <div class="mb-2 flex items-center justify-between">

                                    <span class="font-medium">
                                        Backups
                                    </span>

                                    <span class="text-secondary">
                                        100%
                                    </span>

                                </div>

                                <div class="progress">

                                    <div
                                        class="progress-bar"
                                        style="width:100%"
                                    ></div>

                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="border-l border-default">

                        <div class="grid h-full gap-6 p-10 md:grid-cols-2">

                            <article class="card metric-card">

                                <div class="card-body text-center">

                                    <h3 class="metric-value-large">
                                        24/7
                                    </h3>

                                    <p class="metric-label mt-3">
                                        Monitorização
                                    </p>

                                </div>

                            </article>


                            <article class="card metric-card">

                                <div class="card-body text-center">

                                    <h3 class="metric-value-large">
                                        TLS
                                    </h3>

                                    <p class="metric-label mt-3">
                                        Segurança
                                    </p>

                                </div>

                            </article>


                            <article class="card metric-card">

                                <div class="card-body text-center">

                                    <h3 class="metric-value-large">
                                        API
                                    </h3>

                                    <p class="metric-label mt-3">
                                        Integração
                                    </p>

                                </div>

                            </article>


                            <article class="card metric-card">

                                <div class="card-body text-center">

                                    <h3 class="metric-value-large">
                                        99.9%
                                    </h3>

                                    <p class="metric-label mt-3">
                                        Disponibilidade
                                    </p>

                                </div>

                            </article>

                        </div>

                    </div>

                </div>

            </div>

        </section>

                <footer class="dashboard-footer mt-16">

            <div class="card">

                <div class="card-body">

                    <div class="grid gap-12 lg:grid-cols-4">

                        <div>

                            <div class="flex items-center gap-4">

                                <div class="brand-logo">

                                    <span>GA</span>

                                </div>

                                <div>

                                    <h3 class="text-xl font-bold">
                                        Central de Operações
                                    </h3>

                                    <p class="text-secondary">
                                        Plataforma Enterprise
                                    </p>

                                </div>

                            </div>

                            <p class="mt-6 text-secondary leading-7">

                                Plataforma desenvolvida para centralizar a
                                gestão de avarias, equipamentos, utilizadores,
                                auditorias, calendário operacional e análise
                                da infraestrutura.

                            </p>

                        </div>


                        <div>

                            <h4 class="text-lg font-semibold">
                                Plataforma
                            </h4>

                            <nav class="mt-6 space-y-3">

                                <a
                                    href="/ui"
                                    class="footer-link"
                                >
                                    Dashboard
                                </a>

                                <a
                                    href="/ui/tickets"
                                    class="footer-link"
                                >
                                    Tickets
                                </a>

                                <a
                                    href="/ui/equipments"
                                    class="footer-link"
                                >
                                    Equipamentos
                                </a>

                            </nav>

                        </div>


                        <div>

                            <h4 class="text-lg font-semibold">
                                Gestão
                            </h4>

                            <nav class="mt-6 space-y-3">

                                <a
                                    href="/ui/users"
                                    class="footer-link"
                                >
                                    Utilizadores
                                </a>

                                <a
                                    href="/ui/audits"
                                    class="footer-link"
                                >
                                    Auditoria
                                </a>

                                <a
                                    href="/ui/analytics"
                                    class="footer-link"
                                >
                                    Analytics
                                </a>

                                <a
                                    href="/calendar"
                                    class="footer-link"
                                >
                                    Agenda
                                </a>

                            </nav>

                        </div>


                        <div>

                            <h4 class="text-lg font-semibold">
                                Estado
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
                                        Operacional
                                    </span>

                                </div>

                                <div class="flex items-center justify-between">

                                    <span class="text-secondary">
                                        Segurança
                                    </span>

                                    <span class="badge badge-success">
                                        TLS
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="mt-12 border-t border-default pt-8">

                        <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

                            <p class="text-sm text-secondary">

                                © {{ date('Y') }}
                                Central de Operações.
                                Todos os direitos reservados.

                            </p>

                            <div class="flex flex-wrap items-center gap-4 text-sm text-secondary">

                                <span>Laravel 12</span>

                                <span>•</span>

                                <span>Tailwind CSS</span>

                                <span>•</span>

                                <span>Pusher</span>

                                <span>•</span>

                                <span>Enterprise UI</span>

                                <span>•</span>

                                <span>v2.4.0</span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </footer>

            </div>

</div>

@endsection

@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', () => {

    /*
    |--------------------------------------------------------------------------
    | Alternância de Tema
    |--------------------------------------------------------------------------
    */

    const themeButton = document.getElementById('theme-toggle');

    if (themeButton) {

        themeButton.addEventListener('click', () => {

            if (window.toggleTheme) {

                window.toggleTheme();

            } else {

                const html = document.documentElement;

                const dark = html.classList.toggle('dark');

                localStorage.setItem(
                    'theme',
                    dark ? 'dark' : 'light'
                );

            }

        });

    }


    /*
    |--------------------------------------------------------------------------
    | Ações de Autenticação
    |--------------------------------------------------------------------------
    */

    const authContainer = document.getElementById('landingAuthActions');

    if (!authContainer) {
        return;
    }

    const token = localStorage.getItem('api_token');

    if (token) {

        const userName =
            localStorage.getItem('user_name') ??
            'Utilizador';

        authContainer.innerHTML = `

            <a
                href="/ui/profile"
                class="btn btn-secondary"
            >
                ${userName}
            </a>

            <a
                href="/ui"
                class="btn btn-primary"
            >
                Abrir Painel
            </a>

        `;

    } else {

        authContainer.innerHTML = `

            <a
                href="/ui/login"
                class="btn btn-secondary"
            >
                Iniciar Sessão
            </a>

            <a
                href="/"
                class="btn btn-primary"
            >
                Página Inicial
            </a>

        `;

    }

});

</script>

@endpush
