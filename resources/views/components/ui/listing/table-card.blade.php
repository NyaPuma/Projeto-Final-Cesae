@props([
    'table_id',
    'body_id',
    'aria_label',
    'loading_message',
    'columns' => 1,
])

<div class="w-full overflow-hidden rounded-2xl border border-(--border) bg-(--surface) shadow-sm" role="region" aria-live="polite" aria-label="{{ $aria_label }}">
    <div class="overflow-x-auto">
        <table id="{{ $table_id }}" class="min-w-full divide-y divide-(--border) text-left text-xs">
            <thead class="bg-(--surface-2) text-(--text) uppercase tracking-wider font-bold text-[10px]">
                {{ $head }}
            </thead>
            <tbody id="{{ $body_id }}" class="divide-y divide-(--border) text-(--text)">
                <tr>
                    <td colspan="{{ $columns }}" class="px-5 py-12 text-center text-xs text-(--text-soft)">
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
