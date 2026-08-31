{{--
|--------------------------------------------------------------------------
| Badge Component
|--------------------------------------------------------------------------
| Small label/chip with variant tone, optional dot and pill treatments.
| • 100% free of inline CSS or JS.
|--}}
@props([
    'variant' => 'neutral',
    'dot' => false,
    'pill' => false,
])

<span {{ $attributes->merge(['class' => trim(
    'ui-card-badge ui-card-badge--' . $variant
    . ($pill ? ' ui-card-badge--pill' : '')
    . ($dot ? ' ui-card-badge--has-dot' : '')
)]) }}>
    {{ $slot }}
</span>
