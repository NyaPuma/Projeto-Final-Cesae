{{--
|--------------------------------------------------------------------------
| Card List Item Component
|--------------------------------------------------------------------------
|
| Item de linha para listas dentro de cards.
| • Resolução centralizada de conteúdos híbridos (Props ou Slots nomeados).
| • Deteção automática de interatividade (se tiver 'href', converte para tag <a>).
| • Renderização segura de SVGs inline para os ícones.
| • Acessibilidade garantida (A11y) nativa ou via atributos ARIA dinâmicos.
| • 100% livre de CSS ou JS inline.
|
--}}

@props([
    'icon' => null,
    'title' => null,
    'description' => null,
    'meta' => null,
    'action' => null,
    'clickable' => false,
    'tag' => 'li',          // Tag HTML padrão ('li', 'div', 'a')
])

@php
    // Deteção inteligente de interatividade e roteamento semântico de tag
    $href = $attributes->get('href');
    $isLink = !empty($href);

    // Se tiver um href, a tag tem de ser obrigatoriamente um <a> para acessibilidade nativa
    $resolvedTag = $isLink ? 'a' : (in_array(mb_strtolower($tag), ['li', 'div', 'article', 'a'], true) ? mb_strtolower($tag) : 'li');
    $resolvedClickable = $clickable || $isLink;

    // Resolução unificada de conteúdos (Aceita prop direta, slot nomeado ou nulo)
    $iconContent = $icon ?? $iconSlot ?? null;
    $titleContent = $title ?? $titleSlot ?? null;
    $descriptionContent = $description ?? $descriptionSlot ?? null;
    $metaContent = $meta ?? $metaSlot ?? null;
    $actionContent = $action ?? $actionSlot ?? null;

    // Atributos dinâmicos de acessibilidade
    $accessibilityAttributes = [];
    if ($resolvedClickable && !$isLink) {
        $accessibilityAttributes['role'] = 'button';
        $accessibilityAttributes['tabindex'] = '0';
    }

    $hasContent = $titleContent || $descriptionContent || $slot->isNotEmpty();
@endphp

<{{ $resolvedTag }}
    {{ $attributes->merge($accessibilityAttributes)->class([
        'ui-card-list-item',
        'ui-card-list-item--clickable' => $resolvedClickable,
        'ui-card-list-item--has-action' => !empty($actionContent),
    ]) }}
>
    {{-- Bloco de Ícone / Avatar --}}
    @if($iconContent)
        <div class="ui-card-list-item__icon" aria-hidden="true">
            @if(is_string($iconContent) && str_starts_with(trim($iconContent), '<svg'))
                {!! $iconContent !!}
            @else
                {{ $iconContent }}
            @endif
        </div>
    @endif

    {{-- Bloco Principal de Conteúdo (Título + Descrição ou HTML Livre) --}}
    @if($hasContent)
        <div class="ui-card-list-item__content">
            @if($titleContent)
                <div class="ui-card-list-item__title">
                    {{ $titleContent }}
                </div>
            @endif

            @if($descriptionContent)
                <div class="ui-card-list-item__description">
                    {{ $descriptionContent }}
                </div>
            @endif

            {{-- Permite conteúdo livre se as props/slots de título e descrição não forem usados --}}
            @if($slot->isNotEmpty() && !$titleContent && !$descriptionContent)
                {{ $slot }}
            @endif
        </div>
    @endif

    {{-- Bloco Meta (Data, Status, Valores, etc.) --}}
    @if($metaContent)
        <div class="ui-card-list-item__meta">
            {{ $metaContent }}
        </div>
    @endif

    {{-- Bloco de Ações (Botões, Menus Dropdown) --}}
    @if($actionContent)
        <div class="ui-card-list-item__action">
            {{ $actionContent }}
        </div>
    @endif
</{{ $resolvedTag }}>
