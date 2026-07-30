{{--
|--------------------------------------------------------------------------
| Card Footer Component
|--------------------------------------------------------------------------
|
| Área inferior do card para ações, paginação ou metadados de estado.
| • Tag HTML semântica customizável ('footer', 'div', 'section') com validação.
| • Layout adaptável: suporte a conteúdo secundário via prop 'secondary' ou slots.
| • Resolução inteligente de alinhamento ('start', 'center', 'end', 'between', 'around').
| • Suporte a 'flush' para remover paddings e colar elementos às bordas.
|
--}}

@props([
    'spacing' => 'md',      // 'none', 'xs', 'sm', 'md', 'lg'
    'border' => true,       // Exibe uma linha divisória fina no topo do rodapé
    'align' => 'end',       // 'start', 'center', 'end', 'between', 'around'
    'flush' => false,       // Remove paddings para tabelas ou botões colarem nas bordas
    'tag' => 'footer',      // Tag HTML semântica ('footer', 'div', 'section')
    'secondary' => null,    // Conteúdo/rótulo secundário opcional à esquerda
])

@php
    // Validação de tags HTML permitidas para a base do footer
    $allowedTags = ['footer', 'div', 'section'];
    $validTag = in_array(mb_strtolower($tag), $allowedTags, true) ? mb_strtolower($tag) : 'footer';

    // Validação de espaçamentos
    $allowedSpacings = ['none', 'xs', 'sm', 'md', 'lg'];
    $validSpacing = in_array(mb_strtolower($spacing), $allowedSpacings, true) ? mb_strtolower($spacing) : 'md';

    // Validação de alinhamentos
    $allowedAligns = ['start', 'center', 'end', 'between', 'around'];
    $validAlign = in_array(mb_strtolower($align), $allowedAligns, true) ? mb_strtolower($align) : 'end';

    // Se a opção 'flush' for verdadeira, zeramos o espaçamento
    $appliedSpacing = $flush ? 'none' : $validSpacing;

    // Resolução unificada do conteúdo secundário (prop, slot $secondary ou $secondarySlot)
    $secondaryContent = $secondary ?? $secondarySlot ?? (isset($secondary) && $secondary instanceof \Illuminate\View\ComponentSlot ? $secondary : null);
    $hasSecondary = !empty($secondaryContent) && ($secondaryContent instanceof \Illuminate\View\ComponentSlot ? $secondaryContent->isNotEmpty() : true);

    // Se houver conteúdo secundário/meta, força o alinhamento 'between' para separar blocos
    $resolvedAlign = $hasSecondary ? 'between' : $validAlign;

    $hasPrimaryActions = $slot->isNotEmpty();
@endphp

<{{ $validTag }}
    {{ $attributes->class([
        'ui-card-footer',
        "ui-card-footer--spacing-{$appliedSpacing}",
        "ui-card-footer--align-{$resolvedAlign}",
        'ui-card-footer--bordered' => $border,
        'ui-card-footer--flush' => $flush,
        'ui-card-footer--has-secondary' => $hasSecondary,
    ]) }}
>
    {{-- Conteúdo Secundário (Metadados, Paginação, Descrições à esquerda) --}}
    @if($hasSecondary)
        <div class="ui-card-footer__secondary">
            {{ $secondaryContent }}
        </div>
    @endif

    {{-- Ações Principais (Botões à direita/centro) --}}
    @if($hasPrimaryActions)
        <div class="ui-card-footer__actions">
            {{ $slot }}
        </div>
    @endif
</{{ $validTag }}>
