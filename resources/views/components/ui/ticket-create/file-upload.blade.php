{{--
|-------------------------------------------------------------------------- |
Ticket Image Field Component (Otimizado)
|-------------------------------------------------------------------------- |
| Componente de upload de imagem para formulários de tickets.
| • Parametrização dinâmica de ID e Name para evitar conflitos no DOM.
| • Atributo 'name' incluído para correta submissão no backend Laravel.
| • 100% livre de CSS ou JS inline.
| --}}
@props([
    'label' => __('Inserir Imagem (Opcional)'),
    'name' => 'image',
    'id' => 'ticketImage',
    'accept' => 'image/*',
])

<x-ui.ticket-create.field-group :label="$label">
    <div class="flex w-full items-center gap-3 rounded-2xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-2.5">
        <label for="{{ $id }}" class="cursor-pointer rounded-xl border border-[var(--border)] bg-[var(--surface)] px-3 py-1.5 text-xs font-semibold text-[var(--text)] transition hover:bg-[var(--surface-2)]">
            {{ __('Escolher ficheiro') }}
        </label>

        <input
            id="{{ $id }}"
            name="{{ $name }}"
            type="file"
            accept="{{ $accept }}"
            {{ $attributes->merge(['class' => 'hidden']) }}
        >

        <span id="{{ $id }}Name" data-default-label="{{ __('Nenhum ficheiro selecionado') }}" class="truncate text-sm text-[var(--text-soft)]">
            {{ __('Nenhum ficheiro selecionado') }}
        </span>
    </div>
</x-ui.ticket-create.field-group>
