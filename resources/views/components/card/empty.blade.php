{{--
|--------------------------------------------------------------------------
| Card Empty State Component
|--------------------------------------------------------------------------
|
| Exibe estados vazios de forma elegante para tabelas, listas ou filtros.
| • Resolução unificada de conteúdos via props ou slots nomeados.
| • Nível de título hierárquico configurável ('titleTag') para acessibilidade WCAG.
| • Validação estrita de tamanhos ('sm', 'md', 'lg') e alinhamentos ('center', 'left', 'right').
| • Atributo 'role' configurável (default: 'status') para aviso automático a leitores de ecrã.
|
--}}

@props([
    'title' => null,
    'description' => null,
    'icon' => null,
    'action' => null,
    'size' => 'md',          // 'sm', 'md', 'lg'
    'align' => 'center',      // 'center', 'left', 'right'
    'titleTag' => 'h3',       // Tag semântica do título ('h1'-'h6', 'span', 'div', 'strong')
    'role' => 'status',       // Role ARIA para feedback acessível (ex: 'status', 'region')
])

@php
    // Validação de tamanhos e alinhamentos
    $allowedSizes = ['sm', 'md', 'lg'];
    $validSize = in_array(mb_strtolower($size), $allowedSizes, true) ? mb_strtolower($size) : 'md';

    $allowedAligns = ['center', 'left', 'right'];
    $validAlign = in_array(mb_strtolower($align), $allowedAligns, true) ? mb_strtolower($align) : 'center';

    // Validação da tag de título para respeitar a hierarquia de cabeçalhos WCAG
    $allowedTitleTags = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'span', 'div', 'strong'];
    $validTitleTag = in_array(mb_strtolower($titleTag), $allowedTitleTags, true) ? mb_strtolower($titleTag) : 'h3';

    // Resolução unificada de conteúdos (props ou slots nomeados)
    $iconContent = $icon ?? $iconSlot ?? null;
    $titleContent = $title ?? $titleSlot ?? null;
    $descriptionContent = $description ?? $descriptionSlot ?? null;
    $actionContent = $action ?? $actionSlot ?? null;
    $hasExtraSlot = $slot->isNotEmpty();

    // Atributos dinâmicos de acessibilidade
    $customAttributes = [];
    if (!empty($role)) {
        $customAttributes['role'] = $role;
    }
@endphp

<div
    {{ $attributes->merge($customAttributes)->class([
        'ui-card-empty',
        "ui-card-empty--{$validSize}",
        "ui-card-empty--align-{$validAlign}",
    ]) }}
>
    {{-- Ícone / Ilustração (Prop ou Slot) --}}
    @if($iconContent)
        <div class="ui-card-empty__icon" aria-hidden="true">
            @if(is_string($iconContent) && str_starts_with(trim($iconContent), '<svg'))
                {!! $iconContent !!}
            @else
                {{ $iconContent }}
            @endif
        </div>
    @endif

    {{-- Bloco de Textos (Título + Descrição) --}}
    @if($titleContent || $descriptionContent)
        <div class="ui-card-empty__content">
            @if($titleContent)
                <{{ $validTitleTag }} class="ui-card-empty__title">
                    {{ $titleContent }}
                </{{ $validTitleTag }}>
            @endif

            @if($descriptionContent)
                <p class="ui-card-empty__description">
                    {{ $descriptionContent }}
                </p>
            @endif
        </div>
    @endif

    {{-- Ações Rápidas (Prop ou Slot) --}}
    @if($actionContent)
        <div class="ui-card-empty__action">
            @if(is_string($actionContent) && (str_contains($actionContent, '<a') || str_contains($actionContent, '<button')))
                {!! $actionContent !!}
            @else
                {{ $actionContent }}
            @endif
        </div>
    @endif

    {{-- Elementos Extra Customizados --}}
    @if($hasExtraSlot)
        <div class="ui-card-empty__extra">
            {{ $slot }}
        </div>
    @endif
</div>
