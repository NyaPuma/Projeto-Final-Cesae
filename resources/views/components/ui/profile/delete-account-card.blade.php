{{--
|-------------------------------------------------------------------------- |
Profile Delete Account Card Component
|-------------------------------------------------------------------------- |
| Card de zona de perigo para eliminação da conta, com modal de confirmação.
| • Padronizado com as variáveis CSS oficiais do Tailwind.
| • Interatividade via Alpine.js (x-data / x-show) sem CSS ou JS inline.
| --}}
@props([])

<x-ui.form.card
    tone="danger"
    :title="__('Zona de Perigo')"
    :description="__('A eliminação da conta é irreversível e remove todos os dados associados.')"
    icon-variant="danger"
    icon='<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>'
>
    <div x-data="{ open: false }">
        <x-ui.buttons.button
            type="button"
            @click="open = true"
            variant="danger"
            size="md"
            weight="semibold"
        >
            {{ __('Eliminar Conta') }}
        </x-ui.buttons.button>

        <div
            x-show="open"
            x-cloak
            @keydown.escape.window="open = false"
            role="dialog"
            aria-modal="true"
            aria-labelledby="delete-account-modal-title"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4 backdrop-blur-sm"
        >
            <div class="w-full max-w-md rounded-2xl border border-red-500/20 bg-[var(--surface)] p-6 shadow-xl">
                <h3 id="delete-account-modal-title" class="text-lg font-bold text-[var(--text)]">{{ __('Eliminar Conta') }}</h3>
                <p class="mt-3 text-sm text-[var(--text-soft)]">{{ __('Para eliminar a sua conta, contacte um administrador. Esta ação não pode ser revertida.') }}</p>

                <div class="mt-6 flex items-center justify-end gap-3">
                    <x-ui.buttons.button type="button" @click="open = false" variant="secondary" size="md" weight="semibold">
                        {{ __('Entendido') }}
                    </x-ui.buttons.button>
                </div>
            </div>
        </div>
    </div>
</x-ui.form.card>
