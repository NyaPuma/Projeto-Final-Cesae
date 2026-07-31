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
        default => 'text-soft',
    };

    $sizeClasses = match ($size) {
        'xs' => 'text-[10px]',
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
