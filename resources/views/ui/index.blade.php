@extends('ui.layout')

@section('content')
<script>
// Marcar que esta página requer autenticação obrigatória
window.requireAuthOnLoad = true;
</script>

@php
    $profileName = $user->profile->name ?? 'user';
    $isAdmin = $profileName === 'admin';

    $profileLabel = match ($profileName) {
        'admin' => __('Administrador'),
        'technician' => __('Técnico'),
        default => __('Funcionário'),
    };
@endphp


@component('ui.partials.page-card', [
    'title' => __('Painel Operacional'),
    'subtitle' => __('Selecione uma dimensão do sistema para monitorização e gestão de ativos.'),
    'actions' => ''
])
    <div class="mb-6 rounded-2xl border border-[var(--border)] bg-[var(--surface-2)]/70 p-5 shadow-[0_10px_30px_rgba(15,23,42,0.04)]">
        <div class="flex flex-col gap-3 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-[10px] font-bold uppercase tracking-[0.3em] text-[var(--text-soft)]">{{ __('Sessão ativa') }}</p>
                <h2 class="mt-2 text-lg font-semibold text-[var(--text)]">
                    {{ __('Olá, :name.', ['name' => $user->name ?? __('utilizador')]) }}
                </h2>
                <p class="mt-2 text-sm text-[var(--text-soft)]">
                    {{ __('Perfil atual: :profile. Aceda aos módulos conforme as permissões do seu papel.', ['profile' => $profileLabel]) }}
                </p>
            </div>
            <span class="inline-flex w-fit items-center rounded-full border border-primary/20 bg-primary/10 px-3 py-1.5 text-xs font-bold text-primary">
                {{ $profileLabel }} • {{ __('Acesso seguro') }}
            </span>
        </div>
    </div>

    {{-- Contentor Dinâmico de Métricas (Renderizado via JS) --}}
    @if($isAdmin)
        <div id="metricsPanel" class="mb-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4"></div>
    @else
        <div class="mb-8 rounded-2xl border border-dashed border-[var(--border)] bg-[var(--surface-2)] p-5 col-span-full text-center">
            <p class="text-xs text-[var(--text-soft)]">{{ __('Métricas disponíveis apenas para Administrador.') }}</p>
        </div>
    @endif


    <div class="mb-5 flex items-center justify-between">
        <div>
            <p class="text-[10px] font-bold uppercase tracking-[0.3em] text-[var(--text-soft)]">{{ __('Módulos') }}</p>
            <h2 class="mt-2 text-xl font-semibold tracking-tight text-[var(--text)]">{{ __('Acesso rápido ao ecossistema operacional') }}</h2>
        </div>
    </div>

    {{-- Grelha de Navegação Estruturada --}}
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3" role="list" aria-label="{{ __('Módulos principais do sistema') }}">

        {{-- Card: Tickets --}}
        <a href="{{ route('ui.tickets') }}" role="listitem" class="premium-card group rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-[0_1px_2px_rgba(0,0,0,0.01)] transition-all duration-300 hover:-translate-y-1 hover:border-[var(--text)]/20 hover:shadow-[0_16px_40px_rgba(15,23,42,0.08)]">
            <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl bg-amber-500/10 text-xl">🎫</div>
            <h3 class="text-sm font-semibold tracking-tight text-[var(--text)]">{{ __('Tickets de Ocorrência') }}</h3>
            <p class="mt-1.5 text-xs leading-relaxed text-[var(--text-soft)]">{{ __('Consultar, triar, atribuir responsabilidades e acompanhar o progresso em tempo real das avarias registadas.') }}</p>
        </a>

        {{-- Card: Equipamentos --}}
        <a href="{{ route('ui.equipments') }}" role="listitem" class="premium-card group rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-[0_1px_2px_rgba(0,0,0,0.01)] transition-all duration-300 hover:-translate-y-1 hover:border-[var(--text)]/20 hover:shadow-[0_16px_40px_rgba(15,23,42,0.08)]">
            <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl bg-blue-500/10 text-xl">🖥️</div>
            <h3 class="text-sm font-semibold tracking-tight text-[var(--text)]">{{ __('Frota de Equipamentos') }}</h3>
            <p class="mt-1.5 text-xs leading-relaxed text-[var(--text-soft)]">{{ __('Mapear o inventário de ativos tecnológicos, histórico de manutenções e respetiva alocação física por salas.') }}</p>
        </a>



        {{-- Card: Agenda --}}
        <a href="{{ route('calendar.view') }}" role="listitem" class="premium-card group rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-[0_1px_2px_rgba(0,0,0,0.01)] transition-all duration-300 hover:-translate-y-1 hover:border-[var(--text)]/20 hover:shadow-[0_16px_40px_rgba(15,23,42,0.08)]">
            <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl bg-cyan-500/10 text-xl">📅</div>
            <h3 class="text-sm font-semibold tracking-tight text-[var(--text)]">{{ __('Agenda de Manutenções') }}</h3>
            <p class="mt-1.5 text-xs leading-relaxed text-[var(--text-soft)]">{{ __('Visualizar planeamentos operacionais numa vista cronológica dedicada para otimização do fluxo de trabalho.') }}</p>
        </a>

        @if($isAdmin)
            {{-- Card: Utilizadores --}}
            <a href="{{ route('ui.users') }}" role="listitem" class="premium-card group rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-[0_1px_2px_rgba(0,0,0,0.01)] transition-all duration-300 hover:-translate-y-1 hover:border-[var(--text)]/20 hover:shadow-[0_16px_40px_rgba(15,23,42,0.08)]">
                <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl bg-violet-500/10 text-xl">👥</div>
                <h3 class="text-sm font-semibold tracking-tight text-[var(--text)]">{{ __('Utilizadores e Perfis') }}</h3>
                <p class="mt-1.5 text-xs leading-relaxed text-[var(--text-soft)]">{{ __('Gerir credenciais de acesso, perfis de privilégios (administradores, técnicos, utilizadores) e equipas de piquete.') }}</p>
            </a>

            {{-- Card: Auditoria --}}
            <a href="{{ route('ui.audits') }}" role="listitem" class="premium-card group rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-[0_1px_2px_rgba(0,0,0,0.01)] transition-all duration-300 hover:-translate-y-1 hover:border-[var(--text)]/20 hover:shadow-[0_16px_40px_rgba(15,23,42,0.08)]">
                <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl bg-rose-500/10 text-xl">📝</div>
                <h3 class="text-sm font-semibold tracking-tight text-[var(--text)]">{{ __('Registos de Auditoria') }}</h3>
                <p class="mt-1.5 text-xs leading-relaxed text-[var(--text-soft)]">{{ __('Rastreabilidade total das ações do sistema. Rever logs imutáveis, alterações de estado e históricos de segurança.') }}</p>
            </a>

            {{-- Card Distinto: Analytics --}}
            <a href="{{ route('ui.analytics') }}" role="listitem" class="premium-card group rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-[0_1px_2px_rgba(0,0,0,0.01)] transition-all duration-300 hover:-translate-y-1 hover:border-indigo-500/50 dark:hover:border-indigo-400/50 hover:ring-indigo-500/10 dark:hover:ring-indigo-400/10">
                <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-500/10 text-xl">📈</div>
            <h3 class="flex items-center gap-1.5 text-sm font-semibold tracking-tight text-[var(--text)]">
                    {{ __('Analytics & Relatórios') }}
                    <span class="inline-flex items-center rounded border border-indigo-500/20 bg-indigo-500/10 px-1.5 py-0.5 text-[9px] font-medium text-indigo-600 dark:border-indigo-400/20 dark:bg-indigo-400/10 dark:text-indigo-400">KPIs</span>
            </h3>
            <p class="mt-1.5 text-xs leading-relaxed text-[var(--text-soft)]">{{ __('Gráficos avançados de desempenho, tempos médios de resposta (SLA) e ferramentas para exportação analítica.') }}</p>

            </a>
        @endif

    </div>


