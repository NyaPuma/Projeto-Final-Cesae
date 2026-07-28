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
    <div class="mb-6 rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm">
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

    {{-- Cabeçalho das Colunas da Lista --}}
    <div class="hidden sm:grid grid-cols-12 gap-4 px-6 py-2 mb-2 text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">
        <div class="col-span-1">{{ __('ID') }}</div>
        <div class="col-span-4">{{ __('Nome / Utilizador') }}</div>
        <div class="col-span-3">{{ __('Email') }}</div>
        <div class="col-span-2">{{ __('Perfil') }}</div>
        <div class="col-span-1">{{ __('Estado') }}</div>
        <div class="col-span-1 text-right">{{ __('Ações') }}</div>
    </div>

    {{-- Contentor de Cards Flutuantes (Bento Items) --}}
    <div id="usersListContainer" class="space-y-3" role="region" aria-live="polite" aria-label="{{ __('Lista de utilizadores') }}">
        <div class="p-12 text-center text-xs text-[var(--text-soft)] bg-[var(--surface)] border border-[var(--border)] rounded-2xl">
            <div class="flex items-center justify-center gap-2">
                <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                {{ __('A carregar listagem de utilizadores...') }}
            </div>
        </div>
    </div>

    {{-- Área de Paginação --}}
    <div id="pagination" class="mt-6 flex items-center justify-between text-xs text-[var(--text-soft)] px-1"></div>

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
    const token = localStorage.getItem('api_token');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const headers = { 'Accept': 'application/json' };

    if (token) headers['X-Auth-Token'] = token;
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

    const container = document.getElementById('usersListContainer');
    container.innerHTML = `<div class="p-12 text-center text-xs text-[var(--text-soft)] bg-[var(--surface)] border border-[var(--border)] rounded-2xl">${"{{ __('A atualizar dados...') }}"}</div>`;

    try {
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
        
        const users = data.users?.data ?? data.users ?? [];
        const meta = data.users ?? {};
        const total = meta.total ?? users.length;

        document.getElementById('resultsCount').textContent = total > 0 ? `${total} ${"{{ __('resultado(s) encontrado(s)') }}"}` : "{{ __('Sem resultados') }}";

        if (!users.length) {
            container.innerHTML = `<div class="p-12 text-center text-xs text-[var(--text-soft)] italic bg-[var(--surface)] border border-[var(--border)] rounded-2xl">${"{{ __('Nenhum utilizador encontrado com os filtros selecionados.') }}"}</div>`;
            document.getElementById('pagination').innerHTML = '';
            return;
        }

        container.innerHTML = '';
        users.forEach(user => {
            const card = document.createElement('div');
            
            // 💡 Efeito Bento Pop-out com Brilho Laranja e Animação 3D no Hover
            card.className = 'group relative grid grid-cols-1 sm:grid-cols-12 gap-4 items-center p-4 bg-[var(--surface)] hover:bg-[var(--surface-2)] border border-[var(--border)] hover:border-orange-500/40 rounded-2xl shadow-sm hover:shadow-[0_12px_30px_rgba(249,115,22,0.15)] transition-all duration-200 hover:-translate-y-1 hover:scale-[1.01] cursor-pointer';

            const statusBadge = isUserActive(user)
                ? `<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-xl text-[11px] font-bold bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 uppercase tracking-tight"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>${"{{ __('Ativo') }}"}</span>`
                : `<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-xl text-[11px] font-bold bg-[var(--text-soft)]/10 text-[var(--text-soft)] uppercase tracking-tight"><span class="w-1.5 h-1.5 rounded-full bg-[var(--text-soft)]"></span>${"{{ __('Inativo') }}"}</span>`;

            const fallbackAvatar = `https://ui-avatars.com/api/?name=${encodeURIComponent(user.name || 'User')}&background=f97316&color=ffffff&bold=true`;
            const avatarSrc = user.avatar_url || fallbackAvatar;

            card.innerHTML = `
                <div class="sm:col-span-1 font-mono text-xs text-[var(--text-soft)] font-bold">#${user.id}</div>
                <div class="sm:col-span-4 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-[var(--border)] group-hover:border-orange-500/50 bg-[var(--surface-2)] flex-shrink-0 shadow-sm transition-colors duration-200">
                        <img src="${avatarSrc}" 
                             alt="${user.name || ''}" 
                             class="w-full h-full object-cover" 
                             onerror="this.onerror=null; this.src='${fallbackAvatar}';">
                    </div>
                    <span class="font-bold text-xs text-[var(--text)] group-hover:text-primary transition-colors">${user.name || ''}</span>
                </div>
                <div class="sm:col-span-3 text-xs text-[var(--text-soft)] font-medium truncate">${user.email || ''}</div>
                <div class="sm:col-span-2">
                    <span class="px-2.5 py-1 border border-[var(--border)] bg-[var(--surface-2)] rounded-xl text-[11px] font-bold text-[var(--text)] uppercase tracking-tight shadow-sm">${getUserRole(user)}</span>
                </div>
                <div class="sm:col-span-1">${statusBadge}</div>
                <div class="sm:col-span-1 text-right">
                    <a href="/ui/users/${user.id}/edit" class="inline-flex items-center justify-center px-3 py-1.5 bg-[var(--surface-2)] group-hover:bg-primary group-hover:text-white text-[11px] font-bold text-[var(--text)] border border-[var(--border)] group-hover:border-primary rounded-xl shadow-sm transition-all duration-200 min-h-[30px]">${"{{ __('Editar') }}"}</a>
                </div>
            `;
            container.appendChild(card);
        });

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
        container.innerHTML = `<div class="p-12 text-center text-xs text-[var(--color-danger)] font-medium bg-[var(--surface)] border border-[var(--border)] rounded-2xl">⚠️ ${"{{ __('Não foi possível carregar os utilizadores.') }}"}</div>`;
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