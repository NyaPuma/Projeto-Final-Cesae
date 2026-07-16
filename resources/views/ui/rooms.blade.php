@extends('ui.layout')

@section('content')
<script>
// Marcar que esta página requer autenticação
window.requireAuthOnLoad = true;
</script>

@component('ui.partials.page-card', [
    'title' => __('Salas'),
    'subtitle' => __('Consulte e organize as salas e a sua relação com os equipamentos do inventário.'),
    'actions' => '<button onclick="openNewRoomModal()" class="inline-flex items-center justify-center px-5 py-2 bg-orange-500 hover:bg-orange-600 text-xs font-bold text-white rounded-full shadow-sm transition-all cursor-pointer hover:opacity-90">+ ' . __('Nova sala') . '</button>'
])

    <hr class="border-[var(--border)] mb-6">

    {{-- Bento Grid de Visão Geral (Imagem 1) --}}
    <div class="grid gap-4 md:grid-cols-3 mb-6 animate-[fadeIn_0.2s_ease-out]">
        <!-- Visão Geral -->
        <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm flex flex-col justify-between min-h-[160px]">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Visão Geral') }}</span>
                <h3 class="text-2xl font-bold text-[var(--text)] tracking-tight mt-2 mb-2">{{ __('Gestão de espaços físicos') }}</h3>
            </div>
            <p class="text-xs text-[var(--text-soft)] leading-relaxed">
                {{ __('Cada sala pode ser associada a equipamentos, técnicos e tickets para facilitar a monitorização operacional.') }}
            </p>
        </div>

        <!-- Estado Dinâmico -->
        <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm flex flex-col justify-between min-h-[160px]">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Estado') }}</span>
                <div id="roomsCountCard" class="text-4xl font-extrabold text-[var(--text)] mt-2 mb-2">0</div>
            </div>
            <p class="text-xs text-[var(--text-soft)] leading-relaxed">
                {{ __('Salas registadas no sistema.') }}
            </p>
        </div>

        <!-- Próximo Passo -->
        <div class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm flex flex-col justify-between min-h-[160px]">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Próximo Passo') }}</span>
            </div>
            <p class="text-xs text-[var(--text-soft)] leading-relaxed mb-1">
                {{ __('Crie ou edite entradas para manter a estrutura da infraestrutura atualizada.') }}
            </p>
        </div>
    </div>

    {{-- Painel de Pesquisa Avançada Bento-Style (Imagem 2) --}}
    <div class="mb-6 rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm">
        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="filter_q" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Termo de Pesquisa') }}</label>
                <div class="relative">
                    <input id="filter_q" placeholder="{{ __('Pesquise por nome da sala...') }}"
                        class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] placeholder-[var(--text-soft)] outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/10 transition-all">
                </div>
            </div>

            <div>
                <label for="filter_building" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Edifício') }}</label>
                <div class="relative">
                    <input id="filter_building" placeholder="{{ __('Filtrar por edifício...') }}"
                        class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] placeholder-[var(--text-soft)] outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/10 transition-all">
                </div>
            </div>
        </div>

        <div class="mt-4 pt-4 border-t border-[var(--border)] flex flex-wrap items-center justify-between gap-2">
            <div class="flex items-center gap-2">
                <button id="btnSearch" class="inline-flex items-center justify-center px-6 py-2 bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold rounded-xl shadow-sm transition-all cursor-pointer min-h-[38px]">
                    {{ __('Pesquisar') }}
                </button>
                <button id="btnClear" class="inline-flex items-center justify-center px-6 py-2 bg-transparent border border-orange-500 text-orange-500 hover:bg-orange-500/10 text-xs font-semibold rounded-xl shadow-sm transition-all cursor-pointer min-h-[38px]">
                    {{ __('Limpar filtros') }}
                </button>
            </div>
            <span id="resultsCount" class="text-xs font-semibold text-[var(--text-soft)]"></span>
        </div>
    </div>

    {{-- Tabela de Resultados Estruturada (Imagem 2) --}}
    <div class="w-full overflow-hidden bg-[var(--surface)] border border-[var(--border)] rounded-2xl shadow-sm" role="region" aria-live="polite" aria-label="{{ __('Lista de salas') }}">
        <div class="overflow-x-auto">
            <table id="roomsTable" class="min-w-full divide-y divide-[var(--border)] text-left text-xs">
                <thead class="bg-[var(--surface-2)] text-[var(--text-soft)] uppercase tracking-wider font-bold text-[10px]">
                    <tr>
                        <th class="px-5 py-4 font-bold">{{ __('Nome') }}</th>
                        <th class="px-5 py-4 font-bold">{{ __('Edifício') }}</th>
                        <th class="px-5 py-4 font-bold">{{ __('Equipamentos') }}</th>
                        <th class="px-5 py-4 font-bold text-right">{{ __('Ações') }}</th>
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

    {{-- Área de Paginação Alinhada --}}
    <div id="pagination" class="mt-5 flex items-center justify-between text-xs text-[var(--text-soft)] px-1"></div>

    {{-- Modal de Edição/Criação --}}
    <x-ui.modal id="roomModal" title="{{ __('Adicionar / Editar Sala') }}">
        <form id="roomForm" onsubmit="saveRoom(event)">
            @csrf
            <input type="hidden" name="id" id="roomId">
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[var(--text-soft)] mb-1.5">{{ __('Nome da Sala') }}</label>
                    <input type="text" name="name" id="roomName" required
                        class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] placeholder-[var(--text-soft)] outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/10 transition-all">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-[var(--text-soft)] mb-1.5">{{ __('Edifício') }}</label>
                    <input type="text" name="building" id="roomBuilding" required
                        class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] placeholder-[var(--text-soft)] outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/10 transition-all">
                </div>
            </div>
            <div class="mt-6 flex justify-end gap-2">
                <button type="button" onclick="closeModal('roomModal')"
                    class="inline-flex items-center justify-center px-4 py-2 bg-[var(--surface)] text-[var(--text)] border border-[var(--border)] text-xs font-semibold rounded-xl shadow-sm hover:bg-[var(--surface-2)] transition-all cursor-pointer min-h-[36px]">
                    {{ __('Cancelar') }}
                </button>
                <button type="submit"
                    class="inline-flex items-center justify-center px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold rounded-xl shadow-sm transition-all cursor-pointer min-h-[36px]">
                    {{ __('Guardar Alterações') }}
                </button>
            </div>
        </form>
    </x-ui.modal>

