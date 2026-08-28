{{--
|-------------------------------------------------------------------------- |
Pill / Badge Component (Optimized)
|-------------------------------------------------------------------------- |
| Component for displaying labels, badges and statuses in pill format.
| • Colors standardized via Tailwind and theme CSS variables.
| • 100% free of inline CSS or JS.
| --}}
@props([
    'tone' => 'neutral',
    'size' => 'sm',
])

@php
    $toneClasses = match ($tone) {
        'primary' => 'border-primary/20 bg-primary/10 text-primary',
        'success' => 'border-success/20 bg-success/10 text-success',
        'warning' => 'border-warning/20 bg-warning/10 text-warning',
        'danger' => 'border-danger/20 bg-danger/10 text-danger',
        default => 'border-[var(--border)] bg-[var(--surface-2)] text-[var(--text)]',
    };

    $sizeClasses = match ($size) {
        'xs' => 'px-3 py-1 text-xs tracking-[0.16em]',
        'sm' => 'px-3 py-1.5 text-xs tracking-[0.18em]',
        default => 'px-3 py-1.5 text-xs tracking-[0.18em]',
    };
@endphp

<span {{ $attributes->merge(['class' => trim('inline-flex w-fit items-center rounded-full border font-semibold uppercase ' . $sizeClasses . ' ' . $toneClasses)]) }}>
    {{ $slot }}
</span>
