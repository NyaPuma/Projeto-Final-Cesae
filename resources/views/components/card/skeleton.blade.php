{{--
|--------------------------------------------------------------------------
| Card Skeleton Component (Otimizado)
|--------------------------------------------------------------------------
|
| Estado de carregamento "Skeleton Screen".
| • Animação "shimmer" integrada.
| • Semântica A11y (aria-busy, aria-hidden).
| • Estrutura modular.
|
--}}

@props([
    'lines' => 3,
    'hasHeader' => true,
    'hasFooter' => false,
])

<div
    {{ $attributes->class(['ui-card-skeleton']) }}
    role="status"
    aria-busy="true"
    aria-hidden="true"
>
    @if($hasHeader)
        <div class="ui-card-skeleton__header">
            <div class="ui-card-skeleton__icon"></div>
            <div class="ui-card-skeleton__heading">
                <div class="ui-card-skeleton__title"></div>
                <div class="ui-card-skeleton__subtitle"></div>
            </div>
        </div>
    @endif

    <div class="ui-card-skeleton__body">
        @for($i = 0; $i < $lines; $i++)
            <div class="ui-card-skeleton__line" style="width: {{ rand(80, 100) }}%"></div>
        @endfor
    </div>

    @if($hasFooter)
        <div class="ui-card-skeleton__footer"></div>
    @endif
</div>
