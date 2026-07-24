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
    {{-- Banner de Sessão Ativa --}}
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

    {{-- Contentor Dinâmico de Métricas Operacionais --}}
    @if($isAdmin)
        <div id="metricsPanel" class="mb-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4"></div>
    @else
        <div class="mb-8 rounded-2xl border border-dashed border-[var(--border)] bg-[var(--surface-2)] p-5 col-span-full text-center">
            <p class="text-xs text-[var(--text-soft)]">{{ __('Métricas disponíveis apenas para Administrador.') }}</p>
        </div>
    @endif

    {{-- WIDGETS OPERACIONAIS EM TEMPO REAL --}}
    <div class="grid gap-6 lg:grid-cols-3 mb-6">
        
        {{-- Widget 1: Últimas Ocorrências Registadas (2 Colunas) --}}
        <div class="lg:col-span-2 rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-[0_1px_2px_rgba(0,0,0,0.01)] flex flex-col justify-between">
            <div>
                <div class="mb-4 flex items-center justify-between border-b border-[var(--border)] pb-3">
                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-[0.3em] text-[var(--text-soft)]">{{ __('Atividade Recente') }}</p>
                        <h3 class="text-base font-bold text-[var(--text)]">{{ __('Últimas Ocorrências Registadas') }}</h3>
                    </div>
                    <a href="/ui/tickets" class="text-xs font-bold text-primary hover:underline flex items-center gap-1">
                        {{ __('Ver todos') }} &rarr;
                    </a>
                </div>

                <div id="recentTicketsTable" class="overflow-x-auto">
                    <div class="text-xs text-[var(--text-soft)] animate-pulse py-4">
                        {{ __('A carregar fluxo de ocorrências...') }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Widget 2: Piquete Técnico & Equipas (1 Coluna) --}}
        <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-[0_1px_2px_rgba(0,0,0,0.01)] flex flex-col justify-between">
            <div>
                <div class="mb-4 border-b border-[var(--border)] pb-3">
                    <p class="text-[10px] font-bold uppercase tracking-[0.3em] text-[var(--text-soft)]">{{ __('Operações') }}</p>
                    <h3 class="text-base font-bold text-[var(--text)]">{{ __('Piquete Técnico Ativo') }}</h3>
                </div>

                <div id="picketList" class="space-y-3 mt-2">
                    <div class="flex items-center justify-between text-xs py-1.5 border-b border-[var(--border)]/50">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            <span class="font-semibold text-[var(--text)]">Emanuel Silva</span>
                        </div>
                        <span class="text-[10px] font-bold text-amber-500 bg-amber-500/10 px-2 py-0.5 rounded-full">2 {{ __('em curso') }}</span>
                    </div>
                    <div class="flex items-center justify-between text-xs py-1.5 border-b border-[var(--border)]/50">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            <span class="font-semibold text-[var(--text)]">João Pires</span>
                        </div>
                        <span class="text-[10px] font-bold text-emerald-500 bg-emerald-500/10 px-2 py-0.5 rounded-full">1 {{ __('em curso') }}</span>
                    </div>
                    <div class="flex items-center justify-between text-xs py-1.5">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-slate-500"></span>
                            <span class="font-semibold text-[var(--text-soft)]">Carlos Costa</span>
                        </div>
                        <span class="text-[10px] font-semibold text-[var(--text-soft)]">Off-line</span>
                    </div>
                </div>
            </div>

            @if($isAdmin)
                <div class="mt-6 pt-4 border-t border-[var(--border)]">
                    <a href="/ui/users" class="w-full inline-flex items-center justify-center bg-[var(--surface-2)] hover:bg-[var(--border)] text-[var(--text)] border border-[var(--border)] text-xs font-bold py-2.5 px-4 rounded-xl transition">
                        {{ __('Gerir Equipas & Piquetes') }}
                    </a>
                </div>
            @endif
        </div>

    </div>

@endcomponent
@endsection

@push('scripts')
<script>
function authHeader() {
    const token = localStorage.getItem('api_token');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const headers = { 'Accept': 'application/json' };
    if (token) {
        headers['Authorization'] = 'Bearer ' + token;
        headers['X-Auth-Token'] = token;
    }
    if (csrfToken) headers['X-CSRF-TOKEN'] = csrfToken;
    return headers;
}

// Função auxiliar para testar múltiplos caminhos de API de analytics
async function fetchAnalyticsStats() {
    const endpoints = ['/analytics/stats', '/analytics', '/api/analytics/stats'];
    for (const ep of endpoints) {
        try {
            const res = await fetch(ep, { headers: authHeader() });
            if (res.ok) {
                return await res.json();
            }
        } catch (e) {}
    }
    throw new Error('Falha na comunicação de dados analíticos');
}

