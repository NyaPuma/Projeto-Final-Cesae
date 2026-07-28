/**
 * Users Management Module
 * Handles users listing, filtering, and role management
 */

import { authHeader } from '../utils/api.js';

let currentPage = 1;

function isUserActive(user) {
    return user.active === true || user.active === 1 || user.active === '1' || String(user.active).toLowerCase() === 'true';
}

function getUserRole(user) {
    return user.profile?.name || user.role || user.profile || '';
}

async function loadUsers(page = 1) {
    currentPage = page;
    const params = new URLSearchParams();
    const q = document.getElementById('usersSearch').value.trim();
    const role = document.getElementById('usersRole').value;
    const status = document.getElementById('usersStatus').value;

    if (q) params.append('q', q);
    if (role) params.append('role', role);
    if (status) params.append('status', status);
    params.append('page', page);

    const tbody = document.querySelector('#usersTable tbody');
    tbody.innerHTML = `<tr><td colspan="6" class="px-6 py-12 text-center text-xs text-[var(--text-soft)]">A atualizar dados...</td></tr>`;

    try {
        const profilesSelect = document.getElementById('usersRole');
        if (profilesSelect && profilesSelect.options.length <= 1) {
            const pRes = await fetch('/admin/profiles', { headers: authHeader() });
            if (pRes.ok) {
                const pData = await pRes.json();
                const profiles = pData.profiles || [];
                profiles.forEach(p => {
                    const opt = document.createElement('option');
                    opt.value = p.name;
                    opt.textContent = p.name.toUpperCase();
                    profilesSelect.appendChild(opt);
                });
            }
        }

        const res = await fetch(`/admin/users?${params.toString()}`, { headers: authHeader() });
        if (res.status === 401) {
            window.location = '/ui/login';
            return;
        }
        if (!res.ok) {
            throw new Error('Erro ao carregar');
        }
        const data = await res.json();

        const users = data.users?.data ?? data.users ?? [];
        const meta = data.users ?? {};
        const total = meta.total ?? users.length;

        document.getElementById('resultsCount').textContent = total > 0
            ? `${total} resultado(s) encontrado(s)`
            : 'Sem resultados';

        if (!users.length) {
            tbody.innerHTML = `<tr><td colspan="6" class="px-6 py-12 text-center text-xs text-[var(--text-soft)] italic">Nenhum utilizador encontrado com os filtros selecionados.</td></tr>`;
            document.getElementById('pagination').innerHTML = '';
            return;
        }

        tbody.innerHTML = '';
        users.forEach(user => {
            const tr = document.createElement('tr');
            tr.className = 'hover:bg-[var(--surface-2)]/50 transition-colors duration-150';

            const statusBadge = isUserActive(user)
                ? `<span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-lg text-[11px] font-bold bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 uppercase tracking-tight"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>Ativo</span>`
                : `<span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-lg text-[11px] font-bold bg-[var(--text-soft)]/10 text-[var(--text-soft)] uppercase tracking-tight"><span class="w-1.5 h-1.5 rounded-full bg-[var(--text-soft)]"></span>Inativo</span>`;

            tr.innerHTML = `
                <td class="px-6 py-4 font-mono text-[var(--text-soft)] font-bold">#${user.id}</td>
                <td class="px-6 py-4 font-semibold text-[var(--text)]">${user.name || ''}</td>
                <td class="px-6 py-4 text-[var(--text-soft)] font-semibold">${user.email || ''}</td>
                <td class="px-6 py-4">
                    <span class="px-2 py-0.5 border border-[var(--border)] bg-[var(--surface-2)] rounded-lg text-[11px] font-bold text-[var(--text)] shadow-sm uppercase tracking-tight">${getUserRole(user)}</span>
                </td>
                <td class="px-6 py-4">${statusBadge}</td>
                <td class="px-6 py-4 text-right">
                    <a href="/ui/users/${user.id}/edit" class="inline-flex items-center justify-center px-3 py-1.5 bg-[var(--surface)] text-[11px] font-semibold text-[var(--text)] border border-[var(--border)] rounded-lg shadow-sm hover:bg-[var(--surface-2)] transition-all min-h-[28px]">Editar</a>
                </td>
            `;
            tbody.appendChild(tr);
        });

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
        tbody.innerHTML = `<tr><td colspan="6" class="px-6 py-12 text-center text-xs text-[var(--color-danger)] font-medium">⚠️ Não foi possível carregar os utilizadores.</td></tr>`;
    }
}

function init() {
    const btnSearch = document.getElementById('btnSearch');
    const btnClear = document.getElementById('btnClear');
    const usersSearch = document.getElementById('usersSearch');
    const pagination = document.getElementById('pagination');

    if (btnSearch) btnSearch.addEventListener('click', () => loadUsers(1));
    if (btnClear) btnClear.addEventListener('click', () => {
        document.getElementById('usersSearch').value = '';
        document.getElementById('usersRole').value = '';
        document.getElementById('usersStatus').value = '';
        loadUsers(1);
    });
    if (usersSearch) usersSearch.addEventListener('keydown', e => {
        if (e.key === 'Enter') loadUsers(1);
    });

    if (pagination) {
        pagination.addEventListener('click', (e) => {
            const btn = e.target.closest('button[data-page]');
            if (btn && !btn.disabled) {
                const page = parseInt(btn.dataset.page);
                loadUsers(page);
            }
        });
    }

    loadUsers(1);
}

export { init };
