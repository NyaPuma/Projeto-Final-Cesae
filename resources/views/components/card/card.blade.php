{{--
|--------------------------------------------------------------------------
| Card Component Base (Otimizado)
|--------------------------------------------------------------------------
|
| O contentor principal do sistema de cards.
| • Converte-se dinamicamente em link (<a>) se receber um atributo href.
| • Gestão nativa de acessibilidade (role, tabindex e aria-attributes).
| • Slot de esqueleto substituível para loadings personalizados de alta fidelidade.
|
--}}

@props([
    'href' => null,          // URL opcional que transforma o card num link semântico
    'variant' => 'default',  // 'default', 'flat', 'bordered', 'nested', 'primary'
    'size' => 'md',          // 'sm', 'md', 'lg'
    'hover' => false,        // Ativa efeito de elevação/sombra ao passar o rato
    'clickable' => false,    // Ativa cursor pointer e comportamentos reativos
    'disabled' => false,     // Desativa interações e esmaece visualmente
    'selected' => false,     // Estado ativo para cards de seleção/múltipla escolha
    'active' => false,       // Estado de destaque ativo (ex: item de menu lateral)
    'loading' => false,      // Ativa o estado de carregamento
    'skeleton' => false,     // Exibe o esqueleto estrutural de loading
    'compact' => false,      // Aplica padding reduzido globalmente no card
    'flush' => false,        // Remove totalmente as bordas e paddings exteriores
    'role' => null,          // Role ARIA customizado (ex: 'article', 'gridcell')
])

@php
    // Define a tag dinâmica de acordo com a existência de link
    $isLink = !empty($href) && !$disabled;
    $tag = $isLink ? 'a' : 'div';

    // Se tem link ou foi configurado como clicável
    $isClickable = ($clickable || $isLink) && !$disabled;

    // Resolução inteligente de Acessibilidade
    $resolvedRole = $role;
    if (!$resolvedRole && $isClickable && !$isLink) {
        $resolvedRole = 'button';
    }

    $tabindex = null;
    if ($isClickable) {
        $tabindex = '0';
    } elseif ($disabled && ($clickable || $isLink)) {
        $tabindex = '-1';
    }

    // Mapeamento de atributos dinâmicos seguros
    $customAttributes = [];
    if ($isLink) {
        $customAttributes['href'] = $href;
    }
    if ($resolvedRole) {
        $customAttributes['role'] = $resolvedRole;
    }
    if ($tabindex !== null) {
        $customAttributes['tabindex'] = $tabindex;
    }
@endphp

<{{ $tag }}
    {{ $attributes->merge($customAttributes)->class([
        'ui-card',
        "ui-card--{$variant}",
        "ui-card--{$size}",
        'ui-card--hover' => $hover && !$disabled,
        'ui-card--clickable' => $isClickable,
        'ui-card--disabled' => $disabled,
        'ui-card--selected' => $selected,
        'ui-card--active' => $active,
        'ui-card--compact' => $compact,
        'ui-card--flush' => $flush,
        'ui-card--loading' => $loading || $skeleton,
    ]) }}
    @if($disabled) aria-disabled="true" @endif
    @if($selected) aria-selected="true" @endif
>
    @if($loading || $skeleton)
        {{-- Verifica se o programador passou um layout de carregamento personalizado --}}
        @if(isset($skeletonSlot))
            {{ $skeletonSlot }}
        @else
            <x-ui.card.skeleton />
        @endif
    @else
        {{ $slot }}
    @endif
</{{ $tag }}>
