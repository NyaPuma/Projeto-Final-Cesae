<x-ui.ticket-detail.sidebar-card :title="__('Adicionar Comentário')">
    <form id="commentForm" class="space-y-3">
        <x-ui.form.textarea
            id="commentText"
            name="comment"
            rows="2"
            :placeholder="__('Escreva uma mensagem para a equipa...')"
            class="rounded-xl px-3 py-2 text-xs placeholder-[var(--text-soft)] focus:border-[var(--text)]"
        />
        <x-ui.buttons.submit variant="dark" size="sm" weight="bold">
            {{ __('Enviar') }}
        </x-ui.buttons.submit>
    </form>
</x-ui.ticket-detail.sidebar-card>
