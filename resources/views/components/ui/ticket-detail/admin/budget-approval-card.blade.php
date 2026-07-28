<div id="budgetApprovalCard" class="relative hidden overflow-hidden rounded-2xl border border-amber-500/30 bg-[var(--surface)] p-6 shadow-sm space-y-4">
    <div class="absolute left-0 top-0">
        <span class="inline-block rounded-br-xl bg-amber-500 px-3 py-1 text-[9px] font-extrabold uppercase tracking-widest text-black shadow-sm">{{ __('Ação Requerida') }}</span>
    </div>

    <div class="pt-2">
        <h3 class="flex items-center gap-2 text-sm font-bold text-[var(--text)]"><span class="text-base">💰</span> {{ __('Decisão Orçamental (Administração)') }}</h3>
        <p class="mt-1 text-xs text-[var(--text-soft)]">{{ __('O custo estimado ultrapassa o limiar financeiro (*threshold*) de') }} <strong class="font-mono text-[var(--text)]" id="budgetThresholdDisplay">50.00 €</strong>.</p>
    </div>

    <div class="flex items-center justify-between rounded-xl border border-[var(--border)] bg-[var(--surface-2)] p-4">
        <div>
            <span class="block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Custo Solicitado') }}</span>
            <p class="mt-0.5 text-xs text-[var(--text-soft)]">{{ __('Técnico:') }} <span id="budgetTechnicianName" class="font-semibold text-[var(--text)]">—</span></p>
        </div>
        <div class="text-right">
            <span id="budgetEstimatedCost" class="text-2xl font-black text-amber-500 font-mono dark:text-amber-400">0.00 €</span>
        </div>
    </div>

    <div id="budgetDetailsContainer" class="hidden rounded-xl border border-[var(--border)] bg-[var(--surface-2)] p-4 space-y-2">
        <h4 class="flex items-center gap-1.5 text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">
            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            {{ __('Detalhe do Orçamento') }}
        </h4>
        <div id="budgetDetailsList" class="space-y-1.5"></div>
        <div class="mt-1 flex items-center justify-between border-t border-[var(--border)] pt-2">
            <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Total') }}</span>
            <span id="budgetDetailsTotal" class="text-sm font-black text-[var(--text)] font-mono">0.00 €</span>
        </div>
    </div>

    <form id="budgetForm" class="space-y-3">
        <div>
            <label for="budgetFeedback" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Justificação / Feedback (Obrigatório em Recusa)') }}</label>
            <textarea id="budgetFeedback" rows="2" class="w-full resize-none rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2 text-xs text-[var(--text)] placeholder-[var(--text-soft)] outline-none transition-all focus:border-[var(--text)]" placeholder="{{ __('Insira o parecer orçamental...') }}"></textarea>
        </div>

        <div class="grid grid-cols-2 gap-3 pt-1">
            <button type="button" id="btnApproveBudget" class="inline-flex items-center justify-center gap-1.5 rounded-xl bg-emerald-600 px-4 py-2.5 text-xs font-bold text-white shadow-sm transition-all hover:bg-emerald-500 cursor-pointer">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"></path></svg>
                {{ __('Aprovar Orçamento') }}
            </button>
            <button type="button" id="btnRejectBudget" class="inline-flex items-center justify-center gap-1.5 rounded-xl border border-rose-500/30 bg-rose-500/10 px-4 py-2.5 text-xs font-bold text-rose-500 shadow-sm transition-all hover:bg-rose-500/20 cursor-pointer">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
                {{ __('Recusar Orçamento') }}
            </button>
        </div>
    </form>
</div>
