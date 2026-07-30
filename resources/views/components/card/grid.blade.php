{{--
|--------------------------------------------------------------------------
| Card Grid Component
|--------------------------------------------------------------------------
|
| Sistema de grelha ultra-flexível para organizar métricas, widgets e dashboards.
| • 100% livre de CSS/JS inline: mapeamento total por classes BEM modulares.
| • Controlo responsivo granular por breakpoint (sm, md, lg, xl).
| • Tag HTML semântica customizável ('div', 'ul', 'ol', 'section', 'article').
| • Sanitização e validação estrita de colunas (1 a 12) e espaçamentos (gap).
|
--}}

@props([
    'columns' => 2,          // Colunas padrão em ecrãs grandes (desktop)
    'columnsSm' => 1,        // Colunas em ecrãs pequenos (mobile)
    'columnsMd' => null,     // Colunas em ecrãs médios (tablet) - Opcional
    'columnsLg' => null,     // Colunas em ecrãs grandes (desktop xl) - Opcional
    'columnsXl' => null,     // Colunas em ecrãs ultra grandes - Opcional
    'gap' => 'md',           // 'none', 'xs', 'sm', 'md', 'lg', 'xl'
    'responsive' => true,    // Ativa o comportamento responsivo automático se colunas individuais não forem definidas
    'tag' => 'div',          // Tag HTML semântica ('div', 'ul', 'ol', 'section', 'article')
])

@php
    // Validação da tag HTML semântica
    $allowedTags = ['div', 'ul', 'ol', 'section', 'article', 'main'];
    $validTag = in_array(mb_strtolower($tag), $allowedTags, true) ? mb_strtolower($tag) : 'div';

    // Helper para sanitizar o número de colunas (garante inteiros entre 1 e 12)
    $sanitizeCols = static function ($val) {
        if ($val === null || $val === '') {
            return null;
        }
        $num = (int) $val;
        return ($num >= 1 && $num <= 12) ? $num : null;
    };

    $cols = $sanitizeCols($columns) ?? 2;
    $colsSm = $sanitizeCols($columnsSm) ?? 1;
    $colsMd = $sanitizeCols($columnsMd);
    $colsLg = $sanitizeCols($columnsLg);
    $colsXl = $sanitizeCols($columnsXl);

    // Validação de espaçamento (gap)
    $allowedGaps = ['none', 'xs', 'sm', 'md', 'lg', 'xl'];
    $validGap = in_array(mb_strtolower($gap), $allowedGaps, true) ? mb_strtolower($gap) : 'md';

    // Se o utilizador definir colunas por breakpoint, desativamos o comportamento automático básico
    $hasCustomBreakpoints = $colsMd !== null || $colsLg !== null || $colsXl !== null;
    $autoResponsive = $responsive && !$hasCustomBreakpoints;
@endphp

<{{ $validTag }}
    {{ $attributes->class([
        'ui-card-grid',
        "ui-card-grid--cols-{$cols}",
        "ui-card-grid--cols-sm-{$colsSm}",
        "ui-card-grid--cols-md-{$colsMd}" => $colsMd !== null,
        "ui-card-grid--cols-lg-{$colsLg}" => $colsLg !== null,
        "ui-card-grid--cols-xl-{$colsXl}" => $colsXl !== null,
        "ui-card-grid--gap-{$validGap}",
        'ui-card-grid--auto-responsive' => $autoResponsive,
    ]) }}
>
    {{ $slot }}
</{{ $validTag }}>
