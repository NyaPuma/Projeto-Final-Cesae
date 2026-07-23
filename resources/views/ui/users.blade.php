@extends('ui.layout')

@section('content')
<script>
window.requireAuthOnLoad = true;
</script>

@component('ui.partials.page-card', [
    'title' => __('Utilizadores'),
    'subtitle' => __('Consulte as contas dos utilizadores e os respetivos perfis de acesso ao sistema.'),
    'actions' => '<div class="flex flex-wrap gap-2"><a href="/ui" class="inline-flex items-center justify-center px-3.5 py-2 bg-[var(--surface)] text-xs font-semibold text-[var(--text)] border border-[var(--border)] rounded-xl shadow-sm hover:bg-[var(--surface-2)] transition-all"><svg class="w-3.5 h-3.5 mr-1.5 text-[var(--text-soft)]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path></svg> ' . __('Voltar ao painel') . '</a><a href="/ui/users/create" class="ui-button ui-button--primary inline-flex items-center justify-center px-3.5 py-2 text-xs font-bold text-[var(--on-primary)] rounded-xl shadow-sm hover:opacity-90 transition-all">+ ' . __('Criar Utilizador') . '</a></div>'
])

    {{-- Painel de Filtros Bento-Style --}}
    <div class="mb-6 rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm animate-[fadeIn_0.2s_ease-out]">
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

            <div class="sm:col-span-2 lg:col-span-3 xl:col-span-4">
                <label for="usersSearch" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Termo de Pesquisa') }}</label>
                <div class="relative">
                    <input id="usersSearch" placeholder="{{ __('Pesquise por nome, email...') }}"
                        class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] placeholder-[var(--text-soft)] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
                </div>
            </div>

            <div>
                <label for="usersRole" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Perfil') }}</label>
                <select id="usersRole" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
                    <option value="">{{ __('Todos') }}</option>
                </select>
            </div>

            <div>
                <label for="usersStatus" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Estado') }}</label>
                <select id="usersStatus" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
                    <option value="">{{ __('Todos') }}</option>
                    <option value="active">{{ __('Ativos') }}</option>
                    <option value="inactive">{{ __('Inativos') }}</option>
                </select>
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

    {{-- Tabela de Resultados Estruturada --}}
    <div class="w-full overflow-hidden bg-[var(--surface)] border border-[var(--border)] rounded-2xl shadow-sm" role="region" aria-live="polite" aria-label="{{ __('Lista de utilizadores') }}">
        <div class="overflow-x-auto">
            <table id="usersTable" class="min-w-full divide-y divide-[var(--border)] text-left text-xs">
                <thead class="bg-[var(--surface-2)] text-[var(--text-soft)] uppercase tracking-wider font-bold text-[10px]">
                    <tr>
                        <th class="px-6 py-4 font-bold">{{ __('ID') }}</th>
                        <th class="px-6 py-4 font-bold">{{ __('Nome') }}</th>
                        <th class="px-6 py-4 font-bold">{{ __('Email') }}</th>
                        <th class="px-6 py-4 font-bold">{{ __('Perfil') }}</th>
                        <th class="px-6 py-4 font-bold">{{ __('Estado') }}</th>
                        <th class="px-6 py-4 font-bold text-right">{{ __('Ações') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border)] text-[var(--text)]">
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-xs text-[var(--text-soft)]">
                            <div class="flex items-center justify-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                                {{ __('A carregar listagem de utilizadores...') }}
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Área de Paginação Alinhada --}}
    <div id="pagination" class="mt-5 flex items-center justify-between text-xs text-[var(--text-soft)] px-1"></div>

@endcomponent
@endsection

@push('scripts')
<script>
let currentPage = 1;

function isUserActive(user) {
    return user.active === true || user.active === 1 || user.active === '1' || String(user.active).toLowerCase() === 'true';
}

function getUserRole(user) {
    return user.profile?.name || user.role || user.profile || '';
}

