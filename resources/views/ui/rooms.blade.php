@extends('ui.layout')

@section('content')
<script>
window.requireAuthOnLoad = true;
</script>

@component('ui.partials.page-card', [
    'title' => __('Salas'),
    'subtitle' => __('Consulte e organize as salas e a sua relação com os equipamentos do inventário.'),
    'actions' => '<div class="flex items-center gap-2">'
        . '<a href="/ui" class="inline-flex items-center gap-2 px-4 py-2 text-xs font-semibold text-slate-300 bg-slate-800/60 hover:bg-slate-700/80 border border-slate-700/80 rounded-full transition-all">'
            . '<span>←</span> ' . __('Voltar ao painel')
        . '</a>'
        . '<button id="btnAddRoom" class="inline-flex items-center gap-1.5 px-4 py-2 text-xs font-bold text-white bg-orange-500 hover:bg-orange-600 rounded-full shadow-sm transition-all cursor-pointer">+ ' . __('Nova sala') . '</button>'
        . '</div>'
])

    {{-- Painel de Filtros de Pesquisa --}}
    <div class="mb-6 rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm">
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">

            <div class="sm:col-span-2 lg:col-span-2">
                <label for="filter_q" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">
                    {{ __('Termo de Pesquisa') }}
                </label>
                <input id="filter_q" type="text" placeholder="{{ __('Pesquise por nome ou código da sala...') }}"
                    class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-2.5 text-xs text-[var(--text)] placeholder-[var(--text-soft)] outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all">
            </div>

            <div>
                <label for="filter_building" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">
                    {{ __('Edifício') }}
                </label>
                <input id="filter_building" type="text" placeholder="{{ __('Filtrar por edifício...') }}"
                    class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-2.5 text-xs text-[var(--text)] placeholder-[var(--text-soft)] outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all">
            </div>

        </div>

        <div class="mt-4 pt-4 border-t border-[var(--border)] flex flex-wrap items-center justify-between gap-3">
            <div class="flex items-center gap-2">
                <button id="btnSearch" class="inline-flex items-center justify-center px-5 py-2 text-xs font-bold text-white bg-orange-500 hover:bg-orange-600 rounded-xl shadow-sm transition-all cursor-pointer min-h-[36px]">
                    {{ __('Pesquisar') }}
                </button>
                <button id="btnClear" class="inline-flex items-center justify-center px-5 py-2 text-xs font-semibold text-orange-500 bg-transparent border border-orange-500/40 hover:bg-orange-500/10 rounded-xl transition-all cursor-pointer min-h-[36px]">
                    {{ __('Limpar filtros') }}
                </button>
            </div>
            <div>
                <span id="resultsCount" class="text-xs font-medium text-[var(--text-soft)]"></span>
            </div>
        </div>
    </div>

    {{-- Tabela de Dados --}}
    <div class="w-full overflow-hidden bg-[var(--surface)] border border-[var(--border)] rounded-2xl shadow-sm">
        <div class="overflow-x-auto">
            <table id="roomsTable" class="min-w-full divide-y divide-[var(--border)] text-left text-xs">
                <thead class="bg-[var(--surface-2)] text-[var(--text-soft)] uppercase tracking-wider font-bold text-[10px]">
                    <tr>
                        <th class="px-5 py-3.5 font-bold">{{ __('Nome da Sala') }}</th>
                        <th class="px-5 py-3.5 font-bold">{{ __('Edifício') }}</th>
                        <th class="px-5 py-3.5 font-bold">{{ __('Equipamentos') }}</th>
                        <th class="px-5 py-3.5 font-bold text-right">{{ __('Ações') }}</th>
                    </tr>
                </thead>
                <tbody id="roomsTableBody" class="divide-y divide-[var(--border)] text-[var(--text)]">
                    <tr>
                        <td colspan="4" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]">
                            <div class="flex items-center justify-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-orange-500 animate-pulse"></span>
                                {{ __('A carregar listagem de salas...') }}
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

