@extends('ui.layout')

@section('content')
<script>
window.requireAuthOnLoad = true;
</script>

@component('ui.partials.page-card', [
    'title' => __('Equipamentos'),
    'subtitle' => __('Inventário centralizado de equipamentos, localizações e estado operacional.'),
    'actions' => '<div class="flex items-center gap-2">'
        . '<a href="/ui" class="inline-flex items-center gap-2 px-4 py-2 text-xs font-semibold text-slate-300 bg-slate-800/60 hover:bg-slate-700/80 border border-slate-700/80 rounded-full transition-all">'
            . '<span>←</span> ' . __('Voltar ao painel')
        . '</a>'
        . '<button id="btnAddEquipment" onclick="openNewEquipmentModal()" class="inline-flex items-center gap-1.5 px-4 py-2 text-xs font-bold text-white bg-orange-500 hover:bg-orange-600 rounded-full shadow-sm transition-all cursor-pointer">+ ' . __('Novo equipamento') . '</button>'
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
                    <option value="active">{{ __('Operacional') }}</option>
                    <option value="inactive">{{ __('Fora de Serviço') }}</option>
                </select>
            </div>
        </div>

        <div class="mt-4 pt-4 border-t border-[var(--border)] flex flex-wrap items-center justify-between gap-2">
            <div class="flex items-center gap-2">
                <button id="btnSearch" class="inline-flex items-center justify-center px-4 py-2 bg-orange-500 text-white text-xs font-bold rounded-xl shadow-sm hover:bg-orange-600 transition-all cursor-pointer min-h-[36px]">
                    {{ __('Pesquisar') }}
                </button>
                <button id="btnClear" class="inline-flex items-center justify-center px-4 py-2 text-[var(--text)] border border-[var(--border)] text-xs font-semibold rounded-xl shadow-sm hover:bg-[var(--surface-2)] transition-all cursor-pointer min-h-[36px]">
                    {{ __('Limpar filtros') }}
                </button>
            </div>
            <span id="resultsCount" class="text-xs font-semibold text-[var(--text-soft)]"></span>
        </div>
    </div>

    {{-- Tabela de Resultados --}}
    <div class="w-full overflow-hidden bg-[var(--surface)] border border-[var(--border)] rounded-2xl shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-[var(--border)] text-left text-xs">
                <thead class="bg-[var(--surface-2)] text-[var(--text-soft)] uppercase tracking-wider font-bold text-[10px]">
                    <tr>
                        <th class="px-5 py-4 font-bold">{{ __('Código / Nº Série') }}</th>
                        <th class="px-5 py-4 font-bold">{{ __('Equipamento') }}</th>
                        <th class="px-5 py-4 font-bold">{{ __('Sala / Localização') }}</th>
                        <th class="px-5 py-4 font-bold">{{ __('Estado') }}</th>
                        <th class="px-5 py-4 font-bold text-right">{{ __('Ações') }}</th>
                    </tr>
                </thead>
                <tbody id="equipmentTableBody" class="divide-y divide-[var(--border)] text-[var(--text)]">
                    <tr>
                        <td colspan="5" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]">
                            <div class="flex items-center justify-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-orange-500 animate-pulse"></span>
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
<div id="equipmentModal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/60 backdrop-blur-sm p-4 overflow-y-auto">
    <div class="relative w-full max-w-lg rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-2xl transition-all my-auto">
        <h3 class="text-base font-bold text-[var(--text)] mb-4" id="equipmentModalTitle">{{ __('Adicionar Equipamento') }}</h3>

        <form id="equipmentForm" onsubmit="saveEquipment(event)" class="space-y-4">
            <input type="hidden" id="equipmentId" name="id">

            <div>
                <label for="eqName" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Nome do Equipamento') }}</label>
                <input id="eqName" name="name" type="text" required placeholder="Ex: Projetor Epson EB-2250U"
                    class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all">
            </div>

            <div>
                <label for="eqRoom" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Sala Atribuída / Localização') }}</label>
                <select id="eqRoom" name="room_id" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all">
                    <option value="">{{ __('Sem Sala Atribuída') }}</option>
                </select>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="eqSerial" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Número de Série / Código') }}</label>
                    <input id="eqSerial" name="serial" type="text" placeholder="Ex: SN-987654"
                        class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all">
                </div>

                <div>
                    <label for="eqStatus" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Estado Operacional') }}</label>
                    <select id="eqStatus" name="active" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all">
                        <option value="1">{{ __('Operacional') }}</option>
                        <option value="0">{{ __('Fora de Serviço') }}</option>
                    </select>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-2 pt-4 border-t border-[var(--border)]">
                <button type="button" onclick="closeModal('equipmentModal')" class="px-4 py-2 text-xs font-semibold text-[var(--text)] bg-[var(--surface-2)] border border-[var(--border)] rounded-xl hover:bg-[var(--border)] transition-all cursor-pointer">
                    {{ __('Cancelar') }}
                </button>
                <button type="submit" class="px-4 py-2 text-xs font-bold text-white bg-orange-500 hover:bg-orange-600 rounded-xl shadow-sm transition-all cursor-pointer">
                    {{ __('Guardar Equipamento') }}
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
let currentPage = 1;
let loadedRoomsList = [];

function authHeader(){
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

async function fetchWithFallback(urlPath, options = {}) {
    const endpoints = [`/api${urlPath}`, urlPath, `/admin${urlPath}`];
    for (const ep of endpoints) {
        try {
            const res = await fetch(ep, options);
            if (res.status === 401) {
                window.location = '/ui/login';
                return null;
            }
            if (res.ok) {
                return res;
            }
        } catch (e) {}
    }
    return null;
}

async function populateRoomsDropdown(selectedRoomId = null) {
    const select = document.getElementById('eqRoom');
    if (!select) return;

    if (loadedRoomsList.length === 0) {
        try {
            const res = await fetchWithFallback('/rooms', { headers: authHeader() });
            if (res && res.ok) {
                const data = await res.json();
                loadedRoomsList = data.rooms?.data || data.rooms || data.data || (Array.isArray(data) ? data : []);
            }
        } catch (e) {}
    }

    select.innerHTML = '<option value="">Sem Sala Atribuída</option>' + 
        loadedRoomsList.map(r => {
            const loc = r.location || r.building ? ` (${r.location || r.building})` : '';
            return `<option value="${r.id}" ${String(r.id) === String(selectedRoomId) ? 'selected' : ''}>${r.name}${loc}</option>`;
        }).join('');
}

async function loadEquipments(page = 1) {
    currentPage = page;
    const params = new URLSearchParams();
    const q = document.getElementById('filter_q')?.value.trim() || '';
    const status = document.getElementById('filter_status')?.value || '';

    if (q) params.append('q', q);
    if (status) params.append('status', status);
    params.append('page', page);

    const tbody = document.getElementById('equipmentTableBody');
    if (tbody) tbody.innerHTML = `<tr><td colspan="5" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]">A carregar equipamentos...</td></tr>`;

    try {
        const res = await fetchWithFallback(`/equipments?${params.toString()}`, { headers: authHeader() });
        
        if (!res || !res.ok) {
            throw new Error('Falha ao carregar dados');
        }

        const data = await res.json();
        const equipments = data.equipments?.data ?? data.data ?? (Array.isArray(data) ? data : []);
        const meta = data.equipments ?? data.meta ?? {};
        const total = meta.total ?? equipments.length;

        document.getElementById('resultsCount').textContent = total > 0 ? `${total} registo(s) encontrado(s)` : "Sem resultados";

        if (!equipments.length) {
            tbody.innerHTML = `<tr><td colspan="5" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]"><div class="mx-auto max-w-sm rounded-2xl border border-dashed border-[var(--border)] bg-[var(--surface-2)] p-5">Nenhum equipamento encontrado.</div></td></tr>`;
            document.getElementById('pagination').innerHTML = '';
            return;
        }

        tbody.innerHTML = equipments.map(eq => {
            const is_active = eq.active === true || eq.active === 1 || eq.active === '1';
            const statusBadge = is_active
                ? `<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[10px] font-bold bg-emerald-500/10 text-emerald-500 border border-emerald-500/20 uppercase tracking-wider">Operacional</span>`
                : `<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[10px] font-bold bg-rose-500/10 text-rose-500 border border-rose-500/20 uppercase tracking-wider">Fora de Serviço</span>`;

            const loc = eq.room?.location || eq.room?.building ? ` (${eq.room.location || eq.room.building})` : '';
            const roomName = eq.room ? `${eq.room.name}${loc}` : '— Sem Sala';

            return `<tr class="hover:bg-[var(--surface-2)]/50 transition-colors duration-150">
                <td class="px-5 py-4 font-mono text-[var(--text-soft)] font-bold">${eq.serial ?? `EQ-${String(eq.id).padStart(3, '0')}`}</td>
                <td class="px-5 py-4">
                    <div class="font-semibold text-[var(--text)]">${eq.name}</div>
                    <div class="text-[10px] text-[var(--text-soft)] uppercase tracking-wider mt-0.5">${eq.category?.name ?? 'Genérico'}</div>
                </td>
                <td class="px-5 py-4 font-semibold text-[var(--text-soft)]">${roomName}</td>
                <td class="px-5 py-4">${statusBadge}</td>
                <td class="px-5 py-4 text-right flex items-center justify-end gap-2">
                    <button onclick='editEquipment(${JSON.stringify(eq)})' class="inline-flex items-center justify-center px-3 py-1.5 text-xs font-semibold text-slate-200 bg-slate-800/80 hover:bg-slate-700/80 border border-slate-700/80 rounded-xl transition-all cursor-pointer">
                        Editar
                    </button>
                    <a href="/ui/tickets/create?equipment_id=${eq.id}" class="inline-flex items-center justify-center px-3 py-1.5 bg-orange-500 text-white text-xs font-bold rounded-xl shadow-sm hover:bg-orange-600 transition-all">
                        Abrir Ticket
                    </a>
                </td>
            </tr>`;
        }).join('');

        const lastPage  = meta.last_page ?? 1;
        const currPage  = meta.current_page ?? page;
        const pagEl     = document.getElementById('pagination');
        if (lastPage <= 1) { pagEl.innerHTML = ''; return; }
        pagEl.innerHTML = `
            <button onclick="loadEquipments(${currPage - 1})" ${currPage <= 1 ? 'disabled' : ''}
                class="px-3.5 py-2 text-xs font-semibold text-[var(--text)] bg-[var(--surface-2)] border border-[var(--border)] rounded-xl hover:bg-[var(--border)] transition-all disabled:opacity-40 disabled:cursor-not-allowed">← Anterior</button>
            <span class="font-bold text-[var(--text-soft)]">Página ${currPage} de ${lastPage}</span>
            <button onclick="loadEquipments(${currPage + 1})" ${currPage >= lastPage ? 'disabled' : ''}
                class="px-3.5 py-2 text-xs font-semibold text-[var(--text)] bg-[var(--surface-2)] border border-[var(--border)] rounded-xl hover:bg-[var(--border)] transition-all disabled:opacity-40 disabled:cursor-not-allowed">Próxima →</button>
        `;
    } catch (error) {
        tbody.innerHTML = `<tr><td colspan="5" class="px-5 py-12 text-center text-xs text-rose-400 font-medium">⚠️ Não foi possível carregar os equipamentos.</td></tr>`;
    }
}

async function openNewEquipmentModal() {
    const form = document.getElementById('equipmentForm');
    if (form) form.reset();
    document.getElementById('equipmentId').value = '';
    document.getElementById('equipmentModalTitle').textContent = "Adicionar Equipamento";

    await populateRoomsDropdown();

    const modal = document.getElementById('equipmentModal');
    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
    document.body.classList.add('overflow-hidden');
}

async function editEquipment(eq) {
    document.getElementById('equipmentId').value = eq.id;
    document.getElementById('eqName').value = eq.name || '';
    document.getElementById('eqSerial').value = eq.serial || '';
    document.getElementById('eqStatus').value = (eq.active === true || eq.active === 1 || eq.active === '1') ? '1' : '0';
    document.getElementById('equipmentModalTitle').textContent = "Editar Equipamento";

    await populateRoomsDropdown(eq.room_id);

    const modal = document.getElementById('equipmentModal');
    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
    document.body.classList.add('overflow-hidden');
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
    document.body.classList.remove('overflow-hidden');
}

async function saveEquipment(e) {
    e.preventDefault();
    const formData = new FormData(e.target);
    const id = formData.get('id');
    const method = id ? 'PUT' : 'POST';
    const urlPath = id ? `/equipments/${id}` : '/equipments';

    try {
        const res = await fetchWithFallback(urlPath, {
            method,
            headers: Object.assign({'Content-Type': 'application/json'}, authHeader()),
            body: JSON.stringify(Object.fromEntries(formData))
        });

        if (res && res.ok) {
            closeModal('equipmentModal');
            loadEquipments(currentPage);
        } else {
            alert("Ocorreu um erro ao guardar o equipamento.");
        }
    } catch (err) {
        alert("Erro ao comunicar com o servidor.");
    }
}

document.getElementById('btnSearch')?.addEventListener('click', () => loadEquipments(1));

document.getElementById('btnClear')?.addEventListener('click', () => {
    document.getElementById('filter_q').value = '';
    document.getElementById('filter_status').value = '';
    loadEquipments(1);
});

document.getElementById('filter_q')?.addEventListener('keydown', e => {
    if (e.key === 'Enter') loadEquipments(1);
});

window.addEventListener('load', () => {
    loadEquipments(1);
});
</script>
@endpush