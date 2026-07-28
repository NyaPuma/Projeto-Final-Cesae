<x-ui.ticket-detail.sidebar-card :title="__('Adicionar Comentário')">
    <form id="commentForm" class="space-y-3">
        <textarea id="commentText" rows="2" class="w-full resize-none rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-3 py-2 text-xs text-[var(--text)] placeholder-[var(--text-soft)] outline-none transition-all focus:border-[var(--text)]" placeholder="{{ __('Escreva uma mensagem para a equipa...') }}"></textarea>
        <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-[var(--text)] px-4 py-2 text-xs font-bold text-[var(--surface)] shadow-sm transition-all hover:opacity-90">
            {{ __('Enviar') }}
        </button>
    </form>
</x-ui.ticket-detail.sidebar-card>