function authHeader(){
    const token = localStorage.getItem('sanctum_token');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const headers = { 'Accept': 'application/json' };

    if (token) headers['Authorization'] = 'Bearer ' + token;
    if (csrfToken) headers['X-CSRF-TOKEN'] = csrfToken;

    return headers;
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
    tbody.innerHTML = `<tr><td colspan="6" class="px-6 py-12 text-center text-xs text-[var(--text-soft)]">${"{{ __('A atualizar dados...') }}"}</td></tr>`;

    try {
        // Obter perfis caso ainda não estejam preenchidos no select
        const profilesSelect = document.getElementById('usersRole');
        if (profilesSelect.options.length <= 1) {
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
        if (res.status === 401) { window.location = '/ui/login'; return; }
        if (!res.ok) { throw new Error('Erro ao carregar'); }
        const data = await res.json();
        
        // Tratar dados paginados
        const users = data.users?.data ?? data.users ?? [];
        const meta = data.users ?? {};
        const total = meta.total ?? users.length;

        document.getElementById('resultsCount').textContent = total > 0 ? `${total} ${"{{ __('resultado(s) encontrado(s)') }}"}` : "{{ __('Sem resultados') }}";

        if (!users.length) {
            tbody.innerHTML = `<tr><td colspan="6" class="px-6 py-12 text-center text-xs text-[var(--text-soft)] italic">${"{{ __('Nenhum utilizador encontrado com os filtros selecionados.') }}"}</td></tr>`;
            document.getElementById('pagination').innerHTML = '';
            return;
        }

        tbody.innerHTML = '';
        users.forEach(user => {
            const tr = document.createElement('tr');
            tr.className = 'hover:bg-[var(--surface-2)]/50 transition-colors duration-150';

            const statusBadge = isUserActive(user)
                ? `<span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-lg text-[11px] font-bold bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 uppercase tracking-tight"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>${"{{ __('Ativo') }}"}</span>`
                : `<span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-lg text-[11px] font-bold bg-[var(--text-soft)]/10 text-[var(--text-soft)] uppercase tracking-tight"><span class="w-1.5 h-1.5 rounded-full bg-[var(--text-soft)]"></span>${"{{ __('Inativo') }}"}</span>`;

            tr.innerHTML = `
                <td class="px-6 py-4 font-mono text-[var(--text-soft)] font-bold">#${user.id}</td>
                <td class="px-6 py-4 font-semibold text-[var(--text)]">${user.name || ''}</td>
                <td class="px-6 py-4 text-[var(--text-soft)] font-semibold">${user.email || ''}</td>
                <td class="px-6 py-4">
                    <span class="px-2 py-0.5 border border-[var(--border)] bg-[var(--surface-2)] rounded-lg text-[11px] font-bold text-[var(--text)] shadow-sm uppercase tracking-tight">${getUserRole(user)}</span>
                </td>
                <td class="px-6 py-4">${statusBadge}</td>
                <td class="px-6 py-4 text-right">
                    <a href="/ui/users/${user.id}/edit" class="inline-flex items-center justify-center px-3 py-1.5 bg-[var(--surface)] text-[11px] font-semibold text-[var(--text)] border border-[var(--border)] rounded-lg shadow-sm hover:bg-[var(--surface-2)] transition-all min-h-[28px]">${"{{ __('Editar') }}"}</a>
                </td>
            `;
            tbody.appendChild(tr);
        });

        // Renderização da Paginação
        const lastPage = meta.last_page ?? 1;
        const currPage = meta.current_page ?? page;
        const pagEl = document.getElementById('pagination');
        if (lastPage <= 1) { pagEl.innerHTML = ''; return; }
        pagEl.innerHTML = `
            <button onclick="loadUsers(${currPage - 1})" ${currPage <= 1 ? 'disabled' : ''}
                class="ui-button ui-button--primary inline-flex items-center justify-center px-3.5 py-2 text-xs font-bold text-[var(--on-primary)] rounded-xl shadow-sm hover:opacity-90 transition-all disabled:opacity-40 disabled:cursor-not-allowed min-h-[36px]">← ${"{{ __('Anterior') }}"}</button>
            <span class="font-bold text-[var(--text-soft)]">${"{{ __('Página') }}"} ${currPage} ${"{{ __('de') }}"} ${lastPage}</span>
            <button onclick="loadUsers(${currPage + 1})" ${currPage >= lastPage ? 'disabled' : ''}
                class="ui-button ui-button--primary inline-flex items-center justify-center px-3.5 py-2 text-xs font-bold text-[var(--on-primary)] rounded-xl shadow-sm hover:opacity-90 transition-all disabled:opacity-40 disabled:cursor-not-allowed min-h-[36px]">${"{{ __('Próxima') }}"} →</button>
        `;
    } catch (error) {
        tbody.innerHTML = `<tr><td colspan="6" class="px-6 py-12 text-center text-xs text-[var(--color-danger)] font-medium">⚠️ ${"{{ __('Não foi possível carregar os utilizadores.') }}"}</td></tr>`;
    }
}

document.getElementById('btnSearch').addEventListener('click', () => loadUsers(1));

document.getElementById('btnClear').addEventListener('click', () => {
    document.getElementById('usersSearch').value = '';
    document.getElementById('usersRole').value = '';
    document.getElementById('usersStatus').value = '';
    loadUsers(1);
});

document.getElementById('usersSearch').addEventListener('keydown', e => {
    if (e.key === 'Enter') loadUsers(1);
});

window.addEventListener('load', () => loadUsers(1));
</script>
@endpush
