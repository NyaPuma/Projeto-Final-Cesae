<x-ui.ticket-detail.sidebar-card :title="__('Evidências Fotográficas')">
    <form id="photoForm" class="mb-3 space-y-3 border-b border-[var(--border)] pb-4">
        <input id="photoInput" type="file" accept="image/*" class="block w-full cursor-pointer text-xs text-[var(--text-soft)] file:mr-3 file:rounded-lg file:border-0 file:bg-[var(--text)]/5 file:px-2 file:py-1 file:text-[11px] file:font-bold file:text-[var(--text)]">
        <button type="submit" class="inline-flex items-center justify-center rounded-xl border border-[var(--border)] bg-[var(--surface)] px-3 py-1.5 text-xs font-semibold text-[var(--text)] transition-all hover:bg-[var(--surface-2)] cursor-pointer">
            {{ __('Enviar Fotografia') }}
        </button>
    </form>
    <div id="photosSection" class="text-xs text-[var(--text-soft)]">
        <p class="italic">{{ __('Nenhuma evidência carregada.') }}</p>
    </div>
</x-ui.ticket-detail.sidebar-card>
