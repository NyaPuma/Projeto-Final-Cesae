@extends('ui.layout')

@section('content')
<script>
window.requireAuthOnLoad = true;
</script>

@component('ui.partials.page-card', [
    'title' => __('Equipamentos'),
    'subtitle' => __('Inventário centralizado de equipamentos, localizações e estado operacional.'),
    'actions' => '<div class="flex flex-wrap gap-2"><a href="/ui" class="inline-flex items-center justify-center px-3.5 py-2 bg-[var(--surface)] text-xs font-semibold text-[var(--text)] border border-[var(--border)] rounded-xl shadow-sm hover:bg-[var(--surface-2)] transition-all"><svg class="w-3.5 h-3.5 mr-1.5 text-[var(--text-soft)]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path></svg> ' . __('Voltar ao painel') . '</a></div>'
])

    {{-- Painel de Pesquisa Avançada Bento-Style --}}
    <div class="mb-6 rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm animate-[fadeIn_0.2s_ease-out]">
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

            <div class="sm:col-span-2 lg:col-span-3 xl:col-span-4">
                <label for="filter_q" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Termo de Pesquisa') }}</label>
                <div class="relative">
                    <input id="filter_q" placeholder="{{ __('Pesquise por nome, categoria ou código...') }}"
                        class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] placeholder-[var(--text-soft)] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
                </div>
            </div>

            <div>
                <label for="filter_status" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Estado Operacional') }}</label>
                <select id="filter_status" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all">
                    <option value="">{{ __('Todos') }}</option>
                    <option value="active">{{ __('Operacional') }}</option>
                    <option value="inactive">{{ __('Fora de Serviço') }}</option>
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
    <div class="w-full overflow-hidden bg-[var(--surface)] border border-[var(--border)] rounded-2xl shadow-sm" role="region" aria-live="polite" aria-label="{{ __('Lista de equipamentos') }}">
        <div class="overflow-x-auto">
            <table id="equipmentTable" class="min-w-full divide-y divide-[var(--border)] text-left text-xs">
                <thead class="bg-[var(--surface-2)] text-[var(--text)] uppercase tracking-wider font-bold text-[10px]">
                    <tr>
                        <th class="px-5 py-4 font-bold">{{ __('Código') }}</th>
                        <th class="px-5 py-4 font-bold">{{ __('Equipamento') }}</th>
                        <th class="px-5 py-4 font-bold">{{ __('Localização') }}</th>
                        <th class="px-5 py-4 font-bold">{{ __('Estado') }}</th>
                        <th class="px-5 py-4 font-bold text-right">{{ __('Ações') }}</th>
                    </tr>
                </thead>
                <tbody id="equipmentTableBody" class="divide-y divide-[var(--border)] text-[var(--text)]">
                    <tr>
                        <td colspan="5" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]">
                            <div class="flex items-center justify-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                                {{ __('A carregar inventário de equipamentos...') }}
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

