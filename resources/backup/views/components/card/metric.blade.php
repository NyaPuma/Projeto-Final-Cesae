{{--
|--------------------------------------------------------------------------
| Card Metric Component (Otimizado)
|--------------------------------------------------------------------------
|
| Exibição de KPIs e métricas com indicadores de tendência.
| • Acessibilidade A11y (ARIA labels) para indicadores.
| • Ícones de tendência dinâmicos.
| • Suporte para slots em título e valor para casos complexos.
|
--}}

@props([
    'title' => null,
    'value' => null,
    'change' => null,
    'direction' => 'neutral', // 'up', 'down', 'neutral'
    'icon' => null,
    'description' => null,
    'variant' => 'default',
])

<div {{ $attributes->class([
    'ui-card-metric',
    "ui-card-metric--variant-{$variant}",
    "ui-card-metric--trend-{$direction}",
]) }}>

    {{-- Cabeçalho: Ícone e Título --}}
    @if($title || $icon)
        <div class="ui-card-metric__header">
            @if($icon)
                <div class="ui-card-metric__icon" aria-hidden="true">
                    {!! $icon !!}
                </div>
            @endif
            @if($title)
                <h4 class="ui-card-metric__title">{{ $title }}</h4>
            @endif
        </div>
    @endif

    {{-- Valor Principal --}}
    <div class="ui-card-metric__value">
        {{ $value }}
    </div>

    {{-- Indicador de Tendência --}}
    @if($change)
        <div class="ui-card-metric__trend" aria-label="Tendência: {{ $direction === 'up' ? 'Aumento' : 'Diminuição' }} de {{ $change }}">
            <span class="ui-card-metric__trend-icon">
                @if($direction === 'up')
                    <svg viewBox="0 0 20 20" fill="currentColor"><path d="M5 10l5-5 5 5M10 5v10"/></svg>
                @elseif($direction === 'down')
                    <svg viewBox="0 0 20 20" fill="currentColor"><path d="M5 10l5 5 5-5M10 15V5"/></svg>
                @endif
            </span>
            <span class="ui-card-metric__trend-value">{{ $change }}</span>
        </div>
    @endif

    {{-- Descrição Opcional --}}
    @if($description)
        <p class="ui-card-metric__description">{{ $description }}</p>
    @endif
</div>
