@extends('ui.layout')

@section('content')
<script>
window.requireAuthOnLoad = true;
</script>

@component('ui.partials.page-card', [
    'title' => __('Equipamentos'),
    'subtitle' => __('Inventário centralizado de equipamentos, localizações e estado operacional.'),
    'actions' => '<div class="flex flex-wrap items-center gap-2">'
        . '<a href="/ui" class="inline-flex items-center justify-center px-3.5 py-2 bg-[var(--surface)] text-xs font-semibold text-[var(--text)] border border-[var(--border)] rounded-xl shadow-sm hover:bg-[var(--surface-2)] transition-all">'
            . '<svg class="w-3.5 h-3.5 mr-1.5 text-[var(--text-soft)]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path></svg> ' . __('Voltar ao painel')
        . '</a>'
        . '<button id="btnAddEquipment" onclick="openNewEquipmentModal()" class="inline-flex items-center gap-1.5 px-4 py-2 text-xs font-bold text-white bg-orange-500 hover:bg-orange-600 rounded-xl shadow-sm transition-all cursor-pointer">'
            . '+ ' . __('Novo equipamento')
        . '</button>'
        . '</div>'
])

    {{-- Painel de Pesquisa Avançada --}}
    <div class="mb-6 rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm">
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            <div class="sm:col-span-2 lg:col-span-3 xl:col-span-4">
                <label for="filter_q" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Termo de Pesquisa') }}</label>
                <input id="filter_q" placeholder="{{ __('Pesquise por nome, categoria ou código...') }}"
                    class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] placeholder-[var(--text-soft)] outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all">
            </div>

            <div>
                <label for="filter_status" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Estado Operacional') }}</label>
                <select id="filter_status" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all">
                    <option value="">{{ __('Todos') }}</option>
                    <option value="1">{{ __('Operacional') }}</option>
                    <option value="0">{{ __('Fora de Serviço') }}</option>
                </select>
            </div>
        </div>

        <div class="mt-4 pt-4 border-t border-[var(--border)] flex flex-wrap items-center justify-between gap-2">
            <div class="flex items-center gap-2">
                <button id="btnSearch" class="inline-flex items-center justify-center px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold rounded-xl shadow-sm transition-all cursor-pointer min-h-[36px]">
                    {{ __('Pesquisar') }}
                </button>
                <button id="btnClear" class="inline-flex items-center justify-center px-4 py-2 bg-[var(--surface)] hover:bg-[var(--surface-2)] text-[var(--text)] border border-[var(--border)] text-xs font-semibold rounded-xl shadow-sm transition-all cursor-pointer min-h-[36px]">
                    {{ __('Limpar filtros') }}
                </button>
            </div>
            <span id="resultsCount" class="text-xs font-semibold text-[var(--text-soft)]"></span>
        </div>
    </div>

    {{-- Tabela de Equipamentos --}}
    <div class="w-full overflow-hidden bg-[var(--surface)] border border-[var(--border)] rounded-2xl shadow-sm" role="region" aria-live="polite" aria-label="{{ __('Lista de equipamentos') }}">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-[var(--border)] text-left text-xs">
                <thead class="bg-[var(--surface-2)] text-[var(--text-soft)] uppercase tracking-wider font-bold text-[10px]">
                    <tr>
                        <th class="px-5 py-4 font-bold">{{ __('Código / Nº Série') }}</th>
                        <th class="px-5 py-4 font-bold">{{ __('Equipamento') }}</th>
                        <th class="px-5 py-4 font-bold">{{ __('Sala / Localização') }}</th>
                        <th class="px-5 py-4 font-bold">{{ __('Status') }}</th>
                        <th class="px-5 py-4 font-bold text-right">{{ __('Ações') }}</th>
                    </tr>
                </thead>
                <tbody id="equipmentTableBody" class="divide-y divide-[var(--border)] text-[var(--text)]">
                    <tr>
                        <td colspan="5" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]">
                            <div class="flex items-center justify-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                                {{ __('A carregar inventário de equipamentos...') }}
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

