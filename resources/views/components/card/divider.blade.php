{{--
|--------------------------------------------------------------------------
| Card Divider Component
|--------------------------------------------------------------------------
|
| Separador visual dentro do card para organizar grupos de informação.
| • Validação estrita de orientação ('horizontal', 'vertical') e espaçamentos.
| • Suporte para passagem de texto via prop 'label' ou slot padrão.
| • Rótulo textual centralizado automático apenas em divisores horizontais.
| • Acessibilidade ARIA nativa com role="separator" e aria-orientation.
|
--}}

@props([
    'label' => null,                // Texto alternativo ao slot para divisores com rótulo
    'spacing' => 'md',              // 'none', 'xs', 'sm', 'md', 'lg'
    'orientation' => 'horizontal',  // 'horizontal', 'vertical'
    'dashed' => false,              // Linha tracejada em vez de sólida
])

@php
    // Validação de orientação e espaçamentos suportados pelo CSS BEM
    $allowedOrientations = ['horizontal', 'vertical'];
    $validOrientation = in_array(mb_strtolower($orientation), $allowedOrientations, true)
        ? mb_strtolower($orientation)
        : 'horizontal';

    $allowedSpacings = ['none', 'xs', 'sm', 'md', 'lg'];
    $validSpacing = in_array(mb_strtolower($spacing), $allowedSpacings, true)
        ? mb_strtolower($spacing)
        : 'md';

    $isHorizontal = $validOrientation === 'horizontal';

    // Resolução do rótulo textual (slot tem prioridade sobre a prop)
    $dividerLabel = $slot->isNotEmpty() ? $slot : $label;
    $hasLabel = !empty($dividerLabel) && $isHorizontal;
@endphp

<div
    {{ $attributes->class([
        'ui-card-divider',
        "ui-card-divider--{$validOrientation}",
        "ui-card-divider--spacing-{$validSpacing}",
        'ui-card-divider--dashed' => $dashed,
        'ui-card-divider--with-label' => $hasLabel,
    ])->merge([
        'role' => 'separator',
        'aria-orientation' => $validOrientation,
    ]) }}
>
    {{-- Renderiza o rótulo centralizado apenas em separadores horizontais --}}
    @if($hasLabel)
        <span class="ui-card-divider__label">
            {{ $dividerLabel }}
        </span>
    @endif
</div>
