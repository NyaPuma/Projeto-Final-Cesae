{{--
|--------------------------------------------------------------------------
| Card Media Component (Otimizado)
|--------------------------------------------------------------------------
|
| Área visual do card para imagens ou previews.
| • Suporte a `lazy loading` automático.
| • Controlo de `object-fit` para evitar distorção.
| • Gestão dinâmica de rácios de aspeto via CSS nativo.
|
--}}

@props([
    'src' => null,
    'alt' => '',
    'position' => 'top',     // 'top', 'left', 'right'
    'aspect' => 'auto',      // 'square', 'video', 'portrait', 'landscape', 'auto'
    'fit' => 'cover',        // 'cover', 'contain'
    'overlay' => false,
    'loading' => 'lazy',     // 'lazy', 'eager'
])

<div
    {{ $attributes->class([
        'ui-card-media',
        "ui-card-media--{$position}",
        "ui-card-media--aspect-{$aspect}",
        "ui-card-media--fit-{$fit}",
        'ui-card-media--overlay' => $overlay,
    ]) }}
>
    @if($src)
        <img
            src="{{ $src }}"
            alt="{{ $alt }}"
            loading="{{ $loading }}"
            class="ui-card-media__image"
        >
    @endif

    @if($slot->isNotEmpty())
        <div class="ui-card-media__content">
            {{ $slot }}
        </div>
    @endif
</div>
