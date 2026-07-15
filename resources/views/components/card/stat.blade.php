{{--
|--------------------------------------------------------------------------
| Card Stat Component (Otimizado)
|--------------------------------------------------------------------------
|
| Exibição de métricas e KPIs.
| • Acessibilidade (ARIA roles) para dashboards.
| • Suporte a variantes de cor para estados (sucesso, erro, neutro).
|
--}}

@props([
    'label' => null,
    'value' => null,
    'trend' => null,
    'icon' => null,
    'trendType' => 'neutral', // 'positive', 'negative', 'neutral'
    'align' => 'left',        // 'left', 'center', 'right'
    'variant' => 'default',   // 'default', 'primary', 'success', 'danger'
])

<div {{ $attributes->class([
    'ui-card-stat',
    "ui-card-stat--{$align}",
    "ui-card-stat--variant-{$variant}",
]) }}>

    @if($icon)
        <div class="ui-card-stat__icon" aria-hidden="true">
            {!! $icon !!}
        </div>
    @endif

    <div class="ui-card-stat__content">
        @if($label)
            <span class="ui-card-stat__label">{{ $label }}</span>
        @endif

        @if($value)
            <strong class="ui-card-stat__value">{{ $value }}</strong>
        @endif

        @if($trend)
            <span
                class="ui-card-stat__trend ui-card-stat__trend--{{ $trendType }}"
                aria-label="Tendência: {{ $trendType === 'positive' ? 'Aumento' : ($trendType === 'negative' ? 'Diminuição' : 'Estável') }} de {{ $trend }}"
            >
                {{ $trend }}
            </span>
        @endif
    </div>
</div>
