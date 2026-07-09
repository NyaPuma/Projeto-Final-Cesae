@extends('ui.layout')

@section('content')
<script>
// Marcar que esta página requer autenticação obrigatória
window.requireAuthOnLoad = true;
</script>

@component('ui.partials.page-card', [
    'title' => 'Painel Operacional',
    'subtitle' => 'Selecione uma dimensão do sistema para monitorização e gestão de ativos.',
    'actions' => ''
])
    {{-- Contentor Dinâmico de Métricas (Renderizado via JS) --}}
    <div id="metricsPanel" class="mb-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4"></div>

    {{-- Grelha de Navegação Estruturada --}}
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">

        {{-- Card: Tickets --}}
        <a href="/ui/tickets" class="group rounded-xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-[0_1px_2px_rgba(0,0,0,0.01)] hover:border-[var(--text)] transition-all duration-200">
            <h3 class="text-sm font-semibold tracking-tight text-[var(--text)]">Tickets de Ocorrência</h3>
            <p class="mt-1.5 text-xs text-[var(--text-soft)] leading-relaxed">Consultar, triar, atribuir responsabilidades e acompanhar o progresso em tempo real das avarias registadas.</p>
        </a>

        {{-- Card: Equipamentos --}}
        <a href="/ui/equipments" class="group rounded-xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-[0_1px_2px_rgba(0,0,0,0.01)] hover:border-[var(--text)] transition-all duration-200">
            <h3 class="text-sm font-semibold tracking-tight text-[var(--text)]">Frota de Equipamentos</h3>
            <p class="mt-1.5 text-xs text-[var(--text-soft)] leading-relaxed">Mapear o inventário de ativos tecnológicos, histórico de manutenções e respetiva alocação física por salas.</p>
        </a>

        {{-- Card: Utilizadores --}}
        <a href="/ui/users" class="group rounded-xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-[0_1px_2px_rgba(0,0,0,0.01)] hover:border-[var(--text)] transition-all duration-200">
            <h3 class="text-sm font-semibold tracking-tight text-[var(--text)]">Utilizadores e Perfis</h3>
            <p class="mt-1.5 text-xs text-[var(--text-soft)] leading-relaxed">Gerir credenciais de acesso, perfis de privilégios (administradores, técnicos, utilizadores) e equipas de piquete.</p>
        </a>

        {{-- Card: Auditoria --}}
        <a href="/ui/audits" class="group rounded-xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-[0_1px_2px_rgba(0,0,0,0.01)] hover:border-[var(--text)] transition-all duration-200">
            <h3 class="text-sm font-semibold tracking-tight text-[var(--text)]">Registos de Auditoria</h3>
            <p class="mt-1.5 text-xs text-[var(--text-soft)] leading-relaxed">Rastreabilidade total das ações do sistema. Rever logs imutáveis, alterações de estado e históricos de segurança.</p>
        </a>

        {{-- Card: Agenda --}}
        <a href="/calendar" class="group rounded-xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-[0_1px_2px_rgba(0,0,0,0.01)] hover:border-[var(--text)] transition-all duration-200">
            <h3 class="text-sm font-semibold tracking-tight text-[var(--text)]">Agenda de Manutenções</h3>
            <p class="mt-1.5 text-xs text-[var(--text-soft)] leading-relaxed">Visualizar planeamentos operacionais numa vista cronológica dedicada para otimização do fluxo de trabalho.</p>
        </a>

        {{-- Card Distinto: Analytics (Destaque Premium Discreto) --}}
        <a href="/ui/analytics" class="group rounded-xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-[0_1px_2px_rgba(0,0,0,0.01)] hover:border-amber-500/50 dark:hover:border-amber-400/50 transition-all duration-200 ring-1 ring-transparent hover:ring-amber-500/10 dark:hover:ring-amber-400/10">
            <h3 class="text-sm font-semibold tracking-tight text-[var(--text)] flex items-center gap-1.5">
                Analytics & Relatórios
                <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[9px] font-medium bg-amber-500/10 dark:bg-amber-400/10 text-amber-600 dark:text-amber-400 border border-amber-500/20 dark:border-amber-400/20">KPIs</span>
            </h3>
            <p class="mt-1.5 text-xs text-[var(--text-soft)] leading-relaxed">Gráficos avançados de desempenho, tempos médios de resposta (SLA) e ferramentas para exportação analítica.</p>
        </a>
    </div>
@endcomponent
@endsection

@push('scripts')
<script>
async function loadMetrics() {
    // Restrição estrutural: apenas técnicos e administradores têm acesso visual às métricas
    const userRole = '{{ $user->profile->name ?? "" }}';
    const panel = document.getElementById('metricsPanel');

    if (!panel) return;

    if (userRole !== 'technician' && userRole !== 'admin') {
        panel.innerHTML = `
            <div class="rounded-xl border border-dashed border-[var(--border)] bg-[var(--surface-2)] p-5 col-span-full text-center">
                <p class="text-xs text-[var(--text-soft)]">Painel de métricas operacionais disponível apenas para perfis autorizados (Técnicos/Gestores).</p>
            </div>
        `;
        return;
    }

    // Feedback de carregamento inicial assíncrono
    panel.innerHTML = `
        <div class="col-span-full text-xs text-[var(--text-soft)] animate-pulse">
            A ler indicadores analíticos em tempo real...
        </div>
    `;

    try {
        const res = await fetch('/analytics', { headers: authHeader() });
        if (!res.ok) throw new Error('Falha na comunicação de dados');

        const data = await res.json();

        const metrics = [
            ['Tempo médio de resolução', `${data.average_resolution_minutes ?? 0} min`],
            ['Tempo médio de espera', `${data.average_waiting_minutes ?? 0} min`],
            ['Tickets em aberto', `${data.open_tickets ?? 0}`],
            ['Tickets fechados', `${data.closed_tickets ?? 0}`],
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
                Não foi possível carregar os indicadores analíticos do servidor.
            </div>
        `;
    }
}

// Inicialização segura após o carregamento completo do DOM
window.addEventListener('DOMContentLoaded', loadMetrics);
</script>
@endpush
