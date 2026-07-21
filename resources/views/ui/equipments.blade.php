@extends('ui.layout')

@section('content')
<script>
window.requireAuthOnLoad = true;
</script>

@component('ui.partials.page-card', [
    'title' => __('Equipamentos'),
    'subtitle' => __('Inventário centralizado de equipamentos, localizações e estado operacional.'),
    'actions' => '<div class="flex flex-wrap items-center gap-2">'
        . '<a href="/ui" class="inline-flex items-center justify-center px-3.5 py-2 bg-[var(--surface)] text-xs font-semibold text-[var(--text)] border border-[var(--border)] rounded-xl shadow-sm hover:bg-[var(--surface-2)] transition-all">'
            . '<svg class="w-3.5 h-3.5 mr-1.5 text-[var(--text-soft)]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path></svg> ' . __('Voltar ao painel')
        . '</a>'
        . '<button id="btnAddEquipment" onclick="openNewEquipmentModal()" class="hidden items-center gap-1.5 px-4 py-2 text-xs font-bold text-white bg-orange-500 hover:bg-orange-600 rounded-xl shadow-sm transition-all cursor-pointer">'
            . '+ ' . __('Novo equipamento')
        . '</button>'
        . '</div>'
])

    {{-- Painel de Pesquisa Avançada --}}
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

    {{-- Tabela de Resultados --}}
    <div class="w-full overflow-hidden bg-[var(--surface)] border border-[var(--border)] rounded-2xl shadow-sm" role="region" aria-live="polite" aria-label="{{ __('Lista de equipamentos') }}">
        <div class="overflow-x-auto">
            <table id="equipmentTable" class="min-w-full divide-y divide-[var(--border)] text-left text-xs">
                <thead class="bg-[var(--surface-2)] text-[var(--text)] uppercase tracking-wider font-bold text-[10px]">
                    <tr>
                        <th class="px-5 py-4 font-bold">{{ __('Código / Nº Série') }}</th>
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

    {{-- Paginação --}}
    <div id="pagination" class="mt-5 flex items-center justify-between text-xs text-[var(--text-soft)] px-1"></div>

@endcomponent

{{-- Modal para Adicionar / Editar Equipamento --}}
<div id="equipmentModal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/60 backdrop-blur-sm p-4 overflow-y-auto">
    <div class="relative w-full max-w-lg rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-2xl transition-all my-auto">
        <h3 class="text-base font-bold text-[var(--text)] mb-4" id="equipmentModalTitle">{{ __('Adicionar Equipamento') }}</h3>

        <form id="equipmentForm" onsubmit="saveEquipment(event)" class="space-y-4">
            <input type="hidden" id="equipmentId" name="id">

            <div>
                <label for="eqName" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Nome do Equipamento') }}</label>
                <input id="eqName" name="name" type="text" required placeholder="Ex: Projetor Epson EB-2250U"
                    class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="eqSerial" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Número de Série / Código') }}</label>
                    <input id="eqSerial" name="serial" type="text" placeholder="Ex: SN-987654"
                        class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all">
                </div>

                <div>
                    <label for="eqStatus" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Estado Operacional') }}</label>
                    <select id="eqStatus" name="active" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all">
                        <option value="1">{{ __('Operacional') }}</option>
                        <option value="0">{{ __('Fora de Serviço') }}</option>
                    </select>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-2 pt-4 border-t border-[var(--border)]">
                <button type="button" onclick="closeModal('equipmentModal')" class="px-4 py-2 text-xs font-semibold text-[var(--text)] bg-[var(--surface-2)] border border-[var(--border)] rounded-xl hover:bg-[var(--border)] transition-all cursor-pointer">
                    {{ __('Cancelar') }}
                </button>
                <button type="submit" class="px-4 py-2 text-xs font-bold text-white bg-orange-500 hover:bg-orange-600 rounded-xl shadow-sm transition-all cursor-pointer">
                    {{ __('Guardar Equipamento') }}
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
    const token = localStorage.getItem('api_token');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const headers = { 'Accept': 'application/json' };

    if (token) headers['X-Auth-Token'] = token;
    if (csrfToken) headers['X-CSRF-TOKEN'] = csrfToken;

    return headers;
}

// Mostra o botão + Novo Equipamento se o utilizador for administrador
function showAddButton() {
    const btn = document.getElementById('btnAddEquipment');
    if (btn) {
        btn.classList.remove('hidden');
        btn.classList.add('inline-flex');
    }
}

async function verifyAdminRole() {
    // 1. Tentar ler do localStorage para dar resposta imediata
    const storedUser = localStorage.getItem('user');
    if (storedUser) {
        try {
            const u = JSON.parse(storedUser);
            if (u.is_admin || u.role === 'admin' || u.type === 'admin') {
                showAddButton();
            }
        } catch(e){}
    }

    // 2. Verificar via API para confirmar permissões atualizadas
    try {
        const res = await fetch('/api/me', { headers: authHeader() });
        if (res.ok) {
            const data = await res.json();
            const user = data.user || data;
            if (user.is_admin || user.role === 'admin' || user.type === 'admin') {
                showAddButton();
            }
        }
    } catch(e) {}
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

function openNewEquipmentModal() {
    const form = document.getElementById('equipmentForm');
    if (form) form.reset();
    document.getElementById('equipmentId').value = '';
    document.getElementById('equipmentModalTitle').textContent = "{{ __('Adicionar Equipamento') }}";

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
            headers: Object.assign({'Content-Type': 'application/json'}, authHeader()),
            body: JSON.stringify(Object.fromEntries(formData))
        });

        if (res.ok) {
            closeModal('equipmentModal');
            loadEquipments(currentPage);
        } else {
            alert("{{ __('Ocorreu um erro ao guardar o equipamento.') }}");
        }
    } catch (err) {
        alert("{{ __('Erro ao comunicar com o servidor.') }}");
    }
}

document.getElementById('btnSearch')?.addEventListener('click', () => loadEquipments(1));

document.getElementById('btnClear')?.addEventListener('click', () => {
    document.getElementById('filter_q').value = '';
    document.getElementById('filter_status').value = '';
    loadEquipments(1);
});

document.getElementById('filter_q')?.addEventListener('keydown', e => {
    if (e.key === 'Enter') loadEquipments(1);
});

window.addEventListener('load', () => {
    verifyAdminRole();
    loadEquipments(1);
});
</script>
@endpush
