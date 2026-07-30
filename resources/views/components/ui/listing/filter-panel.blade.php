@props([
    'results_id' => 'resultsCount',
])

<div {{ $attributes->merge(['class' => 'ui-listing-panel mb-6 rounded-2xl border border-(--border) bg-(--surface) p-5 shadow-sm animate-[fadeIn_0.2s_ease-out]']) }}>
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        {{ $slot }}
    </div>

    <div class="mt-4 flex flex-wrap items-center justify-between gap-2 border-t border-(--border) pt-4">
        <div class="flex items-center gap-2">
            <x-ui.buttons.button id="btnSearch" variant="primary" size="sm" weight="bold">
                {{ __('Pesquisar') }}
            </x-ui.buttons.button>
            <x-ui.buttons.button id="btnClear" variant="secondary" size="sm" weight="semibold">
                {{ __('Limpar filtros') }}
            </x-ui.buttons.button>
        </div>

        <div class="flex items-center gap-3">
            @isset($afterActions)
                {{ $afterActions }}
            @endisset
            <span id="{{ $results_id }}" class="text-xs font-semibold text-(--text-soft)"></span>
        </div>
    </div>
</div>
