{{--
|--------------------------------------------------------------------------
| Card Header Component
|--------------------------------------------------------------------------
|
| Responsável pela área superior do card: organiza títulos, descrições e ações.
| • Tag HTML semântica customizável ('header', 'div', 'section') com validação.
| • Resolução unificada de conteúdos via props ou slots nomeados ($titleSlot, $actionsSlot, etc.).
| • Nível de título hierárquico configurável ('titleTag') para acessibilidade WCAG.
| • Suporte a alinhamento vertical flexível e remoção de paddings ('flush').
| • 100% livre de CSS ou JS inline.
|
--}}

@props([
    'title' => null,
    'description' => null,
    'icon' => null,
    'actions' => null,
    'spacing' => 'md',        // 'none', 'xs', 'sm', 'md', 'lg'
    'border' => true,         // Exibe uma linha divisória fina no fundo do cabeçalho
    'align' => 'center',      // 'start', 'center', 'end', 'baseline', 'stretch'
    'flush' => false,         // Remove paddings para colar nas bordas do card
    'tag' => 'header',        // Tag HTML semântica ('header', 'div', 'section')
    'titleTag' => 'h3',       // Tag semântica do título ('h1'-'h6', 'span', 'div', 'strong')
])

@php
    // Validação da tag HTML principal
    $allowedTags = ['header', 'div', 'section'];
    $validTag = in_array(mb_strtolower($tag), $allowedTags, true) ? mb_strtolower($tag) : 'header';

    // Validação da tag do título (hierarquia de cabeçalhos WCAG)
    $allowedTitleTags = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'span', 'div', 'strong'];
    $validTitleTag = in_array(mb_strtolower($titleTag), $allowedTitleTags, true) ? mb_strtolower($titleTag) : 'h3';

    // Validação de espaçamentos
    $allowedSpacings = ['none', 'xs', 'sm', 'md', 'lg'];
    $validSpacing = in_array(mb_strtolower($spacing), $allowedSpacings, true) ? mb_strtolower($spacing) : 'md';

    // Validação de alinhamentos verticais
    $allowedAligns = ['start', 'center', 'end', 'baseline', 'stretch'];
    $validAlign = in_array(mb_strtolower($align), $allowedAligns, true) ? mb_strtolower($align) : 'center';

    // Se a opção 'flush' for verdadeira, força o espaçamento para 'none'
    $appliedSpacing = $flush ? 'none' : $validSpacing;

    // Resolução unificada de conteúdos (props ou slots nomeados)
    $iconContent = $icon ?? $iconSlot ?? null;
    $titleContent = $title ?? $titleSlot ?? null;
    $descriptionContent = $description ?? $descriptionSlot ?? null;

    // Resolução flexível do slot/prop de ações
    $actionsContent = $actions ?? $actionsSlot ?? (isset($actions) && $actions instanceof \Illuminate\View\ComponentSlot ? $actions : null);
    $hasActions = !empty($actionsContent) && ($actionsContent instanceof \Illuminate\View\ComponentSlot ? $actionsContent->isNotEmpty() : true);

    $hasCustomBody = $slot->isNotEmpty();
    $hasLeadContent = $iconContent || $titleContent || $descriptionContent || $hasCustomBody;
@endphp

<{{ $validTag }}
    {{ $attributes->class([
        'ui-card-header',
        "ui-card-header--spacing-{$appliedSpacing}",
        "ui-card-header--align-{$validAlign}",
        'ui-card-header--bordered' => $border,
        'ui-card-header--flush' => $flush,
        'ui-card-header--has-actions' => $hasActions,
    ]) }}
>
    {{-- Bloco Principal (Ícone + Textos ou Corpo Customizado) --}}
    @if($hasLeadContent)
        <div class="ui-card-header__lead">
            {{-- Área do Ícone --}}
            @if($iconContent)
                <div class="ui-card-header__icon" aria-hidden="true">
                    @if(is_string($iconContent) && str_starts_with(trim($iconContent), '<svg'))
                        {!! $iconContent !!}
                    @else
                        {{ $iconContent }}
                    @endif
                </div>
            @endif

            {{-- Textos (Título e Descrição) ou Slot Livre --}}
            @if($titleContent || $descriptionContent || $hasCustomBody)
                <div class="ui-card-header__content">
                    @if($titleContent)
                        <{{ $validTitleTag }} class="ui-card-header__title">
                            {{ $titleContent }}
                        </{{ $validTitleTag }}>
                    @endif

                    @if($descriptionContent)
                        <p class="ui-card-header__description">
                            {{ $descriptionContent }}
                        </p>
                    @endif

                    {{-- Conteúdo Livre adicional passado no slot padrão --}}
                    @if($hasCustomBody)
                        <div class="ui-card-header__extra">
                            {{ $slot }}
                        </div>
                    @endif
                </div>
            @endif
        </div>
    @endif

    {{-- Slot de Ações (Alinhado ao lado oposto de forma automática) --}}
    @if($hasActions)
        <div class="ui-card-header__actions">
            {{ $actionsContent }}
        </div>
    @endif
</{{ $validTag }}>