async function loadMetrics() {
    const userRole = '{{ $user->profile->name ?? "" }}';
    const panel = document.getElementById('metricsPanel');

    if (panel && userRole === 'admin') {
        panel.innerHTML = `
            <div class="col-span-full text-xs text-[var(--text-soft)] animate-pulse" aria-live="polite">
                A ler indicadores analíticos em tempo real...
            </div>
        `;

        try {
            const data = await fetchAnalyticsStats();

            // Renderiza com Hierarquia Visual: Dias/Horas em Destaque + Minutos por baixo
            panel.innerHTML = `
                <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm animate-[fadeIn_0.3s_ease-out]">
                    <p class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">Tempo Médio Resolução</p>
                    <p class="mt-2 text-2xl font-black text-[var(--text)]">${data.average_resolution_human ?? '0h 0m'}</p>
                    <p class="mt-0.5 text-xs font-semibold text-[var(--text-soft)]">${data.average_resolution_minutes ?? 0} min</p>
                </div>

                <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm animate-[fadeIn_0.3s_ease-out]">
                    <p class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">Tempo Médio Espera</p>
                    <p class="mt-2 text-2xl font-black text-[var(--text)]">${data.average_waiting_human ?? '0h 0m'}</p>
                    <p class="mt-0.5 text-xs font-semibold text-[var(--text-soft)]">${data.average_waiting_minutes ?? 0} min</p>
                </div>

                <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm animate-[fadeIn_0.3s_ease-out] flex flex-col justify-between">
                    <p class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">Tickets em Aberto</p>
                    <p class="mt-2 text-3xl font-black text-amber-500">${data.open_tickets ?? 0}</p>
                </div>

                <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm animate-[fadeIn_0.3s_ease-out] flex flex-col justify-between">
                    <p class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">Tickets Fechados</p>
                    <p class="mt-2 text-3xl font-black text-emerald-500">${data.closed_tickets ?? 0}</p>
                </div>
            `;

        } catch (err) {
            panel.innerHTML = `
                <div class="rounded-xl border border-red-500/20 bg-red-500/5 p-4 col-span-full text-xs text-red-400">
                    Não foi possível carregar os indicadores analíticos do servidor.
                </div>
            `;
        }
    }

    loadRecentTickets();
}

async function loadRecentTickets() {
    const tableContainer = document.getElementById('recentTicketsTable');
    if (!tableContainer) return;

    const endpoints = ['/tickets?page=1&per_page=5', '/admin/tickets?page=1&per_page=5', '/api/tickets?page=1&per_page=5'];
    let tickets = [];

    for (const ep of endpoints) {
        try {
            const res = await fetch(ep, { headers: authHeader() });
            if (res.ok) {
                const data = await res.json();
                tickets = data.tickets?.data || data.tickets || data || [];
                if (tickets.length > 0) break;
            }
        } catch (e) {}
    }

    if (tickets.length === 0) {
        tableContainer.innerHTML = `<p class="text-xs text-[var(--text-soft)] py-2">Nenhuma ocorrência recente registada.</p>`;
        return;
    }

    tableContainer.innerHTML = `
        <table class="w-full text-left text-xs">
            <thead>
                <tr class="text-[var(--text-soft)] border-b border-[var(--border)] text-[10px] uppercase tracking-wider">
                    <th class="pb-2">ID</th>
                    <th class="pb-2">Título</th>
                    <th class="pb-2">Prioridade</th>
                    <th class="pb-2 text-right">Ação</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[var(--border)]/50 text-[var(--text)]">
                ${tickets.slice(0, 4).map(t => `
                    <tr>
                        <td class="py-2.5 font-mono text-[var(--text-soft)]">#${t.id}</td>
                        <td class="py-2.5 font-semibold truncate max-w-[180px]">${t.title}</td>
                        <td class="py-2.5">
                            <span class="px-2 py-0.5 rounded text-[9px] font-bold uppercase ${
                                t.priority === 'alta' ? 'bg-red-500/10 text-red-500' :
                                t.priority === 'média' ? 'bg-amber-500/10 text-amber-500' : 'bg-emerald-500/10 text-emerald-500'
                            }">${t.priority ?? 'média'}</span>
                        </td>
                        <td class="py-2.5 text-right">
                            <a href="/ui/tickets/${t.id}" class="text-primary hover:underline font-bold">Ver</a>
                        </td>
                    </tr>
                `).join('')}
            </tbody>
        </table>
    `;
}

window.addEventListener('DOMContentLoaded', loadMetrics);
</script>
@endpush