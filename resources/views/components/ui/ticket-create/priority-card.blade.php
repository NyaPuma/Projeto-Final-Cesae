@props([
    'priority',
    'label',
    'title',
    'description',
    'dot_class',
    'active' => false,
    'active_border_class',
    'hover_border_class',
])

<div data-priority="{{ $priority }}"
    @class([
        'priority-card cursor-pointer rounded-2xl bg-[var(--surface-2)] p-4 transition-all',
        'border-2 shadow-sm' => $active,
        $active_border_class => $active,
        'border border-[var(--border)]' => ! $active,
        $hover_border_class => ! $active,
    ])>
    <div class="mb-2 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <span @class(['h-2.5 w-2.5 rounded-full', $dot_class])></span>
            <span class="text-xs font-bold text-[var(--text)]">{{ $label }}</span>
        </div>
        <span @class(['h-2 w-2 rounded-full', $active ? $dot_class : $dot_class . '/40'])></span>
    </div>

    <h4 class="mb-1 text-xs font-semibold text-[var(--text)]">{{ $title }}</h4>
    <p class="text-[11px] leading-relaxed text-[var(--text-soft)]">{{ $description }}</p>
</div>
