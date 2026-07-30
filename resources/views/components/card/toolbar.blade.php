{{--
|--------------------------------------------------------------------------
| Card Toolbar Component
|--------------------------------------------------------------------------
|
| Barra de ferramentas para filtros, pesquisa, paginação e ações em cartões.
| • Acessibilidade A11y WCAG completa (role="toolbar" com aria-label opcional).
| • Flexibilidade estrutural de layout e alinhamento via classes BEM (sem CSS inline).
| • Validação estrita de posições, espaçamentos, alinhamentos e tags HTML.
| • 100% livre de CSS ou JS inline.
|
--}}

@props([
    'position' => 'top',         // 'top', 'bottom', 'inline'
    'spacing' => 'md',           // 'none', 'sm', 'md', 'lg', 'xl'
    'border' => true,            // Exibe borda divisória característica
    'align' => 'between',        // 'start', 'end', 'center', 'between', 'around'
    'tag' => 'div',              // Tag HTML semântica ('div', 'nav', 'header', 'footer', 'section')
    'ariaLabel' => null,         // Rótulo acessível opcional para leitores de ecrã
])

@php
    // Validação da tag HTML principal
    $allowedTags = ['div', 'nav', 'header', 'footer', 'section'];
    $validTag = in_array(mb_strtolower($tag), $allowedTags, true) ? mb_strtolower($tag) : 'div';

    // Validação de posições
    $allowedPositions = ['top', 'bottom', 'inline'];
    $validPosition = in_array(mb_strtolower($position), $allowedPositions, true) ? mb_strtolower($position) : 'top';

    // Validação de espaçamentos
    $allowedSpacings = ['none', 'sm', 'md', 'lg', 'xl'];
    $validSpacing = in_array(mb_strtolower($spacing), $allowedSpacings, true) ? mb_strtolower($spacing) : 'md';

    // Validação de alinhamentos
    $allowedAligns = ['start', 'end', 'center', 'between', 'around'];
    $validAlign = in_array(mb_strtolower($align), $allowedAligns, true) ? mb_strtolower($align) : 'between';
@endphp

<{{ $validTag }}
    {{ $attributes->class([
        'ui-card-toolbar',
        "ui-card-toolbar--pos-{$validPosition}",
        "ui-card-toolbar--spacing-{$validSpacing}",
        "ui-card-toolbar--align-{$validAlign}",
        'ui-card-toolbar--border' => $border,
    ])->merge([
        'role' => 'toolbar',
        'aria-label' => $ariaLabel,
    ]) }}
>
    {{ $slot }}
</{{ $validTag }}>
