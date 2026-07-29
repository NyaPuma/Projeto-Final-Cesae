<div id="budgetApprovalCard" class="relative hidden overflow-hidden rounded-2xl border border-amber-500/30 bg-[var(--surface)] p-6 shadow-sm space-y-4">
    <div class="absolute left-0 top-0">
        <x-ui.text.pill tone="warning" size="xs" class="rounded-br-xl rounded-tl-none border-0 px-3 py-1 text-black shadow-sm">
            {{ __('Ação Requerida') }}
        </x-ui.text.pill>
    </div>

    <div class="pt-2">
        <h3 class="flex items-center gap-2 text-sm font-bold text-[var(--text)]"><span class="text-base">💰</span> {{ __('Decisão Orçamental (Administração)') }}</h3>
        <p class="mt-1 text-xs text-[var(--text-soft)]">{{ __('O custo estimado ultrapassa o limiar financeiro (*threshold*) de') }} <strong class="font-mono text-[var(--text)]" id="budgetThresholdDisplay">50.00 €</strong>.</p>
    </div>

    <div class="flex items-center justify-between rounded-xl border border-[var(--border)] bg-[var(--surface-2)] p-4">
        <div>
            <x-ui.text.eyebrow as="span" size="xs" tracking="wider" class="block font-bold">{{ __('Custo Solicitado') }}</x-ui.text.eyebrow>
            <p class="mt-0.5 text-xs text-[var(--text-soft)]">{{ __('Técnico:') }} <span id="budgetTechnicianName" class="font-semibold text-[var(--text)]">—</span></p>
        </div>
        <div class="text-right">
            <span id="budgetEstimatedCost" class="text-2xl font-black text-amber-500 font-mono dark:text-amber-400">0.00 €</span>
        </div>
    </div>

    <div id="budgetDetailsContainer" class="hidden rounded-xl border border-[var(--border)] bg-[var(--surface-2)] p-4 space-y-2">
        <h4 class="flex items-center gap-1.5">
            <svg class="h-3.5 w-3.5 text-[var(--text-soft)]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            <x-ui.text.eyebrow as="span" size="xs" tracking="wider" class="font-bold">{{ __('Detalhe do Orçamento') }}</x-ui.text.eyebrow>
        </h4>
        <div id="budgetDetailsList" class="space-y-1.5"></div>
        <div class="mt-1 flex items-center justify-between border-t border-[var(--border)] pt-2">
            <x-ui.text.eyebrow as="span" size="xs" tracking="wider" class="font-bold">{{ __('Total') }}</x-ui.text.eyebrow>
            <span id="budgetDetailsTotal" class="text-sm font-black text-[var(--text)] font-mono">0.00 €</span>
        </div>
    </div>

    <form id="budgetForm" class="space-y-3">
        <x-ui.form.field id="budgetFeedback" :label="__('Justificação / Feedback (Obrigatório em Recusa)')">
            <x-ui.form.textarea id="budgetFeedback" name="feedback" rows="2" :placeholder="__('Insira o parecer orçamental...')" class="rounded-xl px-3 py-2 text-xs placeholder-[var(--text-soft)] focus:border-[var(--text)]" />
        </x-ui.form.field>

        <div class="grid grid-cols-2 gap-3 pt-1">
            <x-ui.buttons.button id="btnApproveBudget" variant="success" size="sm" weight="bold" class="gap-1.5">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"></path></svg>
                {{ __('Aprovar Orçamento') }}
            </x-ui.buttons.button>
            <x-ui.buttons.button id="btnRejectBudget" variant="danger" size="sm" weight="bold" class="gap-1.5">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
                {{ __('Recusar Orçamento') }}
            </x-ui.buttons.button>
        </div>
    </form>
</div>