@endcomponent
@endsection

@push('scripts')
<script>
let currentPage = 1;

function authHeader(){
    const token = localStorage.getItem('api_token');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const headers = { 'Accept': 'application/json' };

    if (token) headers['X-Auth-Token'] = token;
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
            showFeedback("{{ __('Autenticação necessária. Faça login.') }}", true);
            window.location = '/ui/login';
            return;
        }
        if (!res.ok) {
            showFeedback("{{ __('Não foi possível carregar as salas de momento.') }}", true);
            return;
        }

        const data = await res.json().catch(() => ({}));

        const rooms = data.rooms?.data ?? data.data ?? (Array.isArray(data) ? data : []);
        const meta = data.rooms?.meta ?? data.meta ?? {};
        const total = meta.total ?? rooms.length;

        // Atualizar contador do Bento Grid (Imagem 1)
        const countCard = document.getElementById('roomsCountCard');
        if (countCard) {
            countCard.textContent = total;
        }

        document.getElementById('resultsCount').textContent = total > 0 ? `${total} ${"{{ __('resultado(s) encontrado(s)') }}"}` : "{{ __('Sem resultados') }}";

        if (!rooms.length) {
            tbody.innerHTML = `<tr><td colspan="4" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]"><div class="mx-auto max-w-sm rounded-2xl border border-dashed border-[var(--border)] bg-[var(--surface-2)] p-5">${"{{ __('Nenhuma sala encontrada com os filtros aplicados.') }}"}</div></td></tr>`;
            document.getElementById('pagination').innerHTML = '';
            return;
        }

        tbody.innerHTML = rooms.map(r => {
            const equipmentCount = r.equipment_count || 0;
            const eqLabel = equipmentCount === 1 ? "{{ __('Equipamento') }}" : "{{ __('Equipamentos') }}";

            return `<tr class="hover:bg-[var(--surface-2)]/50 transition-colors duration-150">
                <td class="px-5 py-4 font-bold text-sm text-white">${r.name}</td>
                <td class="px-5 py-4 text-sky-400 dark:text-sky-400 font-semibold">${r.building}</td>
                <td class="px-5 py-4">
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[10px] font-bold bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 uppercase tracking-wider">
                        ${equipmentCount} ${eqLabel}
                    </span>
                </td>
                <td class="px-5 py-4 text-right">
                    <button onclick="editRoom(${JSON.stringify(r).replace(/"/g, '&quot;')})"
                        class="inline-flex items-center justify-center px-4 py-1.5 bg-transparent text-xs font-semibold text-white border border-gray-700 hover:border-gray-500 rounded-xl transition-all min-h-[32px] cursor-pointer hover:bg-white/5">
                        ${"{{ __('Editar') }}"}
                    </button>
                </td>
            </tr>`;
        }).join('');

        // Renderização do Bloco de Paginação Estilizado em Laranja
        const lastPage = meta.last_page ?? 1;
        const currPage = meta.current_page ?? page;
        const pagEl = document.getElementById('pagination');

        if (lastPage <= 1) {
            pagEl.innerHTML = '';
            return;
        }

        pagEl.innerHTML = `
            <button onclick="loadRooms(${currPage - 1})" ${currPage <= 1 ? 'disabled' : ''}
                class="inline-flex items-center justify-center px-3.5 py-2 bg-orange-500 hover:bg-orange-600 text-xs font-bold text-white rounded-xl shadow-sm transition-all disabled:opacity-40 disabled:cursor-not-allowed min-h-[36px]">← ${"{{ __('Anterior') }}"}</button>
            <span class="font-bold text-[var(--text-soft)]">${"{{ __('Página') }}"} ${currPage} ${"{{ __('de') }}"} ${lastPage}</span>
            <button onclick="loadRooms(${currPage + 1})" ${currPage >= lastPage ? 'disabled' : ''}
                class="inline-flex items-center justify-center px-3.5 py-2 bg-orange-500 hover:bg-orange-600 text-xs font-bold text-white rounded-xl shadow-sm transition-all disabled:opacity-40 disabled:cursor-not-allowed min-h-[36px]">${"{{ __('Próxima') }}"} →</button>
        `;
    } catch (error) {
        showFeedback("{{ __('Não foi possível carregar as salas.') }}", true);
    }
}

function openNewRoomModal() {
    document.getElementById('roomForm').reset();
    document.getElementById('roomId').value = '';
    openModal('roomModal');
}

function editRoom(room) {
    document.getElementById('roomId').value = room.id;
    document.getElementById('roomName').value = room.name;
    document.getElementById('roomBuilding').value = room.building;
    openModal('roomModal');
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

function showFeedback(message, error = false) {
    const el = document.getElementById('resultsCount');
    if (!el) return;
    el.textContent = message;
    el.className = `text-xs font-semibold ${error ? 'text-red-700 dark:text-red-400' : 'text-[var(--text-soft)]'}`;
}

document.getElementById('btnSearch').addEventListener('click', () => loadRooms(1));

document.getElementById('btnClear').addEventListener('click', () => {
    ['filter_q', 'filter_building'].forEach(id => {
        const el = document.getElementById(id);
        if (el) el.value = '';
    });
    loadRooms(1);
});

document.getElementById('filter_q').addEventListener('keydown', e => {
    if (e.key === 'Enter') loadRooms(1);
});

document.getElementById('filter_building').addEventListener('keydown', e => {
    if (e.key === 'Enter') loadRooms(1);
});

window.addEventListener('load', () => loadRooms(1));
</script>
@endpush
