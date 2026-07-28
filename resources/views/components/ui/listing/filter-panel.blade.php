@props([
    'results_id' => 'resultsCount',
])

<div {{ $attributes->merge(['class' => 'ui-listing-panel mb-6 rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-5 shadow-sm animate-[fadeIn_0.2s_ease-out]']) }}>
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        {{ $slot }}
    </div>

    <div class="mt-4 flex flex-wrap items-center justify-between gap-2 border-t border-[var(--border)] pt-4">
        <div class="flex items-center gap-2">
            <button id="btnSearch" type="button" class="ui-button ui-button--primary inline-flex min-h-[36px] items-center justify-center rounded-xl px-4 py-2 text-xs font-bold text-[var(--on-primary)] shadow-sm transition-all hover:opacity-90 cursor-pointer">
                {{ __('Pesquisar') }}
            </button>
            <button id="btnClear" type="button" class="ui-button ui-button--outline inline-flex min-h-[36px] items-center justify-center rounded-xl border border-[var(--border)] px-4 py-2 text-xs font-semibold text-[var(--text)] shadow-sm transition-all hover:bg-[var(--surface-2)] cursor-pointer">
                {{ __('Limpar filtros') }}
            </button>
        </div>

        <div class="flex items-center gap-3">
            @isset($afterActions)
                {{ $afterActions }}
            @endisset
            <span id="{{ $results_id }}" class="text-xs font-semibold text-[var(--text-soft)]"></span>
        </div>
    </div>
</div>
