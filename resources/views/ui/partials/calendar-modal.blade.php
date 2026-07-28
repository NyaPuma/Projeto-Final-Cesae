<div id="eventModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
    role="dialog" aria-modal="true" aria-labelledby="modalTitle">
    <div class="relative w-full max-w-md bg-[var(--surface)] border border-[var(--border)] rounded-3xl p-8 shadow-2xl animate-[fadeIn_0.15s_ease-out]"
        id="modalContent">
        <h3 id="modalTitle" class="text-lg font-bold text-[var(--text)] mb-2"></h3>

        <div class="space-y-4 my-6">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Início') }}
                </p>
                <p id="modalStart" class="text-sm font-medium text-[var(--text)]"></p>
            </div>
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Fim') }}
                </p>
                <p id="modalEnd" class="text-sm font-medium text-[var(--text)]"></p>
            </div>
        </div>

        <div class="flex justify-end gap-3 mt-8">
            <button data-action="close-modal" id="closeModalBtn"
                class="px-5 py-2.5 bg-[var(--surface-2)] hover:bg-[var(--border)] text-sm font-bold text-[var(--text)] border border-[var(--border)] rounded-xl transition-all cursor-pointer min-h-[44px]">
                {{ __('Fechar') }}
            </button>
        </div>
    </div>
</div>
