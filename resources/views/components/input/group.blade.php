{{--
|--------------------------------------------------------------------------
| Input Group Component
|--------------------------------------------------------------------------
|
| Content wrapper para agrupar inputs, botões e addons numa linha coerente.
| • Acessibilidade A11y (role="group" com suporte a aria-label opcional).
| • Validação estrita e normalização de tamanhos e variantes BEM (sem CSS inline).
| • Suporte a elementos anexados (attached) ou espaçados.
| • Tag HTML semântica flexível ('div', 'fieldset', 'section').
| • 100% livre de CSS ou JS inline.
|
--}}

@props([
    'position' => 'default',    // 'default', 'start', 'end', 'center', 'between'
    'size' => 'md',             // 'xs', 'sm', 'md', 'lg', 'xl'
    'attached' => true,         // boolean (cola os elementos adjacentes entre si)
    'tag' => 'div',             // Tag HTML semântica ('div', 'fieldset', 'section')
    'ariaLabel' => null,        // Rótulo acessível opcional para o grupo de inputs
])

@php
    // Validação da tag HTML principal
    $allowedTags = ['div', 'fieldset', 'section'];
    $validTag = in_array(mb_strtolower($tag), $allowedTags, true) ? mb_strtolower($tag) : 'div';

    // Validação estrita de tamanhos
    $allowedSizes = ['xs', 'sm', 'md', 'lg', 'xl'];
    $validSize = in_array(mb_strtolower($size), $allowedSizes, true) ? mb_strtolower($size) : 'md';

    // Validação estrita de posições e alinhamentos
    $allowedPositions = ['default', 'start', 'end', 'center', 'between'];
    $validPosition = in_array(mb_strtolower($position), $allowedPositions, true) ? mb_strtolower($position) : 'default';
@endphp

<{{ $validTag }}
    {{ $attributes->class([
        'ui-input-group',
        'ui-input-group--attached' => $attached,
        "ui-input-group--size-{$validSize}",
        "ui-input-group--pos-{$validPosition}",
    ])->merge([
        'role' => 'group',
        'aria-label' => $ariaLabel,
    ]) }}
>
    {{ $slot }}
</{{ $validTag }}>
