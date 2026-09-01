@extends('ui.layout')

@section('content')
<script>
window.requireAuthOnLoad = true;
</script>

@component('ui.partials.page-card', [
    'title' => __('Tickets'),
    'subtitle' => __('Pesquise, filtre e consulte as ocorrências registadas.'),
    'actions' => '<div class="flex flex-wrap gap-2">'
        . '<a href="/ui" class="inline-flex items-center justify-center px-3.5 py-2 bg-[var(--surface)] text-xs font-semibold text-[var(--text)] border border-[var(--border)] rounded-xl shadow-sm hover:bg-[var(--surface-2)] transition-all">'
            . '<svg class="w-3.5 h-3.5 mr-1.5 text-[var(--text-soft)]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">'
                . '<path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path>'
            . '</svg> '
            . __('Voltar ao painel')
        . '</a>'
        . (auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isCommonUser())
            ? '<a href="/ui/tickets/create" class="ui-button ui-button--primary inline-flex items-center justify-center px-3.5 py-2 text-xs font-bold text-[var(--on-primary)] rounded-xl shadow-sm hover:opacity-90 transition-all">+ ' . __('Criar Ticket') . '</a>'
            : '')
        . '</div>'
])

    {{-- Painel de Pesquisa --}}
    <div class="mb-6 rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm animate-[fadeIn_0.2s_ease-out]">
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

            <div class="sm:col-span-2 lg:col-span-3 xl:col-span-4">
                <label for="filter_q" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Termo de Pesquisa') }}</label>
                <div class="relative">
                    <input id="filter_q" placeholder="{{ __('Pesquisar em título e descrição do ticket...') }}"
                        class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] placeholder-[var(--text-soft)] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
                </div>
            </div>

            <div>
                <label for="filter_status" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Estado') }}</label>
                <select id="filter_status" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
                    <option value="">{{ __('Todos') }}</option>
                    <option value="aberta">{{ __('Aberta') }}</option>
                    <option value="em curso">{{ __('Em Curso') }}</option>
                    <option value="fechada">{{ __('Fechada') }}</option>
                </select>
            </div>

            <div>
                <label for="filter_priority" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Prioridade') }}</label>
                <select id="filter_priority" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
                    <option value="">{{ __('Todas') }}</option>
                    <option value="baixa">{{ __('Baixa') }}</option>
                    <option value="média">{{ __('Média') }}</option>
                    <option value="alta">{{ __('Alta') }}</option>
                    <option value="crítica">{{ __('Crítica') }}</option>
                </select>
            </div>

            <div>
                <label for="filter_date_from" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Data de abertura (De)') }}</label>
                <input id="filter_date_from" type="date" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2 text-xs text-[var(--text)] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
            </div>

            <div>
                <label for="filter_date_to" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Data até') }}</label>
                <input id="filter_date_to" type="date" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2 text-xs text-[var(--text)] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
            </div>
        </div>

        <div class="mt-4 pt-4 border-t border-[var(--border)] flex flex-wrap items-center justify-between gap-2">
            <div class="flex items-center gap-2">
                <button id="btnSearch" class="ui-button ui-button--primary inline-flex items-center justify-center px-4 py-2 text-[var(--on-primary)] text-xs font-bold rounded-xl shadow-sm hover:opacity-90 transition-all cursor-pointer min-h-[36px]">
                    {{ __('Pesquisar') }}
                </button>
                <button id="btnClear" class="ui-button ui-button--outline inline-flex items-center justify-center px-4 py-2 text-[var(--text)] border border-[var(--border)] text-xs font-semibold rounded-xl shadow-sm hover:bg-[var(--surface-2)] transition-all cursor-pointer min-h-[36px]">
                    {{ __('Limpar filtros') }}
                </button>
            </div>
            <span id="resultsCount" class="text-xs font-semibold text-[var(--text-soft)]"></span>
        </div>
    </div>

    {{-- Tabela de Resultados --}}
    <div class="w-full overflow-hidden bg-[var(--surface)] border border-[var(--border)] rounded-2xl shadow-sm" role="region" aria-live="polite" aria-label="{{ __('Lista de tickets') }}">
        <div class="overflow-x-auto">
            <table id="ticketsTable" class="min-w-full divide-y divide-[var(--border)] text-left text-xs">
                <thead class="bg-[var(--surface-2)] text-[var(--text-soft)] uppercase tracking-wider font-bold text-[10px]">
                    <tr>
                        <th class="px-5 py-4 font-bold">{{ __('ID') }}</th>
                        <th class="px-5 py-4 font-bold">{{ __('Título') }}</th>
                        <th class="px-5 py-4 font-bold">{{ __('Prioridade') }}</th>
                        <th class="px-5 py-4 font-bold">{{ __('Estado') }}</th>
                        <th class="px-5 py-4 font-bold">{{ __('Equipamento') }}</th>
                        <th class="px-5 py-4 font-bold">{{ __('Sala') }}</th>
                        <th class="px-5 py-4 font-bold">{{ __('Técnico') }}</th>
                        <th class="px-5 py-4 font-bold text-right">{{ __('Ações') }}</th>
                    </tr>
                </thead>
                <tbody id="ticketsBody" class="divide-y divide-[var(--border)] text-[var(--text)]">
                    <tr>
                        <td colspan="8" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]">
                            <div class="flex items-center justify-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                                {{ __('A carregar listagem de tickets...') }}
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Paginação --}}
    <div id="pagination" class="mt-5 flex items-center justify-between text-xs text-[var(--text-soft)] px-1"></div>

