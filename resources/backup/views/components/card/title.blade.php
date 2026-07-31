{{--
|--------------------------------------------------------------------------
| Card Title Component (Otimizado)
|--------------------------------------------------------------------------
|
| Título principal com suporte a níveis de heading e truncagem.
| • Validação de segurança para tags HTML.
| • Suporte a truncagem de texto (design limpo).
|
--}}

@props([
    'level' => 3,
    'truncate' => false,
])

@php
    // Valida se o nível é um header HTML válido (1-6)
    $tag = in_array($level, [1, 2, 3, 4, 5, 6]) ? "h{$level}" : "h3";
@endphp

<{{ $tag }} {{ $attributes->class([
    'ui-card-title',
    'ui-card-title--truncate' => $truncate,
]) }}>
    {{ $slot }}
</{{ $tag }}>
