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
    // Correção: Texto injetado diretamente sem o \${""} do JS
    tbody.innerHTML = `<tr><td colspan="4" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]">{{ __('A atualizar dados...') }}</td></tr>`;

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

        // Atualizar contador do Bento Grid
        const countCard = document.getElementById('roomsCountCard');
        if (countCard) {
            countCard.textContent = total;
        }

        // Correção: Interpolação de variável simplificada sem escapar
        document.getElementById('resultsCount').textContent = total > 0 ? `${total} {{ __('resultado(s) encontrado(s)') }}` : "{{ __('Sem resultados') }}";

        if (!rooms.length) {
            // Correção: Texto estático injetado diretamente de forma limpa
            tbody.innerHTML = `<tr><td colspan="4" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]"><div class="mx-auto max-w-sm rounded-2xl border border-dashed border-[var(--border)] bg-[var(--surface-2)] p-5">{{ __('Nenhuma sala encontrada com os filtros aplicados.') }}</div></td></tr>`;
            document.getElementById('pagination').innerHTML = '';
            return;
        }

        tbody.innerHTML = rooms.map(r => {
            const equipmentCount = r.equipment_count || 0;
            const eqLabel = equipmentCount === 1 ? "{{ __('Equipamento') }}" : "{{ __('Equipamentos') }}";

            // Correção: Removidas as barras invertidas (\) antes das variáveis do JS
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
                        {{ __('Editar') }}
                    </button>
                </td>
            </tr>`;
        }).join('');

        // Renderização do Bloco de Paginação Estilizado
        const lastPage = meta.last_page ?? 1;
        const currPage = meta.current_page ?? page;
        const pagEl = document.getElementById('pagination');

        if (lastPage <= 1) {
            pagEl.innerHTML = '';
            return;
        }

        // Correção: Removidas as barras invertidas e simplificadas as traduções
        pagEl.innerHTML = `
            <button onclick="loadRooms(${currPage - 1})" ${currPage <= 1 ? 'disabled' : ''}
                class="inline-flex items-center justify-center px-3.5 py-2 bg-orange-500 hover:bg-orange-600 text-xs font-bold text-white rounded-xl shadow-sm transition-all disabled:opacity-40 disabled:cursor-not-allowed min-h-[36px]">← {{ __('Anterior') }}</button>
            <span class="font-bold text-[var(--text-soft)]">{{ __('Página') }} ${currPage} {{ __('de') }} ${lastPage}</span>
            <button onclick="loadRooms(${currPage + 1})" ${currPage >= lastPage ? 'disabled' : ''}
                class="inline-flex items-center justify-center px-3.5 py-2 bg-orange-500 hover:bg-orange-600 text-xs font-bold text-white rounded-xl shadow-sm transition-all disabled:opacity-40 disabled:cursor-not-allowed min-h-[36px]">{{ __('Próxima') }} →</button>
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
