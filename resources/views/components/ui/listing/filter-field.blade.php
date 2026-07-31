{{--
|-------------------------------------------------------------------------- |
| Form Field Grid Wrapper Component (Otimizado)
|-------------------------------------------------------------------------- |
| Contentor de campo com suporte a grelhas responsivas (span), rótulo
| associado e gestão limpa de atributos e slots.
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
