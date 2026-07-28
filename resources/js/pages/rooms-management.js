/**
 * Rooms Management Module
 * Handles rooms listing, filtering, and CRUD operations
 */

let currentPage = 1;

function authHeader() {
    const token = localStorage.getItem('auth_token');
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
    const location = document.getElementById('filter_location').value.trim();

    if (q) params.append('q', q);
    if (location) params.append('location', location);
    params.append('page', page);

    const tbody = document.getElementById('roomsTableBody');
    tbody.innerHTML = `<tr><td colspan="4" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]">A atualizar dados...</td></tr>`;

    try {
        const res = await fetch(`/api/rooms?${params.toString()}`, { headers: authHeader() });

        if (res.status === 401) {
            window.location = '/ui/login';
            return;
        }
        if (!res.ok) {
            document.getElementById('resultsCount').textContent = 'Erro ao carregar dados';
            tbody.innerHTML = `<tr><td colspan="4" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]">Erro ao carregar dados</td></tr>`;
            return;
        }

        const data = await res.json();
        const rooms = data.rooms?.data ?? [];
        const meta = data.rooms ?? {};
        const total = meta.total ?? rooms.length;

        document.getElementById('resultsCount').textContent = total > 0
            ? `${total} resultado(s) encontrado(s)`
            : 'Sem resultados';

        if (!rooms.length) {
            tbody.innerHTML = `<tr><td colspan="4" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]"><div class="mx-auto max-w-sm rounded-2xl border border-dashed border-[var(--border)] bg-[var(--surface-2)] p-5">Nenhuma sala encontrada com os filtros aplicados.</div></td></tr>`;
            document.getElementById('pagination').innerHTML = '';
            return;
        }

        tbody.innerHTML = rooms.map(room => {
            const equipmentCount = room.equipments_count ?? room.equipments?.length ?? 0;
            return `<tr class="hover:bg-[var(--surface-2)]/50 transition-colors duration-150">
                <td class="px-5 py-4">
                    <div class="font-semibold text-[var(--text)]">${room.name}</div>
                    <div class="text-[10px] text-[var(--text-soft)] font-mono mt-0.5">${room.code || '—'}</div>
                </td>
                <td class="px-5 py-4 text-[var(--text-soft)] font-semibold">${room.location || '—'}</td>
                <td class="px-5 py-4">
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[11px] font-bold bg-blue-500/10 text-blue-700 dark:text-blue-400 uppercase tracking-tight">${equipmentCount} equipamento(s)</span>
                </td>
                <td class="px-5 py-4 text-right">
                    <a href="/ui/rooms/${room.id}" class="inline-flex items-center justify-center px-3 py-1.5 bg-[var(--surface)] text-[11px] font-semibold text-[var(--text)] border border-[var(--border)] rounded-lg shadow-sm hover:bg-[var(--surface-2)] transition-all min-h-[28px]">Ver detalhes</a>
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
            <button data-page="${currPage - 1}" ${currPage <= 1 ? 'disabled' : ''}
                class="ui-button ui-button--primary inline-flex items-center justify-center px-3.5 py-2 text-xs font-bold text-[var(--on-primary)] rounded-xl shadow-sm hover:opacity-90 transition-all disabled:opacity-40 disabled:cursor-not-allowed min-h-[36px]">← Anterior</button>
            <span class="font-bold text-[var(--text-soft)]">Página ${currPage} de ${lastPage}</span>
            <button data-page="${currPage + 1}" ${currPage >= lastPage ? 'disabled' : ''}
                class="ui-button ui-button--primary inline-flex items-center justify-center px-3.5 py-2 text-xs font-bold text-[var(--on-primary)] rounded-xl shadow-sm hover:opacity-90 transition-all disabled:opacity-40 disabled:cursor-not-allowed min-h-[36px]">Próxima →</button>
        `;
    } catch (error) {
        tbody.innerHTML = `<tr><td colspan="4" class="px-5 py-12 text-center text-xs text-[var(--color-danger)] font-medium">⚠️ Não foi possível carregar as salas de momento.</td></tr>`;
    }
}

function openNewRoomModal() {
    const form = document.getElementById('roomForm');
    if (form) form.reset();
    document.getElementById('roomId').value = '';
    document.getElementById('roomModalTitle').textContent = 'Dados da Sala';

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

async function saveRoom(e) {
    e.preventDefault();
    const formData = new FormData(e.target);
    const id = formData.get('id');
    const method = id ? 'PUT' : 'POST';
    const url = id ? `/api/rooms/${id}` : '/api/rooms';

    try {
        const res = await fetch(url, {
            method,
            headers: Object.assign({ 'Content-Type': 'application/json' }, authHeader()),
            body: JSON.stringify(Object.fromEntries(formData)),
        });

        if (res.ok) {
            closeModal('roomModal');
            loadRooms(currentPage);
        } else {
            alert('Ocorreu um erro ao guardar a sala.');
        }
    } catch (err) {
        alert('Erro ao comunicar com o servidor.');
    }
}

function init() {
    const btnSearch = document.getElementById('btnSearch');
    const btnClear = document.getElementById('btnClear');
    const filterQ = document.getElementById('filter_q');
    const roomForm = document.getElementById('roomForm');
    const btnAddRoom = document.getElementById('btnAddRoom');
    const pagination = document.getElementById('pagination');

    if (btnSearch) btnSearch.addEventListener('click', () => loadRooms(1));
    if (btnClear) btnClear.addEventListener('click', () => {
        document.getElementById('filter_q').value = '';
        document.getElementById('filter_location').value = '';
        loadRooms(1);
    });
    if (filterQ) filterQ.addEventListener('keydown', e => {
        if (e.key === 'Enter') loadRooms(1);
    });
    if (roomForm) roomForm.addEventListener('submit', saveRoom);
    if (btnAddRoom) btnAddRoom.addEventListener('click', openNewRoomModal);

    if (pagination) {
        pagination.addEventListener('click', (e) => {
            const btn = e.target.closest('button[data-page]');
            if (btn && !btn.disabled) {
                const page = parseInt(btn.dataset.page);
                loadRooms(page);
            }
        });
    }

    loadRooms(1);
}

export { init };
