{{--
|-------------------------------------------------------------------------- |
Text / Typography Component (Optimized)
|-------------------------------------------------------------------------- |
| Dynamic text/label component (Span, Heading, P, etc.).
| • Fixed tone mapping to synchronize with theme variables.
| • 100% free of inline CSS or JS.
| --}}
@props([
    'as' => 'span',
    'tone' => 'muted',
    'size' => 'sm',
    'tracking' => 'wide',
])

@php
    $tag = $as;

    $toneClasses = match ($tone) {
        'primary' => 'text-primary',
        'muted' => 'text-[var(--text-soft)]',
        default => 'text-[var(--text)]',
    };

    $sizeClasses = match ($size) {
        'xs' => 'text-xs',
        'sm' => 'text-xs',
        'md' => 'text-sm',
        default => 'text-xs',
    };

    $trackingClasses = match ($tracking) {
        'tight' => 'tracking-[0.16em]',
        'wide' => 'tracking-[0.18em]',
        'wider' => 'tracking-[0.2em]',
        'widest' => 'tracking-[0.24em]',
        default => 'tracking-[0.18em]',
    };
@endphp

<{{ $tag }} {{ $attributes->merge(['class' => trim($sizeClasses . ' font-semibold uppercase ' . $trackingClasses . ' ' . $toneClasses)]) }}>
    {{ $slot }}
</{{ $tag }}>
