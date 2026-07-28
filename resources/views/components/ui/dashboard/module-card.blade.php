@props([
    'href',
    'icon',
    'title',
    'description',
    'badge' => null,
    'accent' => 'bg-primary/10',
    'hover' => 'hover:border-[var(--text)]/20 hover:shadow-[0_16px_40px_rgba(15,23,42,0.08)]',
])

<a
    href="{{ $href }}"
    {{ $attributes->class([
        'ui-dashboard-module group rounded-2xl border border-[var(--border)] bg-[var(--surface)] p-6 shadow-[0_1px_2px_rgba(0,0,0,0.01)] transition-all duration-300 hover:-translate-y-1',
        $hover,
    ]) }}
>
    <div class="{{ $accent }} mb-4 flex h-11 w-11 items-center justify-center rounded-2xl text-xl">
        {{ $icon }}
    </div>

    <h3 class="flex items-center gap-1.5 text-sm font-semibold tracking-tight text-[var(--text)]">
        <span>{{ $title }}</span>
        @if($badge)
            <span class="inline-flex items-center rounded border border-indigo-500/20 bg-indigo-500/10 px-1.5 py-0.5 text-[9px] font-medium text-indigo-600 dark:border-indigo-400/20 dark:bg-indigo-400/10 dark:text-indigo-400">
                {{ $badge }}
            </span>
        @endif
    </h3>

    <p class="mt-1.5 text-xs leading-relaxed text-[var(--text-soft)]">
        {{ $description }}
    </p>
</a>
