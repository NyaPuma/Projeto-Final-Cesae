{{--
|--------------------------------------------------------------------------
| Pill / Badge Component Wrapper
|--------------------------------------------------------------------------
|
| Wrapper component for displaying pills, badges or labels.
| • 100% free of inline CSS or JS.
| • Hybrid property and slot support for maximum flexibility.
| • Parameterized tone and size exposure.
|
--}}

@props([
    'label' => null,
    'tone' => 'neutral',
    'size' => 'sm',
])

<x-ui.text.pill :tone="$tone" :size="$size" {{ $attributes }}>
    {{ $label ?? $slot }}
</x-ui.text.pill>
