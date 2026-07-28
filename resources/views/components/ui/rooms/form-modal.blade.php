<div id="roomModal" class="fixed inset-0 z-[9999] hidden items-center justify-center overflow-y-auto bg-black/60 p-4 backdrop-blur-sm">
    <div class="relative my-auto w-full max-w-md rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-2xl transition-all">
        <h3 id="roomModalTitle" class="mb-4 text-base font-bold text-[var(--text)]">{{ __('Dados da Sala') }}</h3>

        <form id="roomForm" class="space-y-4">
            <input id="roomId" name="id" type="hidden">

            <div>
                <label for="roomName" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Nome / Código da Sala') }}</label>
                <input id="roomName" name="name" type="text" required
                    class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none transition-all focus:border-orange-500 focus:ring-1 focus:ring-orange-500">
            </div>

            <div>
                <label for="roomLocation" class="mb-1.5 block text-[10px] font-bold uppercase tracking-wider text-[var(--text-soft)]">{{ __('Localização') }}</label>
                <input id="roomLocation" name="location" type="text" required
                    class="w-full rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2.5 text-xs text-[var(--text)] outline-none transition-all focus:border-orange-500 focus:ring-1 focus:ring-orange-500">
            </div>

            <div class="mt-6 flex items-center justify-end gap-2 border-t border-[var(--border)] pt-4">
                <button type="button" data-action="close-room-modal" class="cursor-pointer rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-2 text-xs font-semibold text-[var(--text)] transition-all hover:bg-[var(--border)]">
                    {{ __('Cancelar') }}
                </button>
                <button type="submit" class="cursor-pointer rounded-xl bg-orange-500 px-4 py-2 text-xs font-bold text-white shadow-sm transition-all hover:bg-orange-600">
                    {{ __('Guardar') }}
                </button>
            </div>
        </form>
    </div>
</div>