@endcomponent
@endsection

@push('scripts')
<script>
const priorityColors = {
    baixa:    'border border-emerald-500/20 bg-emerald-500/10 text-emerald-800 dark:text-emerald-400',
    low:      'border border-emerald-500/20 bg-emerald-500/10 text-emerald-800 dark:text-emerald-400',
    média:    'border border-amber-500/20 bg-amber-500/10 text-amber-800 dark:text-amber-400',
    media:    'border border-amber-500/20 bg-amber-500/10 text-amber-800 dark:text-amber-400',
    medium:   'border border-amber-500/20 bg-amber-500/10 text-amber-800 dark:text-amber-400',
    alta:     'border border-orange-500/20 bg-orange-500/10 text-orange-800 dark:text-orange-400',
    high:     'border border-orange-500/20 bg-orange-500/10 text-orange-800 dark:text-orange-400',
    crítica:  'border border-rose-500/20 bg-rose-500/10 text-rose-800 dark:text-rose-400 animate-pulse font-bold',
    critica:  'border border-rose-500/20 bg-rose-500/10 text-rose-800 dark:text-rose-400 animate-pulse font-bold',
    critical: 'border border-rose-500/20 bg-rose-500/10 text-rose-800 dark:text-rose-400 animate-pulse font-bold'
};

function formatDynamicText(text) {
    if (!text) return '—';
    const locale = window.currentLocale || '{{ app()->getLocale() }}';
    if (locale !== 'en') return text;

    // Se existir correspondência direta no dicionário global do layout
    if (typeof window.__ === 'function') {
        const translated = window.__(text);
        if (translated !== text) return translated;
    }

    return String(text)
        .replace(/Erro de comunicação no controlador do Braço Robótico/gi, 'Communication error in Robotic Arm controller')
        .replace(/Braço Robótico KUKA KR210/gi, 'Robotic Arm KUKA KR210')
        .replace(/Lentidão crítica e sobreaquecimento no nó primário/gi, 'Critical lag and overheating on primary node')
        .replace(/Servidor Central Dell PowerEdge/gi, 'Central Server Dell PowerEdge')
        .replace(/Laboratório de I&D/gi, 'R&D Laboratory')
        .replace(/Fuga de óleo visível no pistão hidráulico principal/gi, 'Visible oil leak in the main hydraulic piston')
        .replace(/Prensa Hidráulica 50T/gi, '50T Hydraulic Press')
        .replace(/Linha de Montagem A/gi, 'Assembly Line A')
        .replace(/Pavilhão Industrial 1/gi, 'Industrial Pavilion 1')
        .replace(/Ocorrência sintética/gi, 'Synthetic Incident')
        .replace(/Sala Operacional/gi, 'Operational Room')
        .replace(/Utilizador Sintético/gi, 'Synthetic User')
        .replace(/Equipamento Operacional/gi, 'Operational Equipment')
        .replace(/Técnico/gi, 'Technician')
        .replace(/Administrador/gi, 'Administrator');
}

function translateStatusLabel(status) {
    if (!status) return 'N/A';
    const locale = window.currentLocale || '{{ app()->getLocale() }}';
    if (locale !== 'en') return String(status).toUpperCase();

    const map = {
        'fechada': 'CLOSED',
        'fechado': 'CLOSED',
        'closed': 'CLOSED',
        'sem rede': 'NO NETWORK',
        'no network': 'NO NETWORK',
        'em revisão': 'UNDER REVIEW',
        'em revisao': 'UNDER REVIEW',
        'under review': 'UNDER REVIEW',
        'pendente orçamento': 'BUDGET PENDING',
        'pendente orcamento': 'BUDGET PENDING',
        'budget pending': 'BUDGET PENDING',
        'aguarda peças': 'AWAITING PARTS',
        'aguarda pecas': 'AWAITING PARTS',
        'awaiting parts': 'AWAITING PARTS',
        'cancelada': 'CANCELLED',
        'cancelado': 'CANCELLED',
        'cancelled': 'CANCELLED',
        'aberta': 'OPEN',
        'aberto': 'OPEN',
        'open': 'OPEN',
        'em curso': 'IN PROGRESS',
        'in progress': 'IN PROGRESS'
    };

    const key = String(status).trim().toLowerCase();
    return map[key] || String(status).toUpperCase();
}

