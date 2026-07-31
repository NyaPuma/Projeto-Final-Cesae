{{--
|--------------------------------------------------------------------------
| Card Grid Component (Otimizado)
|--------------------------------------------------------------------------
|
| Sistema de grelha ultra-flexível para organizar métricas, widgets e dashboards.
| • Grelha dinâmica baseada em CSS Grid com variáveis inline.
| • Controlo responsivo granular por breakpoint (sm, md, lg).
| • Gestão nativa de classes CSS com a diretiva `@class` do Blade.
|
--}}

@props([
    'columns' => 2,          // Colunas padrão em ecrãs grandes (desktop)
    'columnsSm' => 1,        // Colunas em ecrãs pequenos (mobile)
    'columnsMd' => null,     // Colunas em ecrãs médios (tablet) - Opcional
    'columnsLg' => null,     // Colunas em ecrãs grandes (desktop xl) - Opcional
    'gap' => 'md',           // 'none', 'xs', 'sm', 'md', 'lg', 'xl'
    'responsive' => true,    // Ativa o comportamento responsivo automático se colunas individuais não forem definidas
])

@php
    // Se o utilizador definir colunas por breakpoint, desativamos o comportamento automático básico
    $hasCustomBreakpoints = $columnsMd !== null || $columnsLg !== null;
    $autoResponsive = $responsive && !$hasCustomBreakpoints;
@endphp

<div
    {{ $attributes->class([
        'ui-card-grid',
        "ui-card-grid--gap-{$gap}",
        'ui-card-grid--auto-responsive' => $autoResponsive,
    ])->merge([
        // Passamos as configurações de colunas como variáveis CSS para que o CSS as aplique dinamicamente
        'style' => "
            --grid-cols-default: {$columns};
            --grid-cols-sm: {$columnsSm};
            " . ($columnsMd ? "--grid-cols-md: {$columnsMd};" : "") . "
            " . ($columnsLg ? "--grid-cols-lg: {$columnsLg};" : "") . "
        "
    ]) }}
>
    {{ $slot }}
</div>
