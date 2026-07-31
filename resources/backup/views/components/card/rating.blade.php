{{--
|--------------------------------------------------------------------------
| Card Rating Component (Otimizado)
|--------------------------------------------------------------------------
|
| Sistema de avaliação visual (KPIs, equipamentos, feedback).
| • Acessibilidade garantida com ARIA labels.
| • Ícones SVG para nitidez e controlo de cores.
| • Design fluido e responsivo.
|
--}}

@props([
    'value' => 0,
    'max' => 5,
    'size' => 'md',      // 'sm', 'md', 'lg'
    'readonly' => true,
])

<div
    {{ $attributes->class([
        'ui-card-rating',
        "ui-card-rating--{$size}",
        'ui-card-rating--readonly' => $readonly,
    ]) }}
    role="img"
    aria-label="Classificação: {{ $value }} de {{ $max }} estrelas"
>
    @for($i = 1; $i <= $max; $i++)
        <span class="ui-card-rating__star {{ $i <= $value ? 'ui-card-rating__star--active' : '' }}">
            <svg viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
            </svg>
        </span>
    @endfor
</div>
