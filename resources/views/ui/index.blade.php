@extends('ui.layout')

@section('page_key', 'dashboard')

@section('content')
@php
    $profileName = $user->profile->name ?? 'user';
    $isAdmin = $profileName === 'admin';

    $profileLabel = match ($profileName) {
        'admin' => __('Administrador'),
        'technician' => __('Técnico'),
        default => __('Funcionário'),
    };
@endphp

<x-ui.partials.page-card
    :title="__('Painel Operacional')"
    :subtitle="__('Selecione uma dimensão do sistema para monitorização e gestão de ativos.')"
>
    <meta name="user-role" content="{{ $user->profile->name ?? '' }}">
    <x-ui.dashboard.welcome-panel :user-name="$user->name ?? __('utilizador')" :profile-label="$profileLabel" />

    @if($isAdmin)
        <div id="metricsPanel" class="ui-dashboard-metrics mb-8"></div>
    @else
        <div class="mb-8 rounded-2xl border border-dashed border-[var(--border)] bg-[var(--surface-2)] p-5 col-span-full text-center">
            <p class="text-xs text-[var(--text-soft)]">{{ __('Métricas disponíveis apenas para Administrador.') }}</p>
        </div>
    @endif

    <div class="mb-5 flex items-center justify-between">
        <div>
            <x-ui.text.eyebrow as="p" size="xs" tracking="widest" class="font-bold">{{ __('Módulos') }}</x-ui.text.eyebrow>
            <h2 class="mt-2 text-xl font-semibold tracking-tight text-[var(--text)]">{{ __('Acesso rápido ao ecossistema operacional') }}</h2>
        </div>
    </div>

    <div class="ui-dashboard-grid" role="list" aria-label="{{ __('Módulos principais do sistema') }}">
        <x-ui.dashboard.module-card role="listitem" :href="route('ui.tickets')" icon="🎫" :title="__('Tickets de Ocorrência')" :description="__('Consultar, triar, atribuir responsabilidades e acompanhar o progresso em tempo real das avarias registadas.')" accent="bg-amber-500/10" />

        <x-ui.dashboard.module-card role="listitem" :href="route('ui.equipments')" icon="🖥️" :title="__('Frota de Equipamentos')" :description="__('Mapear o inventário de ativos tecnológicos, histórico de manutenções e respetiva alocação física por salas.')" accent="bg-blue-500/10" />

        <x-ui.dashboard.module-card role="listitem" :href="route('calendar.view')" icon="📅" :title="__('Agenda de Manutenções')" :description="__('Visualizar planeamentos operacionais numa vista cronológica dedicada para otimização do fluxo de trabalho.')" accent="bg-cyan-500/10" />

        @if($isAdmin)
            <x-ui.dashboard.module-card role="listitem" :href="route('ui.users')" icon="👥" :title="__('Utilizadores e Perfis')" :description="__('Gerir credenciais de acesso, perfis de privilégios (administradores, técnicos, utilizadores) e equipas de piquete.')" accent="bg-violet-500/10" />

            <x-ui.dashboard.module-card role="listitem" :href="route('ui.audits')" icon="📝" :title="__('Registos de Auditoria')" :description="__('Rastreabilidade total das ações do sistema. Rever logs imutáveis, alterações de estado e históricos de segurança.')" accent="bg-rose-500/10" />

            <x-ui.dashboard.module-card role="listitem" :href="route('ui.analytics')" icon="📈" :title="__('Analytics & Relatórios')" :description="__('Gráficos avançados de desempenho, tempos médios de resposta (SLA) e ferramentas para exportação analítica.')" accent="bg-emerald-500/10" :badge="'KPIs'" hover="hover:border-indigo-500/50 hover:ring-1 hover:ring-indigo-500/10 dark:hover:border-indigo-400/50 dark:hover:ring-indigo-400/10" />
        @endif
    </div>
</x-ui.partials.page-card>
@endsection
