{{--
|--------------------------------------------------------------------------
| Button Component
|--------------------------------------------------------------------------
| Variant, loading and disabled states. Renders an anchor when an href is
| provided, otherwise a real <button> element.
| • 100% free of inline CSS or JS.
|--}}
@props([
    'variant' => 'primary',
    'type' => 'button',
    'href' => null,
    'loading' => false,
    'disabled' => false,
])

@php
    $variantClass = match ($variant) {
        'secondary' => 'ui-button--secondary',
        'success' => 'ui-button--success',
        'danger' => 'ui-button--danger',
        'ghost' => 'ui-button--ghost',
        default => 'ui-button--primary',
    };

    $classes = trim(
        'ui-button ' . $variantClass
        . ($loading ? ' ui-button--loading' : '')
        . ($disabled ? ' ui-button--disabled' : '')
    );
@endphp

@if ($href)
    <a href="{{ $href }}" class="{{ $classes }}" @if ($loading) aria-busy="true" @endif @if ($disabled) aria-disabled="true" @endif>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" class="{{ $classes }}" @if ($loading) aria-busy="true" @endif @if ($disabled) disabled="disabled" @endif>
        {{ $slot }}
    </button>
@endif