{{-- Modal para Adicionar / Editar Equipamento --}}
<div id="equipmentModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 hidden opacity-0 transition-opacity duration-300">
    <div class="w-full max-w-lg rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-2xl scale-95 transition-transform duration-300" id="equipmentModalContent">
        <div class="flex items-center justify-between pb-4 border-b border-[var(--border)]">
            <h3 id="equipmentModalTitle" class="text-base font-black text-[var(--text)]"></h3>
            <button onclick="closeEquipmentModal()" class="text-[var(--text-soft)] hover:text-[var(--text)] text-lg font-bold cursor-pointer">✕</button>
        </div>
        <form id="equipmentForm" onsubmit="saveEquipment(event)" class="space-y-4 pt-4">
            <input type="hidden" id="equipmentId" name="id">
            <div>
                <label for="eqName" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Nome do Equipamento') }}</label>
                <input id="eqName" name="name" type="text" required placeholder="Ex: Projetor Epson EB-2250U"
                    class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all">
            </div>
            <div>
                <label for="eqSerial" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Código / Nº Série') }}</label>
                <input id="eqSerial" name="serial_number" type="text" required placeholder="Ex: KUKA-KR210-2026"
                    class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all">
            </div>
            <div>
                <label for="eqStatus" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Estado Operacional') }}</label>
                <select id="eqStatus" name="active" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all">
                    <option value="1">{{ __('Operacional') }}</option>
                    <option value="0">{{ __('Fora de Serviço') }}</option>
                </select>
            </div>
            <div class="flex justify-end gap-3 pt-4 border-t border-[var(--border)]">
                <button type="button" onclick="closeEquipmentModal()" class="px-4 py-2 text-xs font-semibold rounded-xl border border-[var(--border)] bg-[var(--surface)] hover:bg-[var(--surface-2)] cursor-pointer">
                    {{ __('Cancelar') }}
                </button>
                <button type="submit" class="px-4 py-2 text-xs font-bold text-white bg-orange-500 hover:bg-orange-600 rounded-xl shadow-sm transition-all cursor-pointer">
                    {{ __('Guardar') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
let equipmentData = [];
const ROWS_PER_PAGE = 10;
let currentPage = 1;

function authHeader(){
    const token = localStorage.getItem('api_token');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const headers = { 'Accept': 'application/json' };
    if (token) headers['X-Auth-Token'] = token;
    if (csrfToken) headers['X-CSRF-TOKEN'] = csrfToken;
    return headers;
}

function formatDynamicText(text) {
    if (!text) return '—';
    const locale = window.currentLocale || 'pt';
    if (locale !== 'en') return text;

    return String(text)
        .replace(/Braço Robótico/gi, 'Robotic Arm')
        .replace(/Empilhador Elétrico/gi, 'Electric Forklift')
        .replace(/Equipamento Operacional/gi, 'Operational Equipment')
        .replace(/Linha de Montagem/gi, 'Assembly Line')
        .replace(/Pavilhão Industrial/gi, 'Industrial Pavilion')
        .replace(/Armazém Logístico/gi, 'Logistics Warehouse')
        .replace(/Pavilhão Sul/gi, 'South Pavilion')
        .replace(/Sala Operacional/gi, 'Operational Room')
        .replace(/Zona Norte/gi, 'North Zone')
        .replace(/Setor/gi, 'Sector');
}

/**
 * Avalia se o equipamento está operacional considerando tickets em aberto ou inativação
 */
function isEquipmentOperational(eq) {
    // 1. Campo explícito calculado pelo controlador
    if (typeof eq.is_operational !== 'undefined') {
        return Boolean(eq.is_operational);
    }

    // 2. Baseado na contagem de tickets ativos
    if (typeof eq.active_tickets_count !== 'undefined') {
        const hasTickets = parseInt(eq.active_tickets_count) > 0;
        const isActive = eq.active !== 0 && eq.active !== false && eq.active !== '0';
        return !hasTickets && isActive;
    }

    // 3. Fallbacks de compatibilidade
    return (
        (eq.active === 1 || eq.active === '1' || eq.active === true) &&
        eq.status !== 'inactive' &&
        eq.status !== 'out_of_service'
    );
}

async function loadEquipments() {
    const tableBody = document.getElementById('equipmentTableBody');
    if (!tableBody) return;

    tableBody.innerHTML = `<tr><td colspan="5" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]"><div class="flex items-center justify-center gap-2"><span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>${__('A carregar inventário de equipamentos...')}</div></td></tr>`;

    try {
        const q = encodeURIComponent(document.getElementById('filter_q')?.value?.trim() || '');
        const status = encodeURIComponent(document.getElementById('filter_status')?.value ?? '');
        
        const url = `/equipments?per_page=100&q=${q}&status=${status}`;
        const res = await fetch(url, { headers: authHeader() });
        if (!res.ok) throw new Error(__('Não foi possível carregar os equipamentos de momento.'));
        
        const data = await res.json();
        
        if (data.equipments && Array.isArray(data.equipments.data)) {
            equipmentData = data.equipments.data;
        } else if (Array.isArray(data.data)) {
            equipmentData = data.data;
        } else if (data.equipments && Array.isArray(data.equipments)) {
            equipmentData = data.equipments;
        } else if (Array.isArray(data)) {
            equipmentData = data;
        } else {
            equipmentData = [];
        }

        renderTable();
    } catch (err) {
        tableBody.innerHTML = `<tr><td colspan="5" class="px-5 py-12 text-center text-xs text-rose-500 font-semibold">${err.message}</td></tr>`;
    }
}

function renderTable() {
    const tableBody = document.getElementById('equipmentTableBody');
    const resultsCount = document.getElementById('resultsCount');
    const q = (document.getElementById('filter_q')?.value || '').toLowerCase().trim();
    const statusFilter = document.getElementById('filter_status')?.value || '';

    if (!Array.isArray(equipmentData)) {
        equipmentData = [];
    }

    let filtered = equipmentData.filter(eq => {
        const matchQ = !q || 
            (eq.name && eq.name.toLowerCase().includes(q)) || 
            (eq.serial_number && eq.serial_number.toLowerCase().includes(q)) || 
            (eq.serial && eq.serial.toLowerCase().includes(q)) || 
            (eq.code && eq.code.toLowerCase().includes(q));

        const isOp = isEquipmentOperational(eq);

        let matchStatus = true;
        if (statusFilter === '1') {
            matchStatus = isOp;
        } else if (statusFilter === '0') {
            matchStatus = !isOp;
        }

        return matchQ && matchStatus;
    });

    resultsCount.textContent = `${filtered.length} ${__('registo(s) encontrado(s)')}`;

    if (filtered.length === 0) {
        tableBody.innerHTML = `<tr><td colspan="5" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]">${__('Nenhum equipamento encontrado com os filtros aplicados.')}</td></tr>`;
        document.getElementById('pagination').innerHTML = '';
        return;
    }

    const start = (currentPage - 1) * ROWS_PER_PAGE;
    const paginated = filtered.slice(start, start + ROWS_PER_PAGE);

    tableBody.innerHTML = paginated.map(eq => {
        const isOp = isEquipmentOperational(eq);
        const statusBadge = isOp 
            ? `<span class="px-2.5 py-1 rounded-lg text-[10px] font-bold bg-emerald-500/10 text-emerald-800 dark:text-emerald-400 border border-emerald-500/20 uppercase tracking-tight">${__('Operacional')}</span>`
            : `<span class="px-2.5 py-1 rounded-lg text-[10px] font-bold bg-rose-500/10 text-rose-800 dark:text-rose-400 border border-rose-500/20 uppercase tracking-tight">${__('Fora de Serviço')}</span>`;

        const serial = eq.serial_number || eq.serial || eq.code || '—';
        const roomName = eq.room ? formatDynamicText(eq.room.name) : '—';
        const eqName = formatDynamicText(eq.name || '—');

        return `
            <tr class="hover:bg-[var(--surface-2)]/50 transition-colors duration-150">
                <td class="px-5 py-4 font-mono text-[var(--text-soft)] font-bold">${serial}</td>
                <td class="px-5 py-4 font-semibold text-[var(--text)]">${eqName}</td>
                <td class="px-5 py-4 text-[var(--text-soft)] font-semibold">${roomName}</td>
                <td class="px-5 py-4">${statusBadge}</td>
                <td class="px-5 py-4 text-right flex items-center justify-end gap-2">
                    <button onclick='openEquipmentModal(${JSON.stringify(eq)})' class="px-3 py-1.5 bg-[var(--surface)] hover:bg-[var(--surface-2)] text-[11px] font-semibold text-[var(--text)] border border-[var(--border)] rounded-lg shadow-sm transition-all cursor-pointer">${__('Editar')}</button>
                    <a href="/ui/tickets/create?equipment_id=${eq.id}" class="px-3 py-1.5 bg-orange-500 hover:bg-orange-600 text-white text-[11px] font-bold rounded-lg shadow-sm transition-all">${__('Abrir Ticket')}</a>
                </td>
            </tr>
        `;
    }).join('');

    renderPagination(filtered.length);
}

function renderPagination(total) {
    const lastPage = Math.ceil(total / ROWS_PER_PAGE) || 1;
    const pagEl = document.getElementById('pagination');
    if (lastPage <= 1) { pagEl.innerHTML = ''; return; }

    pagEl.innerHTML = `
        <button onclick="changePage(${currentPage - 1})" ${currentPage <= 1 ? 'disabled' : ''}
            class="px-3 py-1.5 text-xs font-bold rounded-xl border border-[var(--border)] bg-[var(--surface)] hover:bg-[var(--surface-2)] disabled:opacity-40 disabled:cursor-not-allowed cursor-pointer">← ${__('Anterior')}</button>
        <span class="font-bold text-[var(--text-soft)]">${__('Página')} ${currentPage} ${__('de')} ${lastPage}</span>
        <button onclick="changePage(${currentPage + 1})" ${currentPage >= lastPage ? 'disabled' : ''}
            class="px-3 py-1.5 text-xs font-bold rounded-xl border border-[var(--border)] bg-[var(--surface)] hover:bg-[var(--surface-2)] disabled:opacity-40 disabled:cursor-not-allowed cursor-pointer">${__('Próxima')} →</button>
    `;
}

function changePage(p) {
    currentPage = p;
    renderTable();
}

function openNewEquipmentModal() {
    const modal = document.getElementById('equipmentModal');
    document.getElementById('equipmentModalTitle').textContent = __('Adicionar Equipamento');
    document.getElementById('equipmentForm').reset();
    document.getElementById('equipmentId').value = '';
    document.getElementById('eqStatus').value = '1';
    modal.classList.remove('hidden');
    setTimeout(() => modal.classList.remove('opacity-0'), 10);
}

function openEquipmentModal(eq) {
    const modal = document.getElementById('equipmentModal');
    document.getElementById('equipmentModalTitle').textContent = __('Editar Equipamento');
    document.getElementById('equipmentId').value = eq.id;
    document.getElementById('eqName').value = eq.name || '';
    document.getElementById('eqSerial').value = eq.serial_number || eq.serial || eq.code || '';
    document.getElementById('eqStatus').value = isEquipmentOperational(eq) ? '1' : '0';
    modal.classList.remove('hidden');
    setTimeout(() => modal.classList.remove('opacity-0'), 10);
}

function closeEquipmentModal() {
    const modal = document.getElementById('equipmentModal');
    modal.classList.add('opacity-0');
    setTimeout(() => modal.classList.add('hidden'), 300);
}

async function saveEquipment(e) {
    e.preventDefault();
    const id = document.getElementById('equipmentId').value;
    const name = document.getElementById('eqName').value;
    const serial_number = document.getElementById('eqSerial').value;
    const active = document.getElementById('eqStatus').value;

    const method = id ? 'PATCH' : 'POST';
    const url = id ? `/admin/equipment/${id}` : '/admin/equipment';

    try {
        const res = await fetch(url, {
            method: method,
            headers: Object.assign({ 'Content-Type': 'application/json' }, authHeader()),
            body: JSON.stringify({ name, serial_number, active })
        });
        if (!res.ok) throw new Error(__('Erro ao comunicar com o servidor.'));
        closeEquipmentModal();
        loadEquipments();
    } catch (err) {
        alert(err.message);
    }
}

document.getElementById('btnSearch').addEventListener('click', () => { currentPage = 1; loadEquipments(); });
document.getElementById('btnClear').addEventListener('click', () => {
    document.getElementById('filter_q').value = '';
    document.getElementById('filter_status').value = '';
    currentPage = 1;
    loadEquipments();
});
document.getElementById('filter_q').addEventListener('keydown', e => { if (e.key === 'Enter') { currentPage = 1; loadEquipments(); } });
document.getElementById('filter_status').addEventListener('change', () => { currentPage = 1; loadEquipments(); });

window.addEventListener('load', loadEquipments);
</script>
@endpush