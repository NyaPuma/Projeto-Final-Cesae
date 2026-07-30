{{--
|--------------------------------------------------------------------------
| Card Subtitle Component
|--------------------------------------------------------------------------
|
| Descrição secundária ou subtítulo para cartões e componentes de UI.
| • Suporte a truncagem de texto (line clamp) via classes BEM dedicadas (sem CSS inline).
| • Flexibilidade total de tags HTML semânticas ('p', 'span', 'div', 'h5', 'h6').
| • Validação rigorosa de tamanhos e resolução unificada de conteúdo (prop value ou slot).
| • 100% livre de CSS ou JS inline.
|
--}}

@props([
    'size' => 'md',      // 'xs', 'sm', 'md', 'lg'
    'clamp' => false,    // boolean (true para 2 linhas) ou inteiro (número de linhas ex: 1, 3)
    'tag' => 'p',        // Tag HTML semântica ('p', 'span', 'div', 'h4', 'h5', 'h6')
    'value' => null,     // Conteúdo textual opcional alternativo ao slot
])

@php
    // Validação da tag HTML semântica
    $allowedTags = ['p', 'span', 'div', 'h4', 'h5', 'h6'];
    $validTag = in_array(mb_strtolower($tag), $allowedTags, true) ? mb_strtolower($tag) : 'p';

    // Validação de tamanhos disponíveis
    $allowedSizes = ['xs', 'sm', 'md', 'lg'];
    $validSize = in_array(mb_strtolower($size), $allowedSizes, true) ? mb_strtolower($size) : 'md';

    // Tratamento robusto da prop clamp (suporta boolean ou número de linhas customizado)
    $isClampActive = false;
    $clampLines = null;

    if (is_bool($clamp)) {
        $isClampActive = $clamp;
        $clampLines = $clamp ? 2 : null; // Padrão de 2 linhas se ativado por boolean
    } elseif (is_numeric($clamp) && (int) $clamp > 0) {
        $isClampActive = true;
        $clampLines = (int) $clamp;
    }

    // Resolução de conteúdo unificada (prop value ou conteúdo do slot)
    $content = $value ?? ($slot->isNotEmpty() ? $slot : null);
@endphp

<{{ $validTag }}
    {{ $attributes->class([
        'ui-card-subtitle',
        "ui-card-subtitle--{$validSize}",
        'ui-card-subtitle--clamp' => $isClampActive,
        "ui-card-subtitle--clamp-{$clampLines}" => $isClampActive && $clampLines && $clampLines !== 2,
    ]) }}
>
    {{ $content }}
</{{ $validTag }}>
