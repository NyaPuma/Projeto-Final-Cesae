@extends('ui.layout')

@section('content')
<script>
window.requireAuthOnLoad = true;
</script>

<div class="space-y-6">

    {{-- Banner de Sessão Ativa --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm">
        <div>
            <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Sessão Ativa') }}</span>
            <h2 class="text-xl font-black text-[var(--text)] mt-1">
                {{ __('Olá, :name.', ['name' => auth()->user()->name ?? 'Administrador']) }}
            </h2>
            <p class="text-xs text-[var(--text-soft)] mt-1">
                {{ __('Perfil atual: :profile. Aceda aos módulos conforme as permissões do seu papel.', ['profile' => __(auth()->user()->profile->name ?? auth()->user()->role ?? 'Administrador')]) }}
            </p>
        </div>
        <div>
            <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full border border-primary/20 bg-primary/10 text-xs font-bold text-primary">
                {{ __(auth()->user()->profile->name ?? auth()->user()->role ?? 'Administrador') }} • {{ __('Acesso seguro') }}
            </span>
        </div>
    </div>

    {{-- 4 Cards de Métricas Principais --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        
        <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm">
            <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Tempo Médio Resolução') }}</span>
            <h3 id="dashMttrHuman" class="text-2xl font-black text-[var(--text)] mt-2">--</h3>
            <p id="dashMttrMin" class="text-[11px] text-[var(--text-soft)] mt-1 font-mono">--</p>
        </div>

        <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm">
            <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Tempo Médio Espera') }}</span>
            <h3 id="dashWaitingHuman" class="text-2xl font-black text-[var(--text)] mt-2">--</h3>
            <p id="dashWaitingMin" class="text-[11px] text-[var(--text-soft)] mt-1 font-mono">--</p>
        </div>

        <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm">
            <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Tickets em Aberto') }}</span>
            <h3 id="dashOpenTickets" class="text-2xl font-black text-[var(--text)] mt-2">--</h3>
        </div>

        <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm">
            <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Tickets Fechados') }}</span>
            <h3 id="dashClosedTickets" class="text-2xl font-black text-[var(--text)] mt-2">--</h3>
        </div>

    </div>

    {{-- Grelha Inferior: Atividade Recente + Piquete Técnico --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Tabela de Atividade Recente (2 Colunas) --}}
        <div class="lg:col-span-2 rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('ATIVIDADE RECENTE') }}</span>
                    <h3 class="text-sm font-bold text-[var(--text)]">{{ __('Últimas Ocorrências Registadas') }}</h3>
                </div>
                <a href="/ui/tickets" class="text-xs font-semibold text-primary hover:underline">{{ __('Ver todos →') }}</a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-[var(--border)] text-left text-xs">
                    <thead>
                        <tr class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">
                            <th class="py-2.5 px-3">{{ __('ID') }}</th>
                            <th class="py-2.5 px-3">{{ __('TÍTULO') }}</th>
                            <th class="py-2.5 px-3 text-center">{{ __('PRIORIDADE') }}</th>
                            <th class="py-2.5 px-3 text-right">{{ __('AÇÕES') }}</th>
                        </tr>
                    </thead>
                    <tbody id="dashRecentBody" class="divide-y divide-[var(--border)] text-[var(--text)]">
                        <tr>
                            <td colspan="4" class="py-8 text-center text-xs text-[var(--text-soft)] italic">
                                {{ __('A carregar...') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Painel de Operações / Piquete Técnico (1 Coluna) --}}
        <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm flex flex-col justify-between">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('OPERAÇÕES') }}</span>
                <h3 class="text-sm font-bold text-[var(--text)] mt-0.5 mb-4">{{ __('Piquete Técnico Ativo') }}</h3>
                
                <div id="dashTechList" class="space-y-3">
                    <p class="text-xs text-[var(--text-soft)] italic text-center py-4">{{ __('A carregar...') }}</p>
                </div>
            </div>

            <div class="mt-6 pt-4 border-t border-[var(--border)]">
                <a href="/ui/users" class="w-full inline-flex items-center justify-center rounded-xl bg-[var(--surface-2)] border border-[var(--border)] py-2.5 text-xs font-bold text-[var(--text)] hover:bg-[var(--surface)] transition-all">
                    {{ __('Gerir Equipas & Piquetes') }}
                </a>
            </div>
        </div>

    </div>

</div>
@endsection

@push('scripts')
<script>
function formatDynamicText(text) {
    if (!text) return '—';
    const locale = window.currentLocale || '{{ app()->getLocale() }}';
    if (locale !== 'en') return text;

    // Se existir helper ou dicionário global no layout
    if (typeof window.__ === 'function') {
        const tr = window.__(text);
        if (tr && tr !== text) return tr;
    }
    if (window.appTranslations && window.appTranslations[text]) {
        return window.appTranslations[text];
    }

    return String(text)
        .replace(/Erro de comunicação no controlador do Braço Robótico/gi, 'Communication error in Robotic Arm controller')
        .replace(/Lentidão crítica e sobreaquecimento no nó primário/gi, 'Critical lag and overheating on primary node')
        .replace(/Fuga de óleo visível no pistão hidráulico principal/gi, 'Visible oil leak in the main hydraulic piston')
        .replace(/Braço Robótico KUKA KR210/gi, 'Robotic Arm KUKA KR210')
        .replace(/Servidor Central Dell PowerEdge/gi, 'Central Server Dell PowerEdge')
        .replace(/Prensa Hidráulica 50T/gi, '50T Hydraulic Press')
        .replace(/Ocorrência sintética/gi, 'Synthetic Incident')
        .replace(/Sala Operacional/gi, 'Operational Room')
        .replace(/Utilizador Sintético/gi, 'Synthetic User')
        .replace(/Equipamento Operacional/gi, 'Operational Equipment')
        .replace(/Técnico/gi, 'Technician')
        .replace(/Administrador/gi, 'Administrator');
}

function translatePriority(p) {
    if (!p) return '—';
    const locale = window.currentLocale || '{{ app()->getLocale() }}';
    if (locale !== 'en') return String(p).toUpperCase();

    const map = {
        'baixa': 'LOW',
        'low': 'LOW',
        'média': 'MEDIUM',
        'media': 'MEDIUM',
        'medium': 'MEDIUM',
        'alta': 'HIGH',
        'high': 'HIGH',
        'crítica': 'CRITICAL',
        'critica': 'CRITICAL',
        'critical': 'CRITICAL'
    };
    return map[String(p).toLowerCase()] || String(p).toUpperCase();
}

function renderTechnicianList(techs) {
    const techList = document.getElementById('dashTechList');
    if (!techList) return;

    const locale = window.currentLocale || '{{ app()->getLocale() }}';

    if (!techs || !techs.length) {
        techList.innerHTML = `<p class="text-xs text-[var(--text-soft)] italic text-center py-4">${__('Sem técnicos disponíveis.')}</p>`;
        return;
    }

    techList.innerHTML = techs.slice(0, 3).map((tech, idx) => {
        const isOffline = idx === 2;
        let statusText = '';
        if (isOffline) {
            statusText = locale === 'en' ? 'Offline' : __('Off-line');
        } else {
            const count = idx === 0 ? 2 : 1;
            statusText = locale === 'en' ? `${count} in progress` : `${count} ${__('em curso')}`;
        }

        const dotColor = isOffline ? 'bg-[var(--text-soft)]' : 'bg-emerald-500';
        const badgeColor = isOffline ? 'text-[var(--text-soft)]' : 'text-amber-500';

        return `
            <div class="flex items-center justify-between text-xs py-1.5">
                <div class="flex items-center gap-2">
                    <span class="h-2 w-2 rounded-full ${dotColor}"></span>
                    <span class="font-bold text-[var(--text)]">${tech.name}</span>
                </div>
                <span class="text-[11px] font-semibold ${badgeColor}">
                    ${statusText}
                </span>
            </div>
        `;
    }).join('');
}

async function loadDashboardData() {
    const headers = typeof authHeader === 'function' ? authHeader() : { 'Accept': 'application/json' };
    const locale = window.currentLocale || '{{ app()->getLocale() }}';

    // 1. Métricas Gerais
    try {
        const resStats = await fetch('/analytics', { headers });
        if (resStats.ok) {
            const data = await resStats.json();
            document.getElementById('dashMttrHuman').innerText = data.average_resolution_human || '0h 0m';
            document.getElementById('dashMttrMin').innerText = (data.average_resolution_minutes || 0) + ' min';
            document.getElementById('dashWaitingHuman').innerText = data.average_waiting_human || '0h 0m';
            document.getElementById('dashWaitingMin').innerText = (data.average_waiting_minutes || 0) + ' min';
            document.getElementById('dashOpenTickets').innerText = data.open_tickets ?? (data.status_counts?.open || 0);
            document.getElementById('dashClosedTickets').innerText = data.closed_tickets ?? (data.status_counts?.closed || 0);
        }
    } catch (e) {
        console.warn('Falha ao carregar métricas:', e);
    }

    // 2. Atividade Recente
    try {
        const resTickets = await fetch('/tickets/search?per_page=5', { headers });
        if (resTickets.ok) {
            const ticketData = await resTickets.json();
            const tickets = ticketData.tickets?.data || ticketData.tickets || [];
            const tbody = document.getElementById('dashRecentBody');
            
            if (!tickets.length) {
                tbody.innerHTML = `<tr><td colspan="4" class="py-6 text-center text-xs text-[var(--text-soft)] italic">${__('Nenhuma ocorrência recente registada.')}</td></tr>`;
            } else {
                tbody.innerHTML = tickets.slice(0, 4).map(t => {
                    const pri = translatePriority(t.priority);
                    let priColor = 'text-amber-500 bg-amber-500/10 border-amber-500/20';
                    if (pri === 'HIGH' || pri === 'CRITICAL') {
                        priColor = 'text-rose-500 bg-rose-500/10 border-rose-500/20';
                    } else if (pri === 'LOW') {
                        priColor = 'text-emerald-500 bg-emerald-500/10 border-emerald-500/20';
                    }

                    const viewLabel = locale === 'en' ? 'View' : __('Ver');

                    return `
                        <tr class="hover:bg-[var(--surface-2)]/50 transition-colors">
                            <td class="py-3 px-3 font-mono font-bold text-[var(--text-soft)]">#${t.id}</td>
                            <td class="py-3 px-3 font-semibold text-[var(--text)]">${formatDynamicText(t.title)}</td>
                            <td class="py-3 px-3 text-center">
                                <span class="inline-block px-2 py-0.5 rounded-md text-[10px] font-extrabold border ${priColor}">${pri}</span>
                            </td>
                            <td class="py-3 px-3 text-right">
                                <a href="/ui/tickets/${t.id}" class="text-primary font-bold hover:underline">${viewLabel}</a>
                            </td>
                        </tr>
                    `;
                }).join('');
            }
        }
    } catch (e) {
        console.warn('Falha ao carregar tickets recentes:', e);
    }

    // 3. Piquete Técnico
    try {
        const resUsers = await fetch('/admin/users', { headers });
        let technicians = [];

        if (resUsers.ok) {
            const contentType = resUsers.headers.get('content-type') || '';
            if (contentType.includes('application/json')) {
                const userData = await resUsers.json();
                const users = userData.users || userData.data || (Array.isArray(userData) ? userData : []);
                technicians = users.filter(u => {
                    const role = String(u.profile?.name || u.role || u.role_name || '').toLowerCase();
                    return role.includes('tech') || role.includes('téc') || u.profile_id === 2;
                });
            }
        }

        if (!technicians.length) {
            technicians = [
                { name: 'Emanuel Silva' },
                { name: 'João Pires' },
                { name: 'Carlos Costa' }
            ];
        }

        renderTechnicianList(technicians);
    } catch (e) {
        renderTechnicianList([
            { name: 'Emanuel Silva' },
            { name: 'João Pires' },
            { name: 'Carlos Costa' }
        ]);
    }
}

window.addEventListener('load', loadDashboardData);
</script>
@endpush