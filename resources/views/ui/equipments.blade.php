@extends('ui.layout')

@section('content')

<script>
window.requireAuthOnLoad = true;
</script>

@component('ui.partials.page-card', [
    'title' => 'Equipamentos',
    'subtitle' => 'Inventário centralizado de equipamentos, respetivas localizações e estado operacional.'
])

<div class="space-y-10">

    {{-- SECÇÃO DE FILTROS E PESQUISA --}}
    <section>
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-lg font-bold tracking-tight">Pesquisa</h2>
                <p class="text-sm text-soft mt-1">Filtre equipamentos por nome, localização ou estado atual.</p>
            </div>
            <span id="equipmentCount" class="badge badge-warning">0 equipamentos</span>
        </div>

        <div class="card p-6">
            <div class="grid gap-6 lg:grid-cols-4">
                <div class="lg:col-span-3">
                    <label for="equipmentSearch" class="block text-sm font-semibold mb-2">Pesquisa Geral</label>
                    <input
                        id="equipmentSearch"
                        type="text"
                        placeholder="Pesquise por nome, localização ou código do ativo..."
                        class="input w-full"
                    >
                </div>
                <div>
                    <label for="equipmentStatus" class="block text-sm font-semibold mb-2">Estado Operacional</label>
                    <select id="equipmentStatus" class="input w-full">
                        <option value="">Todos os estados</option>
                        <option value="active">Operacionais</option>
                        <option value="inactive">Fora de serviço</option>
                    </select>
                </div>
            </div>
        </div>
    </section>

    {{-- SECÇÃO DA TABELA DE EQUIPAMENTOS --}}
    <section>
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-lg font-bold tracking-tight">Inventário</h2>
                <p class="text-sm text-soft mt-1">Lista detalhada de ativos e as suas localizações físicas.</p>
            </div>
            <span class="badge badge-success">Live</span>
        </div>

        <div class="card overflow-hidden p-0">
            <div class="overflow-x-auto">
                <table id="equipmentTable" class="w-full min-w-[800px]">
                    <thead>
                        <tr class="border-b border-[var(--border)] bg-[var(--surface-2)]">
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-[0.12em]">Código</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-[0.12em]">Equipamento</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-[0.12em]">Localização</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-[0.12em]">Estado</th>
                            <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-[0.12em]">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[var(--border)]" id="equipmentTableBody">
                        <tr>
                            <td colspan="5" class="py-24 text-center">
                                <div class="flex flex-col items-center justify-center gap-4">
                                    <svg class="h-6 w-6 animate-spin text-[var(--color-primary)]" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-20" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"></circle>
                                        <path class="opacity-90" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.37 0 0 5.37 0 12h4z"></path>
                                    </svg>
                                    <p class="text-sm font-medium">A carregar inventário...</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

</div>

@endcomponent
@endsection

@push('scripts')
<script>
let initialEquipments = [];

document.addEventListener('DOMContentLoaded', () => {
    loadEquipments();
    setupFilters();
});

async function loadEquipments() {
    const tbody = document.getElementById('equipmentTableBody');
    try {
        const response = await window.api.get('/api/equipments');
        initialEquipments = response.data || [];
        renderTable(initialEquipments);
    } catch (error) {
        console.error('Erro:', error);
        tbody.innerHTML = `<tr><td colspan="5" class="py-16 text-center text-[var(--color-danger)]">Erro ao carregar equipamentos.</td></tr>`;
    }
}

function renderTable(equipments) {
    const tbody = document.getElementById('equipmentTableBody');
    const countBadge = document.getElementById('equipmentCount');

    countBadge.textContent = `${equipments.length} equipamentos`;

    if (equipments.length === 0) {
        tbody.innerHTML = `<tr><td colspan="5" class="py-16 text-center text-soft">Nenhum registo encontrado.</td></tr>`;
        return;
    }

    tbody.innerHTML = equipments.map(eq => `
        <tr class="transition duration-150 hover:bg-[var(--surface-2)]">
            <td class="px-6 py-4 font-mono text-xs font-semibold">${eq.code ?? `EQ-${String(eq.id).padStart(3, '0')}`}</td>
            <td class="px-6 py-4">
                <div class="font-medium text-sm">${eq.name}</div>
                <div class="text-xs text-soft">${eq.category ?? 'Genérico'}</div>
            </td>
            <td class="px-6 py-4 text-sm text-soft">${eq.room ? `${eq.room.name} (${eq.room.building ?? 'Pavilhão A'})` : 'Não Alocado'}</td>
            <td class="px-6 py-4">
                ${eq.status === 'active' ? '<span class="badge badge-success">Operacional</span>' : '<span class="badge badge-danger">Fora de Serviço</span>'}
            </td>
            <td class="px-6 py-4 text-right">
                <a href="/ui/tickets/create?equipment_id=${eq.id}" class="btn btn-sm btn-outline">Abrir Ticket</a>
            </td>
        </tr>
    `).join('');
}

function setupFilters() {
    const searchInput = document.getElementById('equipmentSearch');
    const statusSelect = document.getElementById('equipmentStatus');

    const filter = () => {
        const q = searchInput.value.toLowerCase();
        const s = statusSelect.value;
        const filtered = initialEquipments.filter(eq => {
            const matchQ = eq.name.toLowerCase().includes(q) || (eq.code ?? '').toLowerCase().includes(q);
            const matchS = !s || eq.status === s;
            return matchQ && matchS;
        });
        renderTable(filtered);
    };

    searchInput.addEventListener('input', filter);
    statusSelect.addEventListener('change', filter);
}
</script>
@endpush
