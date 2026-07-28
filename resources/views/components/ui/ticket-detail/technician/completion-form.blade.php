<div id="techCompletionCard" class="rounded-2xl border border-emerald-500/20 bg-[var(--surface)] p-6 shadow-sm space-y-5">
    <div class="flex items-center justify-between border-b border-[var(--border)] pb-3">
        <div class="space-y-1">
            <span class="inline-block rounded-md border border-emerald-500/20 bg-emerald-500/10 px-2.5 py-0.5 text-[10px] font-extrabold uppercase tracking-wider text-emerald-500">{{ __('Autonomia / Autorizado') }}</span>
            <h3 class="flex items-center gap-2 pt-1 text-sm font-bold text-[var(--text)]">
                <svg class="h-4 w-4 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.428 15.428a2 2 0 002.143-.231l5.531-5.531a2 2 0 000-2.828l-1.257-1.257a2 2 0 00-2.828 0l-5.531 5.531a2 2 0 00-.231 2.143L3 21l3.571-3.571z"></path></svg>
                {{ __('Concluir Intervenção') }}
            </h3>
            <p class="text-xs text-[var(--text-soft)]">{{ __('Registe os custos finais e o relatório técnico para fechar o ticket.') }}</p>
        </div>
    </div>

    <form id="techCompletionForm" class="space-y-4">
        <div class="space-y-2 rounded-xl border border-[var(--border)] bg-[var(--surface-2)] p-4">
            <label for="techTotalCost" class="block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Custo Final Executado (€)') }}</label>
            <input id="techTotalCost" type="number" step="0.01" class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface)] px-3 py-2 text-lg font-mono font-extrabold text-emerald-500 outline-none transition-all focus:border-emerald-500" placeholder="0.00">
        </div>

        <div>
            <label for="techFinalReport" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Relatório Técnico Final') }}</label>
            <textarea id="techFinalReport" rows="3" class="w-full resize-none rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2 text-xs text-[var(--text)] placeholder-[var(--text-soft)] outline-none transition-all focus:border-[var(--text)]" placeholder="{{ __('Descreva o trabalho efetuado e peças substituídas...') }}"></textarea>
        </div>

        <button type="button" id="btnFinishTicket" class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-4 py-3 text-xs font-bold uppercase tracking-wider text-white shadow-sm transition-all hover:bg-emerald-500 cursor-pointer">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"></path></svg>
            {{ __('Finalizar e Fechar Ticket') }}
        </button>
    </form>
</div>
