<div id="priorityWarningModal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/60 backdrop-blur-sm transition-opacity duration-300">
    <div class="mx-4 w-full max-w-md space-y-4 rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-2xl animate-[fadeIn_0.2s_ease-out]">
        <div class="flex items-start gap-3">
            <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-amber-500/20">
                <span class="text-xl">⚠️</span>
            </div>
            <div class="flex-1">
                <h3 class="text-sm font-bold text-[var(--text)]">{{ __('Atenção: Ticket Prioritário Pendente') }}</h3>
                <p id="priorityWarningText" class="mt-1 text-xs text-[var(--text-soft)]">{{ __('Existe um ticket de prioridade mais alta por atender.') }}</p>
                <div id="priorityWarningDetails" class="mt-2 space-y-1 rounded-xl border border-amber-500/20 bg-amber-500/5 p-3 text-xs">
                    <p class="font-semibold text-amber-600 dark:text-amber-400">{{ __('Detalhes:') }}</p>
                    <p id="priorityWarningCount" class="text-[var(--text-soft)]"></p>
                    <p id="priorityWarningCurrent" class="text-[var(--text-soft)]"></p>
                    <p id="priorityWarningAction" class="mt-1 text-[10px] text-[var(--text-soft)]"></p>
                </div>
            </div>
        </div>
        <div class="flex gap-3 pt-2">
            <x-ui.buttons.button id="btnForceStartTicket" variant="neutral" size="md" weight="bold" class="flex-1">
                {{ __('Sim, continuar') }}
            </x-ui.buttons.button>
            <x-ui.buttons.button id="btnViewUrgentTickets" variant="warning" size="md" weight="bold" class="flex-1">
                🔥 {{ __('Ir para ticket prioritário') }}
            </x-ui.buttons.button>
        </div>
    </div>
</div>
