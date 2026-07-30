@props([
    'for',
    'label',
    'span' => null,
])

<div @class([$span])>
    <x-ui.text.eyebrow as="label" for="{{ $for }}" size="xs" tracking="wider" class="mb-1.5 block font-bold">
        {{ $label }}
    </x-ui.text.eyebrow>

    {{ $slot }}
</div>
