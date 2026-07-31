{{--
|--------------------------------------------------------------------------
| Card Subtitle Component (Otimizado)
|--------------------------------------------------------------------------
|
| Descrição secundária para cards.
| • Suporte a truncagem de texto (clamp) para layouts consistentes.
| • Flexibilidade via props para tamanhos.
|
--}}

@props([
    'size' => 'md',    // 'sm', 'md'
    'clamp' => false,  // se true, limita a 2 linhas com reticências
])

<p
    {{ $attributes->class([
        'ui-card-subtitle',
        "ui-card-subtitle--{$size}",
        'ui-card-subtitle--clamp' => $clamp,
    ]) }}
>
    {{ $slot }}
</p>
