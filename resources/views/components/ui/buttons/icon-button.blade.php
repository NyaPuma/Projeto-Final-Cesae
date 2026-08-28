{{--
|--------------------------------------------------------------------------
| Icon Button Component Wrapper
|--------------------------------------------------------------------------
|
| Button wrapper optimized for icons with dynamic shape and size support.
| • 100% free of inline CSS or JS.
| • Invisible character cleanup and property conflict resolution.
|
--}}

@props([
    'variant' => 'secondary',
    'size' => 'md',
    'shape' => 'square',
    'type' => 'button',
])

@php
    $shapeClasses = $shape === 'round' ? 'rounded-full' : 'rounded-xl';

    $sizeClasses = match ($size) {
        'sm' => 'h-10 w-10 text-sm',
        'md' => 'h-11 w-11 text-base',
        default => 'h-10 w-10 text-sm',
    };
@endphp

<x-ui.buttons.button
    :type="$type"
    :variant="$variant"
    :size="$size"
    weight="bold"
    {{ $attributes->merge(['class' => trim($shapeClasses . ' ' . $sizeClasses . ' px-0')]) }}
>
    {{ $slot }}
</x-ui.buttons.button>
