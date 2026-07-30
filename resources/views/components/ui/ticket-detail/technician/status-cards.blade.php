<div id="techBlockedCard" class="hidden rounded-2xl border border-amber-500/30 bg-amber-500/5 p-6 shadow-sm space-y-3">
    <div class="flex items-center gap-3 text-amber-600 dark:text-amber-400">
        <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
        </svg>
        <div>
            <h3 class="text-xs font-bold uppercase tracking-wider">{{ __('Ticket Bloqueado — Pendente Orçamento') }}</h3>
            <p class="mt-0.5 text-xs text-[var(--text-soft)]">{{ __('O custo estimado excede o limiar de autonomia. A intervenção está trancada até avaliação e aprovação do Administrador.') }}</p>
        </div>
    </div>
</div>

<div id="techRejectedCard" class="hidden rounded-2xl border border-rose-500/30 bg-rose-500/5 p-6 shadow-sm space-y-3">
    <div class="flex items-center gap-3 text-rose-600 dark:text-rose-400">
        <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
        </svg>
        <div>
            <h3 class="text-xs font-bold uppercase tracking-wider">{{ __('Reparação Abortada') }}</h3>
            <p class="mt-0.5 text-xs text-[var(--text-soft)]" id="techRejectedReason">{{ __('O orçamento para este ticket foi recusado pela Administração. A intervenção foi encerrada.') }}</p>
            <div id="techRejectedFeedback" class="hidden mt-2 rounded-xl border border-rose-500/20 bg-rose-500/10 p-3 text-xs"></div>
        </div>
    </div>
</div>

<div id="techApprovedCard" class="hidden rounded-2xl border border-emerald-500/30 bg-emerald-500/5 p-6 shadow-sm space-y-3">
    <div class="flex items-center gap-3 text-emerald-600 dark:text-emerald-400">
        <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <div>
            <h3 class="text-xs font-bold uppercase tracking-wider">{{ __('Orçamento Aprovado!') }}</h3>
            <p class="mt-0.5 text-xs text-[var(--text-soft)]">{{ __('A Administração aprovou o orçamento. Pode prosseguir com a reparação e registar os custos finais.') }}</p>
        </div>
    </div>
</div>
