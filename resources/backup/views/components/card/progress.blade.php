{{--
|--------------------------------------------------------------------------
| Card Progress Component (Otimizado)
|--------------------------------------------------------------------------
|
| Barra de progresso para estados, métricas e carregamentos.
| • Acessibilidade A11y (ARIA labels) para leitores de ecrã.
| • Gestão robusta de valores (0% - 100%).
| • Transições suaves integradas.
|
--}}

@props([
    'value' => 0,
    'label' => null,
    'showValue' => true,
    'variant' => 'primary', // 'primary', 'success', 'warning', 'danger'
    'size' => 'md',         // 'sm', 'md', 'lg'
    'animated' => false,
])

@php
    // Garante que o valor está sempre entre 0 e 100
    $normalizedValue = min(max((int)$value, 0), 100);
@endphp

<div
    {{ $attributes->class([
        'ui-card-progress',
        "ui-card-progress--{$size}",
        "ui-card-progress--{$variant}",
        'ui-card-progress--animated' => $animated,
    ]) }}
    role="progressbar"
    aria-valuenow="{{ $normalizedValue }}"
    aria-valuemin="0"
    aria-valuemax="100"
>
    @if($label || $showValue)
        <div class="ui-card-progress__header">
            @if($label)
                <span class="ui-card-progress__label">{{ $label }}</span>
            @endif
            @if($showValue)
                <span class="ui-card-progress__value">{{ $normalizedValue }}%</span>
            @endif
        </div>
    @endif

    <div class="ui-card-progress__track">
        <div
            class="ui-card-progress__bar"
            style="width: {{ $normalizedValue }}%"
        ></div>
    </div>
</div>
