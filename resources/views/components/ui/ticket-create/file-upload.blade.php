<x-ui.ticket-create.field-group :label="__('Inserir Imagem (Opcional)')">
    <div class="flex w-full items-center gap-3 rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-2.5">
        <label for="ticketImage" class="cursor-pointer rounded-xl border border-[var(--border)] bg-[var(--surface)] px-3 py-1.5 text-xs font-semibold text-[var(--text)] transition hover:bg-[var(--surface-2)]">
            {{ __('Escolher ficheiro') }}
        </label>
        <input id="ticketImage" type="file" accept="image/*" class="hidden">
        <span id="fileName" data-default-label="{{ __('Nenhum ficheiro selecionado') }}" class="truncate text-sm text-[var(--text-soft)]">{{ __('Nenhum ficheiro selecionado') }}</span>
    </div>
</x-ui.ticket-create.field-group>
