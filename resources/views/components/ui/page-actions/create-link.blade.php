@props([
    'href',
    'label',
    'variant' => 'primary',
])

<x-ui.page-actions.base-link :href="$href" :variant="$variant" size="sm" weight="bold" {{ $attributes }}>
    + {{ $label }}
</x-ui.page-actions.base-link>
