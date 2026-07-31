{{--
|--------------------------------------------------------------------------
| Card Loader Component (Otimizado)
|--------------------------------------------------------------------------
|
| Indicador de estados de carga.
| • overlay: se true, posiciona-se sobre o container pai.
| • size: 'sm', 'md', 'lg'.
|
--}}

@props([
    'size' => 'md',
    'text' => null,
    'overlay' => false, // Mais intuitivo que 'fullscreen' para cards
])

<div
    {{ $attributes->class([
        'ui-card-loader',
        "ui-card-loader--{$size}",
        'ui-card-loader--overlay' => $overlay,
    ]) }}
    role="status"
    aria-live="polite"
>
    <div class="ui-card-loader__spinner"></div>

    @if($text)
        <span class="ui-card-loader__text">
            {{ $text }}
        </span>
    @endif
</div>
