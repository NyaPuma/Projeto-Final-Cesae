{{--
|--------------------------------------------------------------------------
| Card Index Component (Alias / Facade Wrapper)
|--------------------------------------------------------------------------
|
| Ponto de entrada principal conveniente para o sistema de cartões (ex: <x-card>).
| • Encapsula o componente base (<x-ui.card.card>), reduzindo a complexidade de chamada.
| • Validação e sanitização prévia de props antes do reencaminhamento.
| • Reencaminhamento transparente de slots nomeados ($header, $footer, $actions).
| • Suporte estendido a links ('href') e tags semânticas customizáveis ('tag').
| • 100% livre de CSS ou JS inline.
|
--}}

@props([
    'variant' => 'default',    // 'default', 'outlined', 'flat', 'elevated', 'bordered', 'ghost'
    'size' => 'md',           // 'sm', 'md', 'lg'
    'hover' => false,         // Efeito visual de foco/elevação ao passar o cursor
    'clickable' => false,     // Define o cartão como interativo (cursor pointer, etc.)
    'disabled' => false,      // Estado desativado
    'selected' => false,      // Estado selecionado
    'active' => false,        // Estado ativo
    'loading' => false,       // Estado de carregamento
    'skeleton' => false,      // Estado em estrutura esqueleto
    'compact' => false,       // Modo compacto com paddings reduzidos
    'flush' => false,         // Remove paddings internos para colar conteúdo nas bordas
    'role' => null,           // Atributo ARIA role
    'tag' => 'div',           // Tag HTML semântica ('div', 'article', 'section', 'a')
    'href' => null,           // URL se o cartão for um elemento clicável de navegação
])

@php
    // Validação e normalização de variantes
    $allowedVariants = ['default', 'outlined', 'flat', 'elevated', 'bordered', 'ghost'];
    $validVariant = in_array(mb_strtolower($variant), $allowedVariants, true) ? mb_strtolower($variant) : 'default';

    // Validação e normalização de tamanhos
    $allowedSizes = ['sm', 'md', 'lg'];
    $validSize = in_array(mb_strtolower($size), $allowedSizes, true) ? mb_strtolower($size) : 'md';

    // Deteção inteligente de interatividade: se tiver 'href', ativa automaticamente 'clickable' e define tag 'a'
    $resolvedHref = $href ?? $attributes->get('href');
    $isLink = !empty($resolvedHref);
    $resolvedTag = $isLink ? 'a' : $tag;
    $resolvedClickable = $clickable || $isLink;

    // Captura e resolução de slots nomeados para reencaminhamento transparente
    $headerContent = $header ?? $headerSlot ?? null;
    $footerContent = $footer ?? $footerSlot ?? null;
    $actionsContent = $actions ?? $actionsSlot ?? null;
    $iconContent = $icon ?? $iconSlot ?? null;
@endphp

<x-ui.card.card
    :variant="$validVariant"
    :size="$validSize"
    :hover="$hover"
    :clickable="$resolvedClickable"
    :disabled="$disabled"
    :selected="$selected"
    :active="$active"
    :loading="$loading"
    :skeleton="$skeleton"
    :compact="$compact"
    :flush="$flush"
    :role="$role"
    :tag="$resolvedTag"
    :href="$resolvedHref"
    {{ $attributes }}
>
    {{-- Reencaminhamento do Slot de Cabeçalho --}}
    @if($headerContent)
        <x-slot:header>
            {{ $headerContent }}
        </x-slot:header>
    @endif

    {{-- Reencaminhamento do Slot de Ícone --}}
    @if($iconContent)
        <x-slot:icon>
            {{ $iconContent }}
        </x-slot:icon>
    @endif

    {{-- Conteúdo Principal do Slot Padrão --}}
    {{ $slot }}

    {{-- Reencaminhamento do Slot de Ações --}}
    @if($actionsContent)
        <x-slot:actions>
            {{ $actionsContent }}
        </x-slot:actions>
    @endif

    {{-- Reencaminhamento do Slot de Rodapé --}}
    @if($footerContent)
        <x-slot:footer>
            {{ $footerContent }}
        </x-slot:footer>
    @endif
</x-ui.card.card>
