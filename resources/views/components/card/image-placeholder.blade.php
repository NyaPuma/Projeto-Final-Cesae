{{--
|--------------------------------------------------------------------------
| Card Image Placeholder Component (Otimizado)
|--------------------------------------------------------------------------
|
| Placeholder visual para estados onde a imagem está ausente ou a carregar.
| • Suporte a múltiplos rácios de aspeto: 'square', 'video', 'portrait', 'landscape'.
| • Estilos: 'default', 'dashed' (para áreas de upload) e 'loading'.
| • Acessibilidade: role de imagem e labels descritivas.
|
--}}

@props([
    'icon' => null,
    'text' => null,
    'aspect' => 'square',   // 'square', 'video', 'portrait', 'landscape'
    'variant' => 'default', // 'default', 'dashed', 'loading'
])

<div
    {{ $attributes->class([
        'ui-card-image-placeholder',
        "ui-card-image-placeholder--{$aspect}",
        "ui-card-image-placeholder--{$variant}",
    ])->merge([
        'role' => 'img',
        'aria-label' => $text ?? 'Espaço reservado para imagem',
    ]) }}
>
    <div class="ui-card-image-placeholder__inner">
        {{-- Ícone do Placeholder --}}
        @if($icon)
            <div class="ui-card-image-placeholder__icon" aria-hidden="true">
                {!! $icon !!}
            </div>
        @endif

        {{-- Texto descritivo opcional --}}
        @if($text || $slot->isNotEmpty())
            <span class="ui-card-image-placeholder__text">
                {{ $text ?? $slot }}
            </span>
        @endif
    </div>
</div>
