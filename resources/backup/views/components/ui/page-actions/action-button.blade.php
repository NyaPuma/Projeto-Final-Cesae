@props([
    'label',
    'variant' => 'accent',
])

<x-ui.page-actions.base-button :variant="$variant" size="sm" weight="bold" {{ $attributes }}>
    + {{ $label }}
</x-ui.page-actions.base-button>
