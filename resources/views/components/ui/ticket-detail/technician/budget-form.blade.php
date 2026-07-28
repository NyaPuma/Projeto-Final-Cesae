<div id="techBudgetSubmitCard" class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm space-y-3">
    <div class="flex items-center justify-between border-b border-[var(--border)] pb-2.5">
        <h3 class="text-xs font-bold uppercase tracking-wider text-[var(--text)]">{{ __('1. Avaliação Orçamental Detalhada') }}</h3>
        <span class="rounded-md bg-[var(--surface-2)] px-2 py-0.5 font-mono text-[9px] font-bold text-[var(--text-soft)]">{{ __('Regra ACCEPT') }}</span>
    </div>

    <p class="text-xs text-[var(--text-soft)]">{{ __('Introduza o orçamento detalhado da reparação com os itens, quantidades e preços. Se o total exceder o limiar, o ticket aguardará autorização do Administrador.') }}</p>

    <form id="techBudgetForm" class="space-y-3 pt-1">
        <div class="space-y-2">
            <label class="mb-1 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Itens do Orçamento Detalhado') }}</label>
            <div id="budgetItemsContainer" class="space-y-2"></div>
            <button type="button" id="btnAddBudgetItem" class="inline-flex items-center gap-1 rounded-xl border border-dashed border-[var(--border)] px-2.5 py-1.5 text-[10px] font-bold uppercase tracking-wider text-primary transition-all hover:bg-[var(--surface-2)] cursor-pointer">
                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path></svg>
                {{ __('Adicionar Item') }}
            </button>
        </div>

        <div class="flex items-center justify-between rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3">
            <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Total Estimado') }}</span>
            <span id="techTotalEstimatedDisplay" class="text-lg font-black text-[var(--text)] font-mono">0.00 €</span>
        </div>

        <div>
            <label for="techEstimatedCostInput" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Custo Estimado Global (€)') }}</label>
            <input id="techEstimatedCostInput" type="number" step="0.01" placeholder="{{ __('Ex: 75.00') }}" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2 text-xs font-mono text-[var(--text)] outline-none transition-all focus:border-[var(--text)]">
        </div>

        <button type="button" id="btnSubmitEstimatedBudget" class="w-full inline-flex items-center justify-center rounded-xl bg-primary px-4 py-2.5 text-xs font-bold text-white shadow-sm transition-all hover:opacity-90 cursor-pointer">
            {{ __('Submeter Orçamento Detalhado') }}
        </button>
    </form>
</div>
