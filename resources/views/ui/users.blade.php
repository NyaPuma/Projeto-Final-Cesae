@extends('ui.layout')

@section('content')
<script>
// Marcar que esta página requer autenticação
window.requireAuthOnLoad = true;
</script>

@component('ui.partials.page-card', [
    'title' => 'Utilizadores',
    'subtitle' => 'Consulte as contas dos utilizadores e os respetivos perfis de acesso ao sistema.'
])

    {{-- Painel de Filtros Bento-Style --}}
    <div class="mb-6 grid gap-4 sm:grid-cols-3 p-5 bg-[var(--surface)] border border-[var(--border)] rounded-2xl shadow-sm animate-[fadeIn_0.2s_ease-out]">
        <div>
            <label for="usersSearch" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">Pesquisa</label>
            <input id="usersSearch" type="text" placeholder="Nome, email ou perfil..." class="w-full text-xs rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2 text-[var(--text)] placeholder-[var(--text-soft)] outline-none focus:border-[var(--text)] transition-all">
        </div>
        <div>
            <label for="usersRole" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">Perfil</label>
            <select id="usersRole" class="w-full text-xs rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2 text-[var(--text)] outline-none focus:border-[var(--text)] transition-all">
                <option value="">Todos</option>
            </select>
        </div>
        <div>
            <label for="usersStatus" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">Estado</label>
            <select id="usersStatus" class="w-full text-xs rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2 text-[var(--text)] outline-none focus:border-[var(--text)] transition-all">
                <option value="">Todos</option>
                <option value="active">Ativos</option>
                <option value="inactive">Inativos</option>
            </select>
        </div>
    </div>

    {{-- Tabela de Resultados Estruturada --}}
    <div class="w-full overflow-hidden bg-[var(--surface)] border border-[var(--border)] rounded-2xl shadow-sm">
        <div class="overflow-x-auto">
            <table id="usersTable" class="min-w-full divide-y divide-[var(--border)] text-left text-xs">
                <thead class="bg-[var(--surface-2)] text-[var(--text-soft)] uppercase tracking-wider font-bold text-[10px]">
                    <tr>
                        <th class="px-6 py-3.5 font-bold">ID</th>
                        <th class="px-6 py-3.5 font-bold">Nome</th>
                        <th class="px-6 py-3.5 font-bold">Email</th>
                        <th class="px-6 py-3.5 font-bold">Perfil</th>
                        <th class="px-6 py-3.5 font-bold">Estado</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border)] text-[var(--text)]">
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-xs text-[var(--text-soft)]">
                            <div class="flex items-center justify-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                                A carregar listagem de utilizadores...
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@endcomponent
@endsection

@push('scripts')
<script>
let allUsers = [];

function isUserActive(user) {
    return user.active === true || user.active === 1 || user.active === '1' || String(user.active).toLowerCase() === 'true';
}

function getUserRole(user) {
    return user.role || user.profile || '';
}

function authHeader(){
    const token = localStorage.getItem('api_token');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const headers = { 'Accept': 'application/json' };

    if (token) headers['X-Auth-Token'] = token;
    if (csrfToken) headers['X-CSRF-TOKEN'] = csrfToken;

    return headers;
}

function renderUsers() {
    const searchValue = document.getElementById('usersSearch').value.toLowerCase();
    const roleValue = document.getElementById('usersRole').value;
    const statusValue = document.getElementById('usersStatus').value;
    const tbody = document.querySelector('#usersTable tbody');
    tbody.innerHTML = '';

    const filtered = allUsers.filter((user) => {
        const haystack = `${user.id} ${user.name || ''} ${user.email || ''} ${getUserRole(user)}`.toLowerCase();
        const matchesSearch = !searchValue || haystack.includes(searchValue);
        const matchesRole = !roleValue || getUserRole(user).toLowerCase() === roleValue.toLowerCase();
        const matchesStatus = !statusValue || (statusValue === 'active' && isUserActive(user)) || (statusValue === 'inactive' && !isUserActive(user));
        return matchesSearch && matchesRole && matchesStatus;
    });

    if (!filtered.length) {
        tbody.innerHTML = '<tr><td colspan="5" class="px-6 py-12 text-center text-xs text-[var(--text-soft)] italic">Nenhum utilizador encontrado com os filtros selecionados.</td></tr>';
        return;
    }

    for (const user of filtered) {
        const tr = document.createElement('tr');
        tr.className = 'hover:bg-[var(--surface-2)]/50 transition-colors duration-150';

        // Customização de badge estilizado para o Estado (Ativo/Inativo)
        const statusBadge = isUserActive(user)
            ? `<span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-lg text-[11px] font-bold bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 uppercase tracking-tight"><span class="w-1 h-1 rounded-full bg-emerald-500"></span>Ativo</span>`
            : `<span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-lg text-[11px] font-bold bg-[var(--text-soft)]/10 text-[var(--text-soft)] uppercase tracking-tight"><span class="w-1 h-1 rounded-full bg-[var(--text-soft)]"></span>Inativo</span>`;

        tr.innerHTML = `
            <td class="px-6 py-3.5 font-mono text-[var(--text-soft)] font-bold">#${user.id}</td>
            <td class="px-6 py-3.5 font-semibold text-[var(--text)]">${user.name || ''}</td>
            <td class="px-6 py-3.5 text-[var(--text-soft)] font-semibold">${user.email || ''}</td>
            <td class="px-6 py-3.5">
                <span class="px-2 py-0.5 border border-[var(--border)] bg-[var(--surface-2)] rounded-lg text-[11px] font-bold text-[var(--text)] shadow-sm uppercase tracking-tight">${getUserRole(user)}</span>
            </td>
            <td class="px-6 py-3.5">${statusBadge}</td>
        `;
        tbody.appendChild(tr);
    }
}

async function loadUsers(){
    const res = await fetch('/admin/users', {headers: authHeader()});
    if(res.status===401){ alert('Autenticação necessária.'); window.location='/ui/login'; return; }
    const data = await res.json();
    allUsers = data.users || [];

    const roleSelect = document.getElementById('usersRole');
    const roles = [...new Set(allUsers.map((user) => getUserRole(user)).filter(Boolean))].sort();
    roleSelect.innerHTML = '<option value="">Todos</option>' + roles.map((role) => `<option value="${role}">${role}</option>`).join('');

    renderUsers();
}

window.addEventListener('load', () => {
    document.getElementById('usersSearch').addEventListener('input', renderUsers);
    document.getElementById('usersRole').addEventListener('change', renderUsers);
    document.getElementById('usersStatus').addEventListener('change', renderUsers);
    loadUsers();
});
</script>
@endpush
