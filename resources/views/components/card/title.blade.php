{{--
|--------------------------------------------------------------------------
| Card Title Component
|--------------------------------------------------------------------------
|
| Título principal para cartões e blocos de conteúdo estruturados.
| • Validação e normalização rigorosa para tags HTML de heading (h1 a h6).
| • Suporte flexível a truncagem de texto simples ou por número de linhas via BEM.
| • Resolução unificada de conteúdos (através da prop value ou slot).
| • Variantes opcionais de dimensionamento tipográfico.
| • 100% livre de CSS ou JS inline.
|
--}}

@props([
    'level' => 3,          // Nível do cabeçalho HTML (1 a 6)
    'truncate' => false,   // boolean (true para 1 linha) ou inteiro (número de linhas ex: 2, 3)
    'value' => null,       // Conteúdo textual opcional alternativo ao slot
    'size' => null,        // Variante opcional de tamanho ('sm', 'md', 'lg', 'xl')
])

@php
    // Validação e normalização segura do nível de heading (garante h1-h6 com fallback seguro)
    $numericLevel = ctype_digit((string) $level) ? (int) $level : 3;
    $validLevel = ($numericLevel >= 1 && $numericLevel <= 6) ? $numericLevel : 3;
    $tag = "h{$validLevel}";

    // Tratamento robusto da prop truncate (suporta boolean ou número específico de linhas)
    $isTruncateActive = false;
    $truncateLines = null;

    if (is_bool($truncate)) {
        $isTruncateActive = $truncate;
        $truncateLines = $truncate ? 1 : null;
    } elseif (is_numeric($truncate) && (int) $truncate > 0) {
        $isTruncateActive = true;
        $truncateLines = (int) $truncate;
    }

    // Validação de tamanhos tipográficos opcionais
    $allowedSizes = ['sm', 'md', 'lg', 'xl'];
    $validSize = in_array(mb_strtolower($size), $allowedSizes, true) ? mb_strtolower($size) : null;

    // Resolução de conteúdo unificada (prop value ou conteúdo do slot)
    $content = $value ?? ($slot->isNotEmpty() ? $slot : null);
@endphp

<{{ $tag }}
    {{ $attributes->class([
        'ui-card-title',
        "ui-card-title--level-{$validLevel}",
        "ui-card-title--{$validSize}" => $validSize,
        'ui-card-title--truncate' => $isTruncateActive,
        "ui-card-title--truncate-{$truncateLines}" => $isTruncateActive && $truncateLines && $truncateLines !== 1,
    ]) }}
>
    {{ $content }}
</{{ $tag }}>
