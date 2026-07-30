{{--
|--------------------------------------------------------------------------
| Card Badge Component
|--------------------------------------------------------------------------
|
| Pequeno indicador visual para estados, prioridades, categorias ou contadores.
| • Suporta passagem de texto via prop 'label' ou slot predefinido.
| • Formato pílula (pill) para cantos totalmente ovais.
| • Suporte seguro para ícones via prop ou slot nomeado ($iconSlot).
| • Tratamento de variantes e estados sem texto para acessibilidade.
|
--}}

@props([
    'label' => null,
    'variant' => 'default', // 'default', 'primary', 'success', 'warning', 'danger'/'error', 'info'
    'size' => 'md',         // 'sm', 'md', 'lg'
    'dot' => false,         // Exibe um micro-ponto de estado antes do texto
    'pill' => false,        // Se true, aplica cantos totalmente arredondados
    'icon' => null,         // Ícone SVG ou componente opcional
])

@php
    // Normalização de variantes para manter alinhamento com a folha de estilos CSS
    $normalizedVariant = match($variant) {
        'error' => 'danger',
        default => $variant,
    };

    $badgeLabel = $slot->isNotEmpty() ? $slot : $label;
    $iconContent = $icon ?? $iconSlot ?? null;
    $hasLabel = !empty($badgeLabel);
@endphp

<span
    {{ $attributes->class([
        'ui-card-badge',
        "ui-card-badge--{$normalizedVariant}",
        "ui-card-badge--{$size}",
        'ui-card-badge--pill' => $pill,
        'ui-card-badge--has-dot' => $dot,
        'ui-card-badge--dot-only' => $dot && !$hasLabel && !$iconContent,
        'ui-card-badge--icon-only' => $iconContent && !$hasLabel,
    ]) }}
>
    {{-- Ponto de Estado --}}
    @if($dot)
        <span class="ui-card-badge__dot" aria-hidden="true"></span>
    @endif

    {{-- Ícone Opcional --}}
    @if($iconContent)
        <span class="ui-card-badge__icon" aria-hidden="true">
            @if(is_string($iconContent) && str_starts_with(trim($iconContent), '<svg'))
                {!! $iconContent !!}
            @else
                {{ $iconContent }}
            @endif
        </span>
    @endif

    {{-- Texto / Rótulo --}}
    @if($hasLabel)
        <span class="ui-card-badge__label">
            {{ $badgeLabel }}
        </span>
    @endif
</span>