function authHeader(){
    const token = localStorage.getItem('api_token');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const headers = { 'Accept': 'application/json' };

    if (token) headers['X-Auth-Token'] = token;
    if (csrfToken) headers['X-CSRF-TOKEN'] = csrfToken;

    return headers;
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
    tbody.innerHTML = `<tr><td colspan="5" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]">${"{{ __('A atualizar dados...') }}"}</td></tr>`;

    try {
        const res = await fetch(`/equipments?${params.toString()}`, { headers: authHeader() });
        if (res.status === 401) { window.location = '/ui/login'; return; }
        if (!res.ok) { throw new Error('Falha ao carregar'); }
        const data = await res.json();
        
        const equipments = data.equipments?.data ?? [];
        const meta = data.equipments ?? {};
        const total = meta.total ?? equipments.length;

        document.getElementById('resultsCount').textContent = total > 0 ? `${total} ${"{{ __('resultado(s) encontrado(s)') }}"}` : "{{ __('Sem resultados') }}";

        if (!equipments.length) {
            tbody.innerHTML = `<tr><td colspan="5" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]"><div class="mx-auto max-w-sm rounded-2xl border border-dashed border-[var(--border)] bg-[var(--surface-2)] p-5">${"{{ __('Nenhum equipamento encontrado com os filtros aplicados.') }}"}</div></td></tr>`;
            document.getElementById('pagination').innerHTML = '';
            return;
        }

        tbody.innerHTML = equipments.map(eq => {
            const is_active = eq.active === true || eq.active === 1 || eq.active === '1';
            const statusBadge = is_active
                ? `<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[11px] font-bold bg-emerald-500/10 text-emerald-700 dark:text-emerald-400 uppercase tracking-tight">${"{{ __('Operacional') }}"}</span>`
                : `<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[11px] font-bold bg-red-500/10 text-red-700 dark:text-red-400 uppercase tracking-tight">${"{{ __('Fora de Serviço') }}"}</span>`;

            return `<tr class="hover:bg-[var(--surface-2)]/50 transition-colors duration-150">
                <td class="px-5 py-4 font-mono text-[var(--text-soft)] font-bold">${eq.serial ?? `EQ-${String(eq.id).padStart(3, '0')}`}</td>
                <td class="px-5 py-4">
                    <div class="font-semibold text-[var(--text)]">${eq.name}</div>
                    <div class="text-[10px] text-[var(--text-soft)] uppercase tracking-wider mt-0.5">${eq.category?.name ?? 'Genérico'}</div>
                </td>
                <td class="px-5 py-4 text-[var(--text-soft)] font-semibold">${eq.room ? `${eq.room.name} (${eq.room.location ?? '—'})` : '—'}</td>
                <td class="px-5 py-4">${statusBadge}</td>
                <td class="px-5 py-4 text-right">
                    <a href="/ui/tickets/create?equipment_id=${eq.id}" class="inline-flex items-center justify-center px-3 py-1.5 bg-[var(--surface)] text-[11px] font-semibold text-[var(--text)] border border-[var(--border)] rounded-lg shadow-sm hover:bg-[var(--surface-2)] transition-all min-h-[28px]">${"{{ __('Abrir Ticket') }}"}</a>
                </td>
            </tr>`;
        }).join('');

        // Renderização do Bloco de Paginação Estilizado
        const lastPage  = meta.last_page ?? 1;
        const currPage  = meta.current_page ?? page;
        const pagEl     = document.getElementById('pagination');
        if (lastPage <= 1) { pagEl.innerHTML = ''; return; }
        pagEl.innerHTML = `
            <button onclick="loadEquipments(${currPage - 1})" ${currPage <= 1 ? 'disabled' : ''}
                class="ui-button ui-button--primary inline-flex items-center justify-center px-3.5 py-2 text-xs font-bold text-[var(--on-primary)] rounded-xl shadow-sm hover:opacity-90 transition-all disabled:opacity-40 disabled:cursor-not-allowed min-h-[36px]">← ${"{{ __('Anterior') }}"}</button>
            <span class="font-bold text-[var(--text-soft)]">${"{{ __('Página') }}"} ${currPage} ${"{{ __('de') }}"} ${lastPage}</span>
            <button onclick="loadEquipments(${currPage + 1})" ${currPage >= lastPage ? 'disabled' : ''}
                class="ui-button ui-button--primary inline-flex items-center justify-center px-3.5 py-2 text-xs font-bold text-[var(--on-primary)] rounded-xl shadow-sm hover:opacity-90 transition-all disabled:opacity-40 disabled:cursor-not-allowed min-h-[36px]">${"{{ __('Próxima') }}"} →</button>
        `;
    } catch (error) {
        tbody.innerHTML = `<tr><td colspan="5" class="px-5 py-12 text-center text-xs text-[var(--color-danger)] font-medium">⚠️ ${"{{ __('Não foi possível carregar os equipamentos de momento.') }}"}</td></tr>`;
    }
}

document.getElementById('btnSearch').addEventListener('click', () => loadEquipments(1));

document.getElementById('btnClear').addEventListener('click', () => {
    document.getElementById('filter_q').value = '';
    document.getElementById('filter_status').value = '';
    loadEquipments(1);
});

document.getElementById('filter_q').addEventListener('keydown', e => {
    if (e.key === 'Enter') loadEquipments(1);
});

window.addEventListener('load', () => loadEquipments(1));
</script>
@endpush
