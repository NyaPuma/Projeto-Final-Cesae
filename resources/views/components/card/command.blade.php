{{--
|--------------------------------------------------------------------------
| Card Command Component
|--------------------------------------------------------------------------
|
| Atalhos de ações rápidas com micro-interações e semântica avançada.
| • Tag HTML dinâmica (<a>, <button>, <div>, <li>, etc.) resolvida com precisão.
| • Deteção automática de eventos de clique (Alpine.js, Livewire ou JS puro).
| • Suporte a slots flexíveis ($titleSlot, $descriptionSlot, $iconSlot ou $slot padrão).
| • Hierarquia de título customizável via 'titleTag' para acessibilidade do documento.
|
--}}

@props([
    'title' => null,
    'description' => null,
    'icon' => null,
    'href' => null,
    'variant' => 'default', // 'default', 'primary', 'success', 'warning', 'danger'/'error', 'info'
    'disabled' => false,
    'tag' => null,          // Permite forçar manualmente uma tag (ex: 'li', 'article')
    'titleTag' => 'h3',     // Tag semântica do título ('h2', 'h3', 'h4', 'span', 'div')
    'arrow' => true,        // Ativa ou oculta a seta indicadora visual
])

@php
    // Normalização de variantes para manter alinhamento com a folha de estilos CSS
    $normalizedVariant = match($variant) {
        'error' => 'danger',
        default => $variant,
    };

    // Deteção abrangente de escutas de clique (Alpine, Livewire ou JS)
    $hasClickEvent = $attributes->whereStartsWith(['@', 'x-on:', 'wire:', 'onclick'])->isNotEmpty();

    $isLink = !empty($href) && !$disabled;

    // Resolução da tag HTML semântica com validação de lista branca
    $allowedTags = ['a', 'button', 'div', 'li', 'article', 'section'];
    $customTag = $tag && in_array(mb_strtolower($tag), $allowedTags, true) ? mb_strtolower($tag) : null;
    $resolvedTag = $customTag ?? ($isLink ? 'a' : ($hasClickEvent ? 'button' : 'div'));

    // Validação da tag do título
    $allowedTitleTags = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'span', 'div', 'strong'];
    $validTitleTag = in_array(mb_strtolower($titleTag), $allowedTitleTags, true) ? mb_strtolower($titleTag) : 'h3';

    // Determina se o comando deve ter estados focado e interativo
    $isInteractive = ($isLink || $hasClickEvent || in_array($resolvedTag, ['button', 'a'], true)) && !$disabled;

    // Resolução de conteúdo via props ou slots nomeados
    $iconContent = $icon ?? $iconSlot ?? null;
    $titleContent = $title ?? $titleSlot ?? null;
    $descriptionContent = $description ?? $descriptionSlot ?? null;
    $hasCustomBody = $slot->isNotEmpty();

    // Atributos semânticos e de acessibilidade ARIA
    $customAttributes = [];
    if ($isLink) {
        $customAttributes['href'] = $href;
    }

    if ($resolvedTag === 'button') {
        $customAttributes['type'] = 'button';
        if ($disabled) {
            $customAttributes['disabled'] = 'disabled';
        }
    }

    if ($isInteractive && !in_array($resolvedTag, ['button', 'a'], true)) {
        $customAttributes['role'] = 'button';
        $customAttributes['tabindex'] = '0';
    }

    if ($disabled && $resolvedTag !== 'button') {
        $customAttributes['aria-disabled'] = 'true';
    }
@endphp

<{{ $resolvedTag }}
    {{ $attributes->merge($customAttributes)->class([
        'ui-card-command',
        "ui-card-command--{$normalizedVariant}",
        'ui-card-command--interactive' => $isInteractive,
        'ui-card-command--disabled' => $disabled,
        'ui-card-command--has-arrow' => $arrow,
    ]) }}
>
    {{-- Contentor do Ícone --}}
    @if($iconContent)
        <div class="ui-card-command__icon" aria-hidden="true">
            @if(is_string($iconContent) && str_starts_with(trim($iconContent), '<svg'))
                {!! $iconContent !!}
            @else
                {{ $iconContent }}
            @endif
        </div>
    @endif

    {{-- Conteúdo (Customizado via Slot ou Título/Descrição) --}}
    @if($hasCustomBody)
        <div class="ui-card-command__content">
            {{ $slot }}
        </div>
    @elseif($titleContent || $descriptionContent)
        <div class="ui-card-command__content">
            @if($titleContent)
                <{{ $validTitleTag }} class="ui-card-command__title">
                    {{ $titleContent }}
                </{{ $validTitleTag }}>
            @endif

            @if($descriptionContent)
                <p class="ui-card-command__description">
                    {{ $descriptionContent }}
                </p>
            @endif
        </div>
    @endif

    {{-- Seta Indicadora Interativa (SVG Moderno) --}}
    @if($arrow)
        <div class="ui-card-command__arrow" aria-hidden="true">
            <svg viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </div>
    @endif
</{{ $resolvedTag }}>