{{-- Modal para Criar / Editar Sala (Fora do Component para Ficar 100% Fixo na Ecrã) --}}
<div id="roomModal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/60 backdrop-blur-sm p-4 overflow-y-auto">
    <div class="relative w-full max-w-md rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-2xl transition-all my-auto">
        <h3 class="text-base font-bold text-[var(--text)] mb-4" id="roomModalTitle">{{ __('Dados da Sala') }}</h3>
        <form id="roomForm" class="space-y-4">
            <input type="hidden" id="roomId" name="id">

            <div>
                <label for="roomName" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Nome / Código da Sala') }}</label>
                <input id="roomName" name="name" type="text" required
                    class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all">
            </div>

            <div>
                <label for="roomBuilding" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Edifício') }}</label>
                <input id="roomBuilding" name="building" type="text" required
                    class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all">
            </div>

            <div class="mt-6 flex items-center justify-end gap-2 pt-4 border-t border-[var(--border)]">
                <button type="button" onclick="closeModal('roomModal')" class="px-4 py-2 text-xs font-semibold text-[var(--text)] bg-[var(--surface-2)] border border-[var(--border)] rounded-xl hover:bg-[var(--border)] transition-all cursor-pointer">
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
let currentPage = 1;

function authHeader(){
    const token = localStorage.getItem('sanctum_token');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const headers = { 'Accept': 'application/json' };

    if (token) headers['Authorization'] = 'Bearer ' + token;
    if (csrfToken) headers['X-CSRF-TOKEN'] = csrfToken;

    return headers;
}

async function loadRooms(page = 1) {
    currentPage = page;
    const params = new URLSearchParams();
    const q = document.getElementById('filter_q').value.trim();
    const building = document.getElementById('filter_building').value.trim();

    if (q) params.append('q', q);
    if (building) params.append('building', building);
    params.append('page', page);

    const tbody = document.getElementById('roomsTableBody');
    tbody.innerHTML = `<tr><td colspan="4" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]">${"{{ __('A atualizar dados...') }}"}</td></tr>`;

    try {
        const res = await fetch(`/api/rooms?${params.toString()}`, { headers: authHeader() });

        if (res.status === 401) {
            window.location = '/ui/login';
            return;
        }
        if (!res.ok) {
            document.getElementById('resultsCount').textContent = "{{ __('Erro ao carregar dados') }}";
            return;
        }

        const data = await res.json().catch(() => ({}));
        const rooms = data.rooms?.data ?? data.data ?? (Array.isArray(data) ? data : []);
        const meta = data.rooms?.meta ?? data.meta ?? {};
        const total = meta.total ?? rooms.length;

        document.getElementById('resultsCount').textContent = total > 0
            ? `${total} ${"{{ __('resultado(s) encontrado(s)') }}"}`
            : "{{ __('Sem resultados') }}";

        if (!rooms.length) {
            tbody.innerHTML = `<tr><td colspan="4" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]"><div class="mx-auto max-w-sm rounded-2xl border border-dashed border-[var(--border)] bg-[var(--surface-2)] p-5">${"{{ __('Nenhuma sala encontrada.') }}"}</div></td></tr>`;
            document.getElementById('pagination').innerHTML = '';
            return;
        }

        tbody.innerHTML = rooms.map(r => {
            const equipmentCount = r.equipment_count || 0;
            const eqLabel = equipmentCount === 1 ? "{{ __('Equipamento') }}" : "{{ __('Equipamentos') }}";

            return `<tr class="hover:bg-[var(--surface-2)]/50 transition-colors duration-150">
                <td class="px-5 py-4 font-bold text-xs text-[var(--text)]">${r.name}</td>
                <td class="px-5 py-4 text-[var(--text-soft)] font-medium">${r.building || '-'}</td>
                <td class="px-5 py-4">
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[10px] font-bold bg-slate-800 text-slate-300 border border-slate-700/80 uppercase tracking-wider">
                        ${equipmentCount} ${eqLabel}
                    </span>
                </td>
                <td class="px-5 py-4 text-right">
                    <button onclick="editRoom(${JSON.stringify(r).replace(/"/g, '&quot;')})"
                        class="inline-flex items-center justify-center px-3 py-1.5 text-xs font-semibold text-slate-200 bg-slate-800/80 hover:bg-slate-700/80 border border-slate-700/80 rounded-xl transition-all cursor-pointer">
                        ${"{{ __('Editar') }}"}
                    </button>
                </td>
            </tr>`;
        }).join('');

        const lastPage = meta.last_page ?? 1;
        const currPage = meta.current_page ?? page;
        const pagEl = document.getElementById('pagination');

        if (lastPage <= 1) {
            pagEl.innerHTML = '';
            return;
        }

        pagEl.innerHTML = `
            <button onclick="loadRooms(${currPage - 1})" ${currPage <= 1 ? 'disabled' : ''}
                class="px-3.5 py-2 text-xs font-semibold text-[var(--text)] bg-[var(--surface-2)] border border-[var(--border)] rounded-xl hover:bg-[var(--border)] transition-all disabled:opacity-40 disabled:cursor-not-allowed">← ${"{{ __('Anterior') }}"}</button>
            <span class="font-bold text-[var(--text-soft)]">${"{{ __('Página') }}"} ${currPage} ${"{{ __('de') }}"} ${lastPage}</span>
            <button onclick="loadRooms(${currPage + 1})" ${currPage >= lastPage ? 'disabled' : ''}
                class="px-3.5 py-2 text-xs font-semibold text-[var(--text)] bg-[var(--surface-2)] border border-[var(--border)] rounded-xl hover:bg-[var(--border)] transition-all disabled:opacity-40 disabled:cursor-not-allowed">${"{{ __('Próxima') }}"} →</button>
        `;
    } catch (error) {
        document.getElementById('resultsCount').textContent = "{{ __('Erro de ligação ao servidor') }}";
    }
}

