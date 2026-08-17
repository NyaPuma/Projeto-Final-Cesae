{{--
|-------------------------------------------------------------------------- |
| Filter / Listing Panel Component (Otimizado)
|-------------------------------------------------------------------------- |
| Contentor de grelha para filtros e ações de pesquisa com suporte a
| variáveis do Design System e secções modulares.
|--}}
@props([
    'results_id' => 'resultsCount',
])

<div {{ $attributes->merge(['class' => 'ui-listing-panel mb-6 rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm animate-[fadeIn_0.2s_ease-out]']) }}>
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        {{ $slot }}
    </div>

    <div class="mt-4 flex flex-col-reverse items-stretch gap-3 border-t border-[var(--border)] pt-4 sm:flex-row sm:flex-wrap sm:items-center sm:justify-between sm:gap-2">
        <div class="flex items-center gap-2">
            <x-ui.buttons.button id="btnSearch" variant="primary" size="sm" weight="bold" class="flex-1 sm:flex-none">
                {{ __('ui.Pesquisar') }}
            </x-ui.buttons.button>
            <x-ui.buttons.button id="btnClear" variant="secondary" size="sm" weight="semibold" class="flex-1 sm:flex-none">
                {{ __('common.Limpar filtros') }}
            </x-ui.buttons.button>
        </div>

        <div class="flex items-center justify-between gap-3 sm:justify-end">
            @isset($afterActions)
                {{ $afterActions }}
            @endisset
            <span id="{{ $results_id }}" class="text-xs font-semibold text-[var(--text-soft)]"></span>
        </div>
    </div>
</div>
