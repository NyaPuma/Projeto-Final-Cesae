{{--
|-------------------------------------------------------------------------- |
| Data Table Container Component (Optimized)
|-------------------------------------------------------------------------- |
| Responsive data table with initial loading state support,
| Design System variable management and accessibility (A11y).
|--}}
@props([
    'table_id' => null,
    'body_id' => null,
    'aria_label' => __('common.Tabela de dados'),
    'loading_message' => __('auth.A carregar registos...'),
    'columns' => 1,
])

<div {{ $attributes->merge(['class' => 'ui-listing-table w-full overflow-hidden rounded-2xl border border-[var(--border)] bg-[var(--surface)] shadow-sm']) }} role="region" aria-live="polite" aria-label="{{ $aria_label }}">
    <div class="overflow-x-auto">
        <table @if($table_id) id="{{ $table_id }}" @endif class="min-w-full divide-y divide-[var(--border)] text-left text-sm">
            <thead class="bg-[var(--surface-2)] text-[var(--text)] uppercase tracking-wider font-bold text-xs">
                {{ $head }}
            </thead>
            <tbody @if($body_id) id="{{ $body_id }}" @endif class="divide-y divide-[var(--border)] text-[var(--text)]">
                <tr>
                    <td colspan="{{ $columns }}" class="px-5 py-12 text-center text-xs text-[var(--text-soft)]">
                        <div class="flex items-center justify-center gap-2">
                            <span class="h-2 w-2 rounded-full bg-primary animate-pulse"></span>
                            {{ $loading_message }}
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
