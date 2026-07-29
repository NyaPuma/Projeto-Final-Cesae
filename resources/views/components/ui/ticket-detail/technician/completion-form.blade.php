<div id="techCompletionCard" class="rounded-2xl border border-emerald-500/20 bg-[var(--surface)] p-6 shadow-sm space-y-5">
    <div class="flex items-center justify-between border-b border-[var(--border)] pb-3">
        <div class="space-y-1">
            <x-ui.text.pill tone="success" size="xs" class="rounded-md px-2.5 py-0.5 font-extrabold">{{ __('Autonomia / Autorizado') }}</x-ui.text.pill>
            <h3 class="flex items-center gap-2 pt-1 text-sm font-bold text-[var(--text)]">
                <svg class="h-4 w-4 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.428 15.428a2 2 0 002.143-.231l5.531-5.531a2 2 0 000-2.828l-1.257-1.257a2 2 0 00-2.828 0l-5.531 5.531a2 2 0 00-.231 2.143L3 21l3.571-3.571z"></path></svg>
                {{ __('Concluir Intervenção') }}
            </h3>
            <p class="text-xs text-[var(--text-soft)]">{{ __('Registe os custos finais e o relatório técnico para fechar o ticket.') }}</p>
        </div>
    </div>

    <form id="techCompletionForm" class="space-y-4">
        <x-ui.form.field id="techTotalCost" :label="__('Custo Final Executado (€)')" class="space-y-2 rounded-xl border border-[var(--border)] bg-[var(--surface-2)] p-4">
            <x-ui.form.input id="techTotalCost" name="total_cost" type="number" step="0.01" placeholder="0.00" class="rounded-xl bg-[var(--surface)] px-3 py-2 text-lg font-mono font-extrabold text-emerald-500 focus:border-emerald-500" />
        </x-ui.form.field>

        <x-ui.form.field id="techFinalReport" :label="__('Relatório Técnico Final')">
            <x-ui.form.textarea id="techFinalReport" name="final_report" rows="3" :placeholder="__('Descreva o trabalho efetuado e peças substituídas...')" class="rounded-xl px-3 py-2 text-xs placeholder-[var(--text-soft)] focus:border-[var(--text)]" />
        </x-ui.form.field>

        <x-ui.buttons.button id="btnFinishTicket" variant="success" size="md" weight="bold" class="w-full gap-2 uppercase tracking-wider">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"></path></svg>
            {{ __('Finalizar e Fechar Ticket') }}
        </x-ui.buttons.button>
    </form>
</div>
