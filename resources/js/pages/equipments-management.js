/**
 * Equipment Management Module
 * Handles equipment listing, filtering, and CRUD operations
 */

import { authHeader, authHeaderJson, authPost, authPatch, authDelete } from '../utils/api.js';

let currentPage = 1;

function showAddButton() {
    const btn = document.getElementById('btnAddEquipment');
    if (btn) {
        btn.classList.remove('hidden');
        btn.classList.add('inline-flex');
    }
}

async function verifyAdminRole() {
    const storedUser = localStorage.getItem('user');
    if (storedUser) {
        try {
            const u = JSON.parse(storedUser);
            if (u.is_admin || u.role === 'admin' || u.type === 'admin') {
                showAddButton();
            }
        } catch (e) {}
    }

    try {
        const res = await fetch('/api/user', { headers: authHeader() });
        if (res.ok) {
            const data = await res.json();
            const user = data.user || data;
            if (user.is_admin || user.role === 'admin' || user.type === 'admin') {
                showAddButton();
            }
        }
    } catch (e) {}
}

async function loadEquipments(page = 1) {
    currentPage = page;
    const params = new URLSearchParams();
    const q = document.getElementById('filter_q').value.trim();
    const status = document.getElementById('filter_status').value;

    if (q) params.append('q', q);
    if (status) params.append('status', status);
    params.append('page', page);

    const tbody = document.getElementById('equipmentTableBody');
    tbody.innerHTML = `<tr><td colspan="5" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]">A atualizar dados...</td></tr>`;

    try {
        const res = await fetch(`/equipments?${params.toString()}`, { headers: authHeader() });
        if (res.status === 401) {
            window.location = '/ui/login';
            return;
        }
        if (!res.ok) {
            throw new Error('Falha ao carregar');
        }
        const data = await res.json();

        const equipments = data.equipments?.data ?? [];
        const meta = data.equipments ?? {};
        const total = meta.total ?? equipments.length;

        document.getElementById('resultsCount').textContent = total > 0
            ? `${total} resultado(s) encontrado(s)`
            : 'Sem resultados';

        if (!equipments.length) {
            tbody.innerHTML = `<tr><td colspan="5" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]"><div class="mx-auto max-w-sm rounded-2xl border border-dashed border-[var(--border)] bg-[var(--surface-2)] p-5">Nenhum equipamento encontrado com os filtros aplicados.</div></td></tr>`;
            document.getElementById('pagination').innerHTML = '';
            return;
        }

        tbody.innerHTML = equipments.map(eq => {
            const is_active = eq.active === true || eq.active === 1 || eq.active === '1';
            const statusBadge = is_active
                ? `<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[11px] font-bold bg-emerald-500/10 text-emerald-700 dark:text-emerald-400 uppercase tracking-tight">Operacional</span>`
                : `<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[11px] font-bold bg-red-500/10 text-red-700 dark:text-red-400 uppercase tracking-tight">Fora de Serviço</span>`;

            return `<tr class="hover:bg-[var(--surface-2)]/50 transition-colors duration-150">
                <td class="px-5 py-4 font-mono text-[var(--text-soft)] font-bold">${eq.serial ?? `EQ-${String(eq.id).padStart(3, '0')}`}</td>
                <td class="px-5 py-4">
                    <div class="font-semibold text-[var(--text)]">${eq.name}</div>
                    <div class="text-[10px] text-[var(--text-soft)] uppercase tracking-wider mt-0.5">${eq.category?.name ?? 'Genérico'}</div>
                </td>
                <td class="px-5 py-4 text-[var(--text-soft)] font-semibold">${eq.room ? `${eq.room.name} (${eq.room.location ?? '—'})` : '—'}</td>
                <td class="px-5 py-4">${statusBadge}</td>
                <td class="px-5 py-4 text-right">
                    <a href="/ui/tickets/create?equipment_id=${eq.id}" class="inline-flex items-center justify-center px-3 py-1.5 bg-[var(--surface)] text-[11px] font-semibold text-[var(--text)] border border-[var(--border)] rounded-lg shadow-sm hover:bg-[var(--surface-2)] transition-all min-h-[28px]">Abrir Ticket</a>
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
        tbody.innerHTML = `<tr><td colspan="5" class="px-5 py-12 text-center text-xs text-[var(--color-danger)] font-medium">⚠️ Não foi possível carregar os equipamentos de momento.</td></tr>`;
    }
}

function openNewEquipmentModal() {
    const form = document.getElementById('equipmentForm');
    if (form) form.reset();
    document.getElementById('equipmentId').value = '';
    document.getElementById('equipmentModalTitle').textContent = 'Adicionar Equipamento';

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
    const url = id ? `/equipments/${id}` : '/equipments';

    try {
        const res = await fetch(url, {
            method,
            headers: Object.assign({ 'Content-Type': 'application/json' }, authHeader()),
            body: JSON.stringify(Object.fromEntries(formData)),
        });

        if (res.ok) {
            closeModal('equipmentModal');
            loadEquipments(currentPage);
        } else {
            alert('Ocorreu um erro ao guardar o equipamento.');
        }
    } catch (err) {
        alert('Erro ao comunicar com o servidor.');
    }
}

function init() {
    const btnSearch = document.getElementById('btnSearch');
    const btnClear = document.getElementById('btnClear');
    const filterQ = document.getElementById('filter_q');
    const equipmentForm = document.getElementById('equipmentForm');
    const btnAddEquipment = document.getElementById('btnAddEquipment');
    const pagination = document.getElementById('pagination');

    if (btnSearch) btnSearch.addEventListener('click', () => loadEquipments(1));
    if (btnClear) btnClear.addEventListener('click', () => {
        document.getElementById('filter_q').value = '';
        document.getElementById('filter_status').value = '';
        loadEquipments(1);
    });
    if (filterQ) filterQ.addEventListener('keydown', e => {
        if (e.key === 'Enter') loadEquipments(1);
    });
    if (equipmentForm) equipmentForm.addEventListener('submit', saveEquipment);
    if (btnAddEquipment) btnAddEquipment.addEventListener('click', openNewEquipmentModal);

    if (pagination) {
        pagination.addEventListener('click', (e) => {
            const btn = e.target.closest('button[data-page]');
            if (btn && !btn.disabled) {
                const page = parseInt(btn.dataset.page);
                loadEquipments(page);
            }
        });
    }

    verifyAdminRole();
    loadEquipments(1);
}

export { init };