function openNewRoomModal() {
    const form = document.getElementById('roomForm');
    if (form) form.reset();
    document.getElementById('roomId').value = '';
    document.getElementById('roomModalTitle').textContent = "{{ __('Nova Sala') }}";

    const modal = document.getElementById('roomModal');
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

function editRoom(room) {
    document.getElementById('roomId').value = room.id;
    document.getElementById('roomName').value = room.name || '';
    document.getElementById('roomBuilding').value = room.building || '';
    document.getElementById('roomModalTitle').textContent = "{{ __('Editar Sala') }}";

    const modal = document.getElementById('roomModal');
    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
    document.body.classList.add('overflow-hidden');
}

async function saveRoom(e) {
    e.preventDefault();
    const formData = new FormData(e.target);
    const id = formData.get('id');
    const method = id ? 'PUT' : 'POST';
    const url = id ? `/api/rooms/${id}` : '/api/rooms';

    try {
        const res = await fetch(url, {
            method,
            headers: Object.assign({'Content-Type': 'application/json'}, authHeader()),
            body: JSON.stringify(Object.fromEntries(formData))
        });

        if (res.ok) {
            closeModal('roomModal');
            loadRooms(currentPage);
        } else {
            alert("{{ __('Ocorreu um erro ao guardar os dados da sala.') }}");
        }
    } catch (err) {
        alert("{{ __('Erro ao comunicar com o servidor.') }}");
    }
}

document.getElementById('btnSearch')?.addEventListener('click', () => loadRooms(1));

document.getElementById('btnClear')?.addEventListener('click', () => {
    ['filter_q', 'filter_building'].forEach(id => {
        const el = document.getElementById(id);
        if (el) el.value = '';
    });
    loadRooms(1);
});

document.getElementById('filter_q')?.addEventListener('keydown', e => {
    if (e.key === 'Enter') loadRooms(1);
});

document.getElementById('filter_building')?.addEventListener('keydown', e => {
    if (e.key === 'Enter') loadRooms(1);
});

window.addEventListener('load', () => loadRooms(1));
</script>
@endpush
