@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-[var(--bg)] text-[var(--text)] antialiased">
    <div class="mx-auto max-w-7xl px-6 py-8 lg:px-8 lg:py-10">
        @component('ui.partials.page-card', [
            'title' => 'Centro de Controlo Operacional',
            'subtitle' => 'Gerir ocorrências, equipamentos, utilizadores, auditorias e agenda numa experiência uniforme e acessível.',
            'badge' => 'Painel principal',
            'actions' => '<div class="flex flex-wrap gap-2"><a href="/ui/login" class="ui-button inline-flex items-center rounded-2xl border border-[var(--border)] bg-[var(--surface)] px-3 py-2 text-sm font-semibold text-[var(--text)] transition hover:bg-[var(--surface-2)]">Iniciar sessão</a><a href="/ui" class="ui-button inline-flex items-center rounded-2xl bg-primary px-3 py-2 text-sm font-semibold text-black transition hover:opacity-90">Abrir painel</a></div>'
        ])
            <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
                @php($stats = [
                    ['label' => 'Tickets abertos', 'value' => '126', 'hint' => '▲ +8 hoje'],
                    ['label' => 'Equipamentos', 'value' => '847', 'hint' => 'Inventário ativo'],
                    ['label' => 'Utilizadores', 'value' => '42', 'hint' => 'Contas ativas'],
                    ['label' => 'Disponibilidade', 'value' => '99.9%', 'hint' => 'Sistema operacional'],
                ])
                @foreach($stats as $stat)
                    <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm">
                        <p class="text-[10px] font-bold uppercase tracking-[0.25em] text-[var(--text-soft)]">{{ $stat['label'] }}</p>
                        <p class="mt-3 text-3xl font-black tracking-tight text-[var(--text)]">{{ $stat['value'] }}</p>
                        <p class="mt-2 text-sm text-[var(--text-soft)]">{{ $stat['hint'] }}</p>
                    </div>
                @endforeach
            </div>

            <div class="mt-8 grid gap-4 lg:grid-cols-2 xl:grid-cols-3">
                @php($modules = [
                    ['href' => '/ui/tickets', 'icon' => '🎫', 'title' => 'Tickets', 'description' => 'Consultar ocorrências e acompanhar estados em tempo real.'],
                    ['href' => '/ui/equipments', 'icon' => '🖥️', 'title' => 'Equipamentos', 'description' => 'Inventário completo, salas e informação técnica.'],
                    ['href' => '/ui/users', 'icon' => '👥', 'title' => 'Utilizadores', 'description' => 'Gestão de contas, equipas e acessos.'],
                    ['href' => '/ui/audits', 'icon' => '📝', 'title' => 'Auditoria', 'description' => 'Histórico de alterações e rastreabilidade.'],
                    ['href' => '/ui/analytics', 'icon' => '📊', 'title' => 'Analytics', 'description' => 'Indicadores e relatórios operacionais.'],
                    ['href' => '/calendar', 'icon' => '📅', 'title' => 'Agenda', 'description' => 'Planeamento de intervenções e manutenção.'],
                ])
                @foreach($modules as $module)
                    <a href="{{ $module['href'] }}" class="group rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm transition duration-200 hover:-translate-y-1 hover:border-[var(--text)]/20 hover:shadow-[0_18px_40px_rgba(15,23,42,0.08)]">
                        <div class="flex items-start justify-between">
                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-primary/10 text-xl">{{ $module['icon'] }}</div>
                            <span class="text-sm font-semibold text-[var(--text-soft)] transition group-hover:text-[var(--text)]">→</span>
                        </div>
                        <h2 class="mt-6 text-xl font-semibold tracking-tight text-[var(--text)]">{{ $module['title'] }}</h2>
                        <p class="mt-3 text-sm leading-7 text-[var(--text-soft)]">{{ $module['description'] }}</p>
                    </a>
                @endforeach
            </div>

            <div class="mt-8 rounded-2xl border border-[var(--border)] bg-[var(--surface-2)]/70 p-6">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-[0.25em] text-[var(--text-soft)]">Estado do sistema</p>
                        <h3 class="mt-2 text-2xl font-semibold tracking-tight text-[var(--text)]">Todos os serviços operacionais</h3>
                        <p class="mt-2 max-w-2xl text-sm leading-7 text-[var(--text-soft)]">A infraestrutura encontra-se operacional, com sincronização contínua entre clientes, API, WebSockets e base de dados.</p>
                    </div>
                    <div class="inline-flex items-center rounded-full border border-emerald-500/20 bg-emerald-500/10 px-3 py-1.5 text-sm font-semibold text-emerald-600 dark:text-emerald-400">Online • Seguro</div>
                </div>
            </div>
        @endcomponent
    </div>
</div>
@endsection