@endcomponent
@endsection

@push('scripts')
<script>
async function loadMetrics() {
    // Painel de métricas: apenas admin vê (técnicos/utilizadores não)
    const userRole = '{{ $user->profile->name ?? "" }}';


    const panel = document.getElementById('metricsPanel');

    if (!panel) return;

    if (userRole !== 'admin') {
        panel.innerHTML = `

            <div class="rounded-xl border border-dashed border-[var(--border)] bg-[var(--surface-2)] p-5 col-span-full text-center">
                <p class="text-xs text-[var(--text-soft)]">${"{{ __('Painel de métricas operacionais disponível apenas para perfis autorizados (Técnicos/Gestores).') }}"}</p>
            </div>
        `;
        return;
    }

    // Feedback de carregamento inicial assíncrono
    panel.innerHTML = `
        <div class="col-span-full text-xs text-[var(--text-soft)] animate-pulse" aria-live="polite">
            ${"{{ __('A ler indicadores analíticos em tempo real...') }}"}
        </div>
    `;

    try {
        const res = await fetch('/analytics', { headers: authHeader() });
        if (!res.ok) throw new Error('Falha na comunicação de dados');

        const data = await res.json();

        // Translate labels in JS dynamically
        const metrics = [
            ["{{ __('Tempo médio de resolução') }}", `${data.average_resolution_minutes ?? 0} min`],
            ["{{ __('Tempo médio de espera') }}", `${data.average_waiting_minutes ?? 0} min`],
            ["{{ __('Tickets em aberto') }}", `${data.open_tickets ?? 0}`],
            ["{{ __('Tickets fechados') }}", `${data.closed_tickets ?? 0}`],
        ];

        panel.innerHTML = metrics.map(([label, value]) => `
            <div class="rounded-xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-[0_1px_2px_rgba(0,0,0,0.01)] animate-[fadeIn_0.3s_ease-out]">
                <p class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">${label}</p>
                <p class="mt-2 text-2xl font-semibold tracking-tight text-[var(--text)]">${value}</p>
            </div>
        `).join('');

    } catch (err) {
        panel.innerHTML = `
            <div class="rounded-xl border border-red-500/20 bg-red-500/5 p-4 col-span-full text-xs text-red-600 dark:text-red-400">
                ${"{{ __('Não foi possível carregar os indicadores analíticos do servidor.') }}"}
            </div>
        `;
    }
}

// Inicialização segura após o carregamento completo do DOM
window.addEventListener('DOMContentLoaded', loadMetrics);
</script>
@endpush
