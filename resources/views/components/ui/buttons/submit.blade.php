{{--
|--------------------------------------------------------------------------
| Submit Button Component Wrapper
|--------------------------------------------------------------------------
|
| Optimized submit button wrapper with variant, size and weight support.
| • 100% free of inline CSS or JS.
| • Button type pre-set to 'submit'.
|
--}}

@props([
    'variant' => 'primary',
    'size' => 'md',
    'weight' => 'bold',
])

<x-ui.buttons.button
    type="submit"
    :variant="$variant"
    :size="$size"
    :weight="$weight"
    {{ $attributes }}
>
    {{ $slot }}
</x-ui.buttons.button>
