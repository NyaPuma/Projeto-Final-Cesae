{{--
|--------------------------------------------------------------------------
| Card Badge Component (Otimizado)
|--------------------------------------------------------------------------
|
| Pequeno indicador visual para estados, prioridades, categorias ou contadores.
| • Suporta formato pílula (pill) para cantos totalmente ovais.
| • Inclusão opcional de ícones com alinhamento flexbox perfeito.
| • Ajuste automático de padding quando usado apenas como ponto de status.
|
--}}

@props([
    'variant' => 'default', // 'default', 'primary', 'success', 'warning', 'danger', 'info'
    'size' => 'md',         // 'sm', 'md', 'lg'
    'dot' => false,         // Exibe um micro-ponto de estado antes do texto
    'pill' => false,        // Se true, aplica cantos totalmente arredondados
    'icon' => null,         // Ícone SVG opcional
])

@php
    $hasSlot = $slot->isNotEmpty();
@endphp

<span
    {{ $attributes->class([
        'ui-card-badge',
        "ui-card-badge--{$variant}",
        "ui-card-badge--{$size}",
        'ui-card-badge--pill' => $pill,
        'ui-card-badge--has-dot' => $dot,
        'ui-card-badge--dot-only' => $dot && !$hasSlot && !$icon,
        'ui-card-badge--icon-only' => $icon && !$hasSlot,
    ]) }}
>
    {{-- Ponto de Estado --}}
    @if($dot)
        <span class="ui-card-badge__dot" aria-hidden="true"></span>
    @endif

    {{-- Ícone Opcional --}}
    @if($icon)
        <span class="ui-card-badge__icon" aria-hidden="true">
            {!! $icon !!}
        </span>
    @endif

    {{-- Texto --}}
    @if($hasSlot)
        <span class="ui-card-badge__label">
            {{ $slot }}
        </span>
    @endif
</span>
