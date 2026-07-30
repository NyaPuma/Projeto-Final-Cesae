{{--
|--------------------------------------------------------------------------
| Card Media Component
|--------------------------------------------------------------------------
|
| Área visual e multimédia do card (imagens, vídeos, banners e previews).
| • Suporte nativo a lazy loading, decoding assíncrono e imagem responsiva (srcset/sizes).
| • Enquadramento (object-fit) e rácios de aspeto (aspect-ratio) via classes BEM.
| • Suporte a sobreposições (overlays), gradientes e conteúdos sobrepostos (badges, botões).
| • Resolução flexível: imagem via 'src' ou media customizado no $slot (<video>, <picture>, iframe).
| • Tag HTML semântica configurável ('div', 'figure', 'header') com suporte a <figcaption>.
| • 100% livre de CSS ou JS inline.
|
--}}

@props([
    'src' => null,
    'alt' => '',
    'position' => 'top',     // 'top', 'bottom', 'left', 'right', 'background'
    'aspect' => 'auto',      // 'auto', 'square', 'video', 'portrait', 'landscape', 'wide', 'cinema'
    'fit' => 'cover',        // 'cover', 'contain', 'fill', 'none', 'scale-down'
    'loading' => 'lazy',     // 'lazy', 'eager'
    'decoding' => 'async',   // 'async', 'sync', 'auto'
    'srcset' => null,        // Atributo srcset para imagens responsivas
    'sizes' => null,         // Atributo sizes para breakpoints de imagem
    'overlay' => false,      // Ativa camada escura/gradiente de fundo sobre o media
    'caption' => null,       // Legenda de texto ou slot para figcaption
    'tag' => 'div',          // Tag HTML semântica ('div', 'figure', 'header', 'section')
])

@php
    // Validação da tag HTML principal
    $allowedTags = ['div', 'figure', 'header', 'section', 'article'];
    $validTag = in_array(mb_strtolower($tag), $allowedTags, true) ? mb_strtolower($tag) : 'div';

    // Validação de posicionamento
    $allowedPositions = ['top', 'bottom', 'left', 'right', 'background'];
    $validPosition = in_array(mb_strtolower($position), $allowedPositions, true) ? mb_strtolower($position) : 'top';

    // Validação de rácios de aspeto (aspect-ratio)
    $allowedAspects = ['auto', 'square', 'video', 'portrait', 'landscape', 'wide', 'cinema'];
    $validAspect = in_array(mb_strtolower($aspect), $allowedAspects, true) ? mb_strtolower($aspect) : 'auto';

    // Validação de enquadramento (object-fit)
    $allowedFits = ['cover', 'contain', 'fill', 'none', 'scale-down'];
    $validFit = in_array(mb_strtolower($fit), $allowedFits, true) ? mb_strtolower($fit) : 'cover';

    // Validação de atributos de performance de carregamento
    $validLoading = in_array(mb_strtolower($loading), ['lazy', 'eager'], true) ? mb_strtolower($loading) : 'lazy';
    $validDecoding = in_array(mb_strtolower($decoding), ['async', 'sync', 'auto'], true) ? mb_strtolower($decoding) : 'async';

    // Resolução de conteúdos e slots
    $hasSrc = !empty($src);
    $captionContent = $caption ?? $captionSlot ?? null;
    $overlayContent = $overlaySlot ?? null;
    $hasDefaultSlot = $slot->isNotEmpty();
@endphp

<{{ $validTag }}
    {{ $attributes->class([
        'ui-card-media',
        "ui-card-media--{$validPosition}",
        "ui-card-media--aspect-{$validAspect}",
        "ui-card-media--fit-{$validFit}",
        'ui-card-media--overlay' => $overlay,
        'ui-card-media--has-overlay-content' => $overlayContent !== null || ($hasSrc && $hasDefaultSlot),
    ]) }}
>
    {{-- Renderização da Imagem Padrão (se a prop 'src' for fornecida) --}}
    @if($hasSrc)
        <img
            src="{{ $src }}"
            alt="{{ $alt }}"
            loading="{{ $validLoading }}"
            decoding="{{ $validDecoding }}"
            @if($srcset) srcset="{{ $srcset }}" @endif
            @if($sizes) sizes="{{ $sizes }}" @endif
            class="ui-card-media__image"
        >
    @endif

    {{-- Renderização de Media Customizado (se não houver 'src' e o $slot contiver tags <video>, <picture>, etc.) --}}
    @if(!$hasSrc && $hasDefaultSlot)
        <div class="ui-card-media__custom">
            {{ $slot }}
        </div>
    @endif

    {{-- Camada de Overlay / Conteúdo Sobreposto (Badges, Botões de Play, Títulos em cima do media) --}}
    @if($overlayContent || ($hasSrc && $hasDefaultSlot))
        <div class="ui-card-media__overlay-content">
            {{ $overlayContent ?? $slot }}
        </div>
    @endif

    {{-- Legenda Semântica (Se tag='figure', usa <figcaption>, caso contrário usa <div>) --}}
    @if($captionContent)
        @if($validTag === 'figure')
            <figcaption class="ui-card-media__caption">
                {{ $captionContent }}
            </figcaption>
        @else
            <div class="ui-card-media__caption">
                {{ $captionContent }}
            </div>
        @endif
    @endif
</{{ $validTag }}>
