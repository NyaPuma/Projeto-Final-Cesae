{{--
|--------------------------------------------------------------------------
| Pill / Badge Component Wrapper
|--------------------------------------------------------------------------
|
| Componente wrapper para exibição de pílulas, badges ou etiquetas.
| • 100% livre de CSS ou JS inline.
| • Suporte híbrido a propriedades e slots para máxima flexibilidade.
| • Exposição parametrizada de tons e tamanhos.
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