let currentPage = 1;

function authHeader(){
    const token = localStorage.getItem('api_token');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const headers = { 'Accept': 'application/json' };

    if (token) headers['X-Auth-Token'] = token;
    if (csrfToken) headers['X-CSRF-TOKEN'] = csrfToken;

    return headers;
}

async function loadTickets(page = 1) {
    currentPage = page;
    const params = new URLSearchParams();
    const q        = document.getElementById('filter_q')?.value.trim() || '';
    const status   = document.getElementById('filter_status')?.value || '';
    const priority = document.getElementById('filter_priority')?.value || '';
    const dateFrom = document.getElementById('filter_date_from')?.value || '';
    const dateTo   = document.getElementById('filter_date_to')?.value || '';

    if (q)        params.append('q', q);
    if (status)   params.append('status', status);
    if (priority) params.append('priority', priority);
    if (dateFrom) params.append('date_from', dateFrom);
    if (dateTo)   params.append('date_to', dateTo);
    params.append('page', page);

    const url = `/tickets/search?${params.toString()}`;
    const tbody = document.getElementById('ticketsBody');
    if (tbody) tbody.innerHTML = `<tr><td colspan="8" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]">${__('A carregar listagem de tickets...')}</td></tr>`;

    try {
        const res = await fetch(url, { headers: authHeader() });
        
        if (res.status === 401) { 
            showFeedback(__('Autenticação necessária. Faça login.'), true); 
            window.location = '/ui/login'; 
            return; 
        }
        if (!res.ok) {
            const errData = await res.json().catch(() => ({}));
            showFeedback(errData.message || __('Não foi possível carregar os tickets de momento.'), true);
            return;
        }
        const data = await res.json().catch(() => ({}));

        const tickets = data.tickets?.data ?? data.tickets ?? [];
        const meta    = data.tickets?.meta ?? data.tickets ?? {};
        const total   = meta.total ?? tickets.length;

        const resultsEl = document.getElementById('resultsCount');
        if (resultsEl) {
            resultsEl.textContent = total > 0 ? `${total} ${__('resultado(s) encontrado(s)')}` : __('Sem resultados');
        }

        if (!tickets.length) {
            if (tbody) tbody.innerHTML = `<tr><td colspan="8" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]"><div class="mx-auto max-w-sm rounded-2xl border border-dashed border-[var(--border)] bg-[var(--surface-2)] p-5">${__('Nenhum ticket encontrado com os filtros aplicados.')}</div></td></tr>`;
            const pagEl = document.getElementById('pagination');
            if (pagEl) pagEl.innerHTML = '';
            return;
        }

        tbody.innerHTML = tickets.map(t => {
            const priorityKey = (t.priority || '').toLowerCase();
            const priColor = priorityColors[priorityKey] ?? 'border border-[var(--border)] bg-[var(--surface-2)] text-[var(--text-soft)]';
            const priorityLabel = __(t.priority || '').toUpperCase();

            const rawStatus = t.status?.name ?? t.status ?? 'N/A';
            const statusKey = String(rawStatus).toLowerCase();
            const translatedStatus = translateStatusLabel(rawStatus);

            let statusBadge = `<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[10px] font-bold bg-[var(--surface-2)] text-[var(--text-soft)] border border-[var(--border)] uppercase tracking-tight">${translatedStatus}</span>`;
            if (statusKey.includes('abert') || statusKey.includes('open')) {
                statusBadge = `<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[10px] font-bold bg-blue-500/10 text-blue-700 dark:text-blue-400 border border-blue-500/20 uppercase tracking-tight">${translatedStatus}</span>`;
            } else if (statusKey.includes('curso') || statusKey.includes('progress')) {
                statusBadge = `<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[10px] font-bold bg-amber-500/10 text-amber-800 dark:text-amber-400 border border-amber-500/20 uppercase tracking-tight">${translatedStatus}</span>`;
            } else if (statusKey.includes('fechad') || statusKey.includes('close')) {
                statusBadge = `<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[10px] font-bold bg-emerald-500/10 text-emerald-800 dark:text-emerald-400 border border-emerald-500/20 uppercase tracking-tight">${translatedStatus}</span>`;
            } else if (statusKey.includes('cancel')) {
                statusBadge = `<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[10px] font-bold bg-rose-500/10 text-rose-800 dark:text-rose-400 border border-rose-500/20 uppercase tracking-tight">${translatedStatus}</span>`;
            }

            const titleTranslated = formatDynamicText(t.title);
            const equipmentTranslated = formatDynamicText(t.equipment ? t.equipment.name : (t.equipment_name || '—'));
            const roomTranslated = formatDynamicText(t.room ? t.room.name : (t.room_name || '—'));
            const technicianTranslated = t.technician ? formatDynamicText(t.technician.name) : '<span class="text-[var(--text-soft)] font-normal italic">—</span>';

            return `<tr class="hover:bg-[var(--surface-2)]/50 transition-colors duration-150">
                <td class="px-5 py-4 font-mono text-[var(--text-soft)] font-bold">#${t.id}</td>
                <td class="px-5 py-4 font-semibold text-[var(--text)]">${titleTranslated}</td>
                <td class="px-5 py-4">
                    <span class="inline-block px-2.5 py-1 rounded-lg text-[10px] font-bold uppercase tracking-tight ${priColor}">${priorityLabel}</span>
                </td>
                <td class="px-5 py-4">${statusBadge}</td>
                <td class="px-5 py-4 text-[var(--text-soft)] font-semibold">${equipmentTranslated}</td>
                <td class="px-5 py-4 text-[var(--text-soft)] font-semibold">${roomTranslated}</td>
                <td class="px-5 py-4 text-xs font-semibold text-[var(--text)]">${technicianTranslated}</td>
                <td class="px-5 py-4 text-right">
                    <a href="/ui/tickets/${t.id}" class="inline-flex items-center justify-center px-3.5 py-1.5 bg-[var(--surface)] hover:bg-[var(--surface-2)] text-[11px] font-semibold text-[var(--text)] border border-[var(--border)] rounded-lg shadow-sm transition-all min-h-[28px]">${__('Ver')}</a>
                </td>
            </tr>`;
        }).join('');

        const lastPage = meta.last_page ?? 1;
        const currPage = meta.current_page ?? page;
        const pagEl    = document.getElementById('pagination');
        
        if (lastPage <= 1) { 
            if (pagEl) pagEl.innerHTML = ''; 
            return; 
        }
        
        if (pagEl) {
            pagEl.innerHTML = `
                <button onclick="loadTickets(${currPage - 1})" ${currPage <= 1 ? 'disabled' : ''}
                    class="ui-button ui-button--primary inline-flex items-center justify-center px-3.5 py-2 text-xs font-bold text-[var(--on-primary)] rounded-xl shadow-sm hover:opacity-90 transition-all disabled:opacity-40 disabled:cursor-not-allowed min-h-[36px]">← ${__('Anterior')}</button>
                <span class="font-bold text-[var(--text-soft)]">${__('Página')} ${currPage} ${__('de')} ${lastPage}</span>
                <button onclick="loadTickets(${currPage + 1})" ${currPage >= lastPage ? 'disabled' : ''}
                    class="ui-button ui-button--primary inline-flex items-center justify-center px-3.5 py-2 text-xs font-bold text-[var(--on-primary)] rounded-xl shadow-sm hover:opacity-90 transition-all disabled:opacity-40 disabled:cursor-not-allowed min-h-[36px]">${__('Próxima')} →</button>
            `;
        }
    } catch (err) {
        console.error('❌ Exceção em loadTickets:', err);
        showFeedback(`${__('Erro ao carregar tickets.')} ${err.message}`, true);
    }
}

function showFeedback(message, error = false) {
    const el = document.getElementById('resultsCount');
    if (!el) return;
    el.textContent = message;
    el.className = `text-xs font-semibold ${error ? 'text-red-700 dark:text-red-400' : 'text-[var(--text-soft)]'}`;
}

document.getElementById('btnSearch')?.addEventListener('click', () => loadTickets(1));

document.getElementById('btnClear')?.addEventListener('click', () => {
    ['filter_q','filter_status','filter_priority','filter_date_from','filter_date_to'].forEach(id => {
        const el = document.getElementById(id);
        if (el) el.value = '';
    });
    loadTickets(1);
});

document.getElementById('filter_q')?.addEventListener('keydown', e => {
    if (e.key === 'Enter') loadTickets(1);
});

document.getElementById('filter_status')?.addEventListener('change', () => loadTickets(1));
document.getElementById('filter_priority')?.addEventListener('change', () => loadTickets(1));
document.getElementById('filter_date_from')?.addEventListener('change', () => loadTickets(1));
document.getElementById('filter_date_to')?.addEventListener('change', () => loadTickets(1));

window.addEventListener('load', () => {
    loadTickets(1);
});
</script>
@endpush