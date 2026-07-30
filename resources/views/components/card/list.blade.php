{{--
|--------------------------------------------------------------------------
| Card List Component
|--------------------------------------------------------------------------
|
| Contentor de listas para dados, tickets, atividades e registos.
| • Correção de bug crítico: verificação de estado vazio via métodos nativos do Blade Slot ($slot->isEmpty()).
| • Suporte a mensagens de estado vazio via prop ('emptyMessage'), prop direta ou slot nomeado ($emptySlot).
| • Tag HTML semântica customizável ('ul', 'ol', 'div') com ajustamento do elemento vazio.
| • Sanitização estrita de espaçamentos e opções de contorno/divisores.
| • 100% livre de CSS ou JS inline.
|
--}}

@props([
    'spacing' => 'none',      // 'none', 'xs', 'sm', 'md', 'lg'
    'dividers' => false,      // Adiciona linhas divisórias entre itens da lista
    'scrollable' => false,    // Ativa scroll vertical com limites CSS
    'flush' => false,         // Remove margens internas para colar nas extremidades do cartão
    'empty' => null,          // Conteúdo/mensagem opcional para estado vazio
    'emptyMessage' => 'Sem registos disponíveis.', // Mensagem padrão para estado vazio
    'tag' => 'ul',            // Tag HTML semântica ('ul', 'ol', 'div')
])

@php
    // Validação da tag HTML principal
    $allowedTags = ['ul', 'ol', 'div'];
    $validTag = in_array(mb_strtolower($tag), $allowedTags, true) ? mb_strtolower($tag) : 'ul';

    // Determina a tag do item de estado vazio (se for 'div', usa 'div'; caso contrário 'li')
    $emptyItemTag = $validTag === 'div' ? 'div' : 'li';

    // Validação de espaçamentos
    $allowedSpacings = ['none', 'xs', 'sm', 'md', 'lg'];
    $validSpacing = in_array(mb_strtolower($spacing), $allowedSpacings, true) ? mb_strtolower($spacing) : 'none';

    // Se a opção 'flush' for verdadeira, força o espaçamento para 'none'
    $appliedSpacing = $flush ? 'none' : $validSpacing;

    // Resolução flexível do conteúdo de estado vazio
    $emptyContent = $empty ?? $emptySlot ?? $emptyMessage;

    // Deteção rigorosa de estado vazio
    $isEmpty = $slot->isEmpty();
@endphp

<{{ $validTag }}
    {{ $attributes->class([
        'ui-card-list',
        "ui-card-list--spacing-{$appliedSpacing}",
        'ui-card-list--dividers' => $dividers,
        'ui-card-list--scrollable' => $scrollable,
        'ui-card-list--flush' => $flush,
        'ui-card-list--empty' => $isEmpty,
    ]) }}
>
    @if ($isEmpty)
        <{{ $emptyItemTag }} class="ui-card-list__empty">
            @if(is_string($emptyContent))
                <span>{{ $emptyContent }}</span>
            @else
                {{ $emptyContent }}
            @endif
        </{{ $emptyItemTag }}>
    @else
        {{ $slot }}
    @endif
</{{ $validTag }}>
