{{--
|--------------------------------------------------------------------------
| Card Avatar Component (Otimizado)
|--------------------------------------------------------------------------
|
| Representação visual de utilizadores, técnicos ou equipas.
| • Iniciais totalmente seguras para caracteres UTF-8 (acentos).
| • Recuperação automática de erro de imagem (fallback para iniciais).
| • Estados com semântica de acessibilidade para leitores de ecrã.
|
--}}

@props([
    'src' => null,
    'name' => null,
    'size' => 'md',      // 'sm', 'md', 'lg', 'xl'
    'status' => null,    // 'online', 'offline', 'away', 'busy'
    'rounded' => 'full', // 'full', 'md', 'none'
])

@php
    // Extração segura das iniciais com suporte a caracteres acentuados (UTF-8)
    $initials = '';
    if ($name) {
        $words = preg_split('/\s+/', trim($name));
        $firstChar = isset($words[0]) ? mb_substr($words[0], 0, 1, 'UTF-8') : '';
        $secondChar = isset($words[1]) ? mb_substr($words[1], 0, 1, 'UTF-8') : '';
        $initials = mb_strtoupper($firstChar . $secondChar);
    }

    // Tradução de estados para leitores de ecrã (A11y)
    $statusLabels = [
        'online' => 'Online',
        'offline' => 'Offline',
        'away' => 'Ausente',
        'busy' => 'Ocupado',
    ];
    $statusLabel = $statusLabels[$status] ?? ($status ? ucfirst($status) : '');
@endphp

<div
    {{ $attributes->class([
        'ui-card-avatar',
        "ui-card-avatar--{$size}",
        "ui-card-avatar--{$rounded}",
    ]) }}
    @if($src)
        x-data="{ imgError: false }"
    @endif
>
    @if($src)
        {{-- Imagem de Avatar --}}
        <img
            src="{{ $src }}"
            alt="{{ $name ?? 'Avatar' }}"
            class="ui-card-avatar__image"
            x-show="!imgError"
            @error="imgError = true"
        >

        {{-- Fallback dinâmico caso o link da imagem quebre --}}
        <span
            class="ui-card-avatar__initials"
            x-show="imgError"
            style="display: none;"
        >
            {{ $initials ?: '?' }}
        </span>
    @else
        {{-- Renderização direta das iniciais se não houver src --}}
        <span class="ui-card-avatar__initials">
            {{ $initials ?: '?' }}
        </span>
    @endif

    {{-- Ponto de Estado Acessível --}}
    @if($status)
        <span
            class="ui-card-avatar__status ui-card-avatar__status--{{ $status }}"
            role="img"
            aria-label="Estado: {{ $statusLabel }}"
        ></span>
    @endif
</div>
