@extends('ui.layout')

@section('content')
<script>
window.requireAuthOnLoad = true;
</script>

@component('ui.partials.page-card', [
    'title' => __('Gestão de Orçamentos'),
    'subtitle' => __('Controlo financeiro de intervenções, aprovações e análise de despesas.'),
    'actions' => '<div class="flex flex-wrap gap-2">
        <button onclick="exportBudgetsCsv()" class="inline-flex items-center justify-center px-3.5 py-2 bg-[var(--surface)] text-xs font-semibold text-[var(--text)] border border-[var(--border)] rounded-xl shadow-sm hover:bg-[var(--surface-2)] transition-all">
            📥 ' . __('Exportar CSV') . '
        </button>
    </div>'
])

<div class="space-y-6">
    {{-- Cartões de Totais Financeiros --}}
    <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-4">
        <article class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-soft">{{ __('Total Geral') }}</p>
            <h3 id="totalAll" class="mt-3 text-3xl font-black">0,00 €</h3>
        </article>
        <article class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-soft">{{ __('Pendentes') }}</p>
            <h3 id="totalPending" class="mt-3 text-3xl font-black text-amber-500">0,00 €</h3>
        </article>
        <article class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-soft">{{ __('Aprovados') }}</p>
            <h3 id="totalApproved" class="mt-3 text-3xl font-black text-emerald-500">0,00 €</h3>
        </article>
        <article class="rounded-3xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wider text-soft">{{ __('Não Aprovados') }}</p>
            <h3 id="totalRejected" class="mt-3 text-3xl font-black text-rose-500">0,00 €</h3>
        </article>
    </div>

    {{-- Filtros de Estado --}}
    <div class="flex flex-wrap gap-2 border-b border-[var(--border)] pb-4">
        <button onclick="filterStatus('')" class="filter-btn px-4 py-2 text-xs font-bold rounded-xl bg-primary text-[var(--on-primary)] transition-all" data-status="">{{ __('Todos') }}</button>
        <button onclick="filterStatus('pending')" class="filter-btn px-4 py-2 text-xs font-semibold rounded-xl bg-[var(--surface-2)] text-[var(--text)] hover:bg-[var(--surface)] border border-[var(--border)] transition-all" data-status="pending">{{ __('Pendentes') }}</button>
        <button onclick="filterStatus('approved')" class="filter-btn px-4 py-2 text-xs font-semibold rounded-xl bg-[var(--surface-2)] text-[var(--text)] hover:bg-[var(--surface)] border border-[var(--border)] transition-all" data-status="approved">{{ __('Aprovados') }}</button>
        <button onclick="filterStatus('rejected')" class="filter-btn px-4 py-2 text-xs font-semibold rounded-xl bg-[var(--surface-2)] text-[var(--text)] hover:bg-[var(--surface)] border border-[var(--border)] transition-all" data-status="rejected">{{ __('Não Aprovados') }}</button>
    </div>

    {{-- Tabela de Orçamentos --}}
    <div class="w-full overflow-hidden bg-[var(--surface)] border border-[var(--border)] rounded-2xl shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-[var(--border)] text-left text-xs">
                <thead class="bg-[var(--surface-2)] text-[var(--text-soft)] uppercase tracking-wider font-bold text-[10px]">
                    <tr>
                        <th class="px-5 py-4">{{ __('ID Ticket') }}</th>
                        <th class="px-5 py-4">{{ __('Título / Equipamento') }}</th>
                        <th class="px-5 py-4">{{ __('Técnico Responsável') }}</th>
                        <th class="px-5 py-4">{{ __('Valor Orçado') }}</th>
                        <th class="px-5 py-4">{{ __('Estado Orçamento') }}</th>
                        <th class="px-5 py-4 text-right">{{ __('Ações') }}</th>
                    </tr>
                </thead>
                <tbody id="budgetsBody" class="divide-y divide-[var(--border)] text-[var(--text)]">
                    <tr>
                        <td colspan="6" class="px-5 py-12 text-center text-xs text-soft">
                            {{ __('A carregar orçamentos...') }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endcomponent
@endsection

@push('scripts')
<script>
let currentStatusFilter = '';
let cachedBudgets = [];

async function loadBudgets() {
    try {
        const url = currentStatusFilter ? `/admin/budgets/data?status=${currentStatusFilter}` : '/admin/budgets/data';
        const res = await fetch(url, { headers: authHeader() });
        if (!res.ok) throw new Error('Erro ao obter orçamentos');
        
        const data = await res.json();
        cachedBudgets = data.tickets || [];

        document.getElementById('totalAll').innerText = formatCurrency(data.totals.all);
        document.getElementById('totalPending').innerText = formatCurrency(data.totals.pending);
        document.getElementById('totalApproved').innerText = formatCurrency(data.totals.approved);
        document.getElementById('totalRejected').innerText = formatCurrency(data.totals.rejected);

        const tbody = document.getElementById('budgetsBody');
        if (!cachedBudgets.length) {
            tbody.innerHTML = `<tr><td colspan="6" class="px-5 py-12 text-center text-xs text-soft italic">${__( 'Nenhum orçamento encontrado.' )}</td></tr>`;
            return;
        }

        tbody.innerHTML = cachedBudgets.map(t => {
            let badge = '';
            const status = t.budget_status;
            if (status === 'approved') badge = `<span class="px-2.5 py-1 rounded-lg text-[10px] font-bold bg-emerald-500/10 text-emerald-600 uppercase">${__( 'Aprovado' )}</span>`;
            else if (status === 'rejected') badge = `<span class="px-2.5 py-1 rounded-lg text-[10px] font-bold bg-rose-500/10 text-rose-600 uppercase">${__( 'Não Aprovado' )}</span>`;
            else badge = `<span class="px-2.5 py-1 rounded-lg text-[10px] font-bold bg-amber-500/10 text-amber-600 uppercase">${__( 'Pendente' )}</span>`;

            return `
                <tr class="hover:bg-[var(--surface-2)]/50 transition-colors">
                    <td class="px-5 py-4 font-mono font-bold">#${t.id}</td>
                    <td class="px-5 py-4 font-semibold">
                        <div>${t.title}</div>
                        <div class="text-[10px] text-soft">${t.equipment?.name || __( 'Sem equipamento' )}</div>
                    </td>
                    <td class="px-5 py-4 text-soft">${t.technician?.name || __( 'Não atribuído' )}</td>
                    <td class="px-5 py-4 font-black">${formatCurrency(t.budget_amount)}</td>
                    <td class="px-5 py-4">${badge}</td>
                    <td class="px-5 py-4 text-right space-x-2">
                        <a href="/ui/tickets/${t.id}" class="px-3 py-1.5 bg-[var(--surface-2)] hover:bg-[var(--border)] text-xs font-bold rounded-lg border border-[var(--border)]">${__( 'Ver' )}</a>
                    </td>
                </tr>
            `;
        }).join('');

    } catch (e) {
        console.error(e);
    }
}

function filterStatus(status) {
    currentStatusFilter = status;
    document.querySelectorAll('.filter-btn').forEach(btn => {
        if (btn.getAttribute('data-status') === status) {
            btn.className = 'filter-btn px-4 py-2 text-xs font-bold rounded-xl bg-primary text-[var(--on-primary)] transition-all';
        } else {
            btn.className = 'filter-btn px-4 py-2 text-xs font-semibold rounded-xl bg-[var(--surface-2)] text-[var(--text)] hover:bg-[var(--surface)] border border-[var(--border)] transition-all';
        }
    });
    loadBudgets();
}

function formatCurrency(val) {
    const locale = window.currentLocale === 'en' ? 'en-US' : 'pt-PT';
    return new Intl.NumberFormat(locale, { style: 'currency', currency: 'EUR' }).format(val || 0);
}

function exportBudgetsCsv() {
    if (!cachedBudgets.length) return alert(__( 'Sem dados para exportar.' ));
    let csv = 'ID;Titulo;Equipamento;Tecnico;ValorOrcado;Estado\n';
    cachedBudgets.forEach(t => {
        csv += `${t.id};"${t.title}";"${t.equipment?.name || ''}";"${t.technician?.name || ''}";${t.budget_amount};${t.budget_status}\n`;
    });
    const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'orcamentos_report.csv';
    a.click();
}

document.addEventListener('DOMContentLoaded', loadBudgets);
</script>
@endpush