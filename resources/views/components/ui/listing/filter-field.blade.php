{{--
|-------------------------------------------------------------------------- |
| Form Field Grid Wrapper Component (Optimized)
|-------------------------------------------------------------------------- |
| Field container with responsive grid (span) support, associated label
| and clean attribute and slot management.
|--}}
@props([
    'for' => null,
    'label' => null,
    'span' => null,
])

<div {{ $attributes->merge(['class' => $span]) }}>
    @if($label)
        <x-ui.text.eyebrow
            as="label"
            :for="$for"
            size="xs"
            tracking="wider"
            class="mb-1.5 block font-bold"
        >
            {{ $label }}
        </x-ui.text.eyebrow>
    @endif

    {{ $slot }}
</div>
