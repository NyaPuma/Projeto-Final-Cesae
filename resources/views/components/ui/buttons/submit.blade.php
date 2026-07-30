{{--
|--------------------------------------------------------------------------
| Submit Button Component Wrapper
|--------------------------------------------------------------------------
|
| Botão wrapper de submissão otimizado com suporte a variantes, tamanhos e pesos.
| • 100% livre de CSS ou JS inline.
| • Tipo de botão pré-definido como submissão ('submit').
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
