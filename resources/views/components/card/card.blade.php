{{--
|--------------------------------------------------------------------------
| Card Component Base
|--------------------------------------------------------------------------
|
| O contentor principal do sistema de cards.
| • Suporte a tags semânticas customizadas ('div', 'article', 'section', etc.).
| • Converte-se automaticamente em link (<a>) se receber a prop 'href'.
| • Acessibilidade ARIA reforçada (role, tabindex, aria-disabled, aria-selected, aria-busy).
| • Gestão nativa de estados de carregamento e slot de esqueleto.
|
--}}

@props([
    'href' => null,          // URL opcional que transforma o card num link semântico
    'tag' => 'div',          // Tag HTML base quando não é link ('div', 'article', 'section', 'li')
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
    'role' => null,          // Role ARIA customizado (ex: 'article', 'gridcell', 'button')
])

@php
    // Validação de tags HTML permitidas para a base do card
    $allowedTags = ['div', 'article', 'section', 'li', 'aside', 'main'];
    $validBaseTag = in_array(mb_strtolower($tag), $allowedTags, true) ? mb_strtolower($tag) : 'div';

    // Determina se renderiza como link <a> ou tag de bloco
    $isLink = !empty($href) && !$disabled;
    $finalTag = $isLink ? 'a' : $validBaseTag;

    // Se tem link ou foi configurado explicitamente como clicável
    $isClickable = ($clickable || $isLink) && !$disabled;

    // Resolução inteligente de Acessibilidade ARIA
    $resolvedRole = $role;
    if (!$resolvedRole && $isClickable && !$isLink) {
        $resolvedRole = 'button';
    }

    $tabindex = null;
    if ($isClickable && !$isLink) {
        $tabindex = '0';
    } elseif ($disabled && ($clickable || $isLink)) {
        $tabindex = '-1';
    }

    $isLoading = $loading || $skeleton;

    // Mapeamento de atributos ARIA e comportamentais
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
    if ($disabled) {
        $customAttributes['aria-disabled'] = 'true';
    }
    if ($selected) {
        $customAttributes['aria-selected'] = 'true';
    }
    if ($isLoading) {
        $customAttributes['aria-busy'] = 'true';
    }

    $skeletonContent = $skeletonSlot ?? null;
@endphp

<{{ $finalTag }}
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
        'ui-card--loading' => $isLoading,
    ]) }}
>
    @if($isLoading)
        {{-- Skeleton customizado via slot nomeado ou fallback para o componente padrão --}}
        @if($skeletonContent)
            {{ $skeletonContent }}
        @else
            <x-ui.card.skeleton />
        @endif
    @else
        {{ $slot }}
    @endif
</{{ $finalTag }}>
