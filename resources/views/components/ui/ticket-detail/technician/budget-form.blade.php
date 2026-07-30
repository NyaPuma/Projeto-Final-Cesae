<div id="techBudgetSubmitCard" class="rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm space-y-3">
    <div class="flex items-center justify-between border-b border-[var(--border)] pb-2.5">
        <h3 class="text-xs font-bold uppercase tracking-wider text-[var(--text)]">{{ __('1. Avaliação Orçamental Detalhada') }}</h3>
        <x-ui.text.pill tone="neutral" size="xs" class="rounded-md px-2 py-0.5 font-mono">{{ __('Regra ACCEPT') }}</x-ui.text.pill>
    </div>

    <p class="text-xs text-[var(--text-soft)]">{{ __('Introduza o orçamento detalhado da reparação com os itens, quantidades e preços. Se o total exceder o limiar, o ticket aguardará autorização do Administrador.') }}</p>

    <form id="techBudgetForm" class="space-y-3 pt-1">
        <div class="space-y-2">
            <x-ui.text.eyebrow as="p" size="xs" tracking="wider" class="mb-1 font-bold">{{ __('Itens do Orçamento Detalhado') }}</x-ui.text.eyebrow>
            <div id="budgetItemsContainer" class="space-y-2"></div>
            <x-ui.buttons.button id="btnAddBudgetItem" variant="secondary" size="xs" weight="bold" class="border-dashed uppercase tracking-wider text-primary gap-1 hover:text-primary">
                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path></svg>
                {{ __('Adicionar Item') }}
            </x-ui.buttons.button>
        </div>

        <div class="flex items-center justify-between rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3">
            <x-ui.text.eyebrow as="span" size="xs" tracking="wider" class="font-bold">{{ __('Total Estimado') }}</x-ui.text.eyebrow>
            <span id="techTotalEstimatedDisplay" class="text-lg font-black text-[var(--text)] font-mono">0.00 €</span>
        </div>

        <x-ui.form.field id="techEstimatedCostInput" :label="__('Custo Estimado Global (€)')">
            <x-ui.form.input id="techEstimatedCostInput" name="estimated_cost" type="number" step="0.01" :placeholder="__('Ex: 75.00')" class="rounded-xl px-3 py-2 text-xs font-mono focus:border-[var(--text)]" />
        </x-ui.form.field>

        <x-ui.buttons.button id="btnSubmitEstimatedBudget" variant="primary" size="sm" weight="bold" class="w-full">
            {{ __('Submeter Orçamento Detalhado') }}
        </x-ui.buttons.button>
    </form>
</div>
