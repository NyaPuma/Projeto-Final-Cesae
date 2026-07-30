{{--
|--------------------------------------------------------------------------
| Card Timeline Container Component
|--------------------------------------------------------------------------
|
| Wrapper principal e contentor estrutural para itens de linha temporal.
| • Semântica A11y robusta baseada em listas de eventos (<ul> com role="list").
| • Tratamento automático e elegante para estados vazios (com texto customizável ou slot).
| • Suporte a posições flexíveis do conector ('left', 'right', 'alternate').
| • Cabeçalhos e tags HTML semânticas totalmente customizáveis.
| • 100% livre de CSS ou JS inline.
|
--}}

@props([
    'title' => null,                    // Título principal do bloco de histórico
    'position' => 'left',               // 'left', 'right', 'alternate'
    'line' => true,                     // Ativa ou desativa a linha vertical contínua
    'emptyText' => 'Nenhum registo de histórico disponível.', // Mensagem padrão de estado vazio
    'tag' => 'div',                     // Tag HTML principal ('div', 'section', 'article')
    'titleTag' => 'h3',                 // Tag HTML para o título ('h2', 'h3', 'h4', etc.)
])

@php
    // Validação da tag HTML principal
    $allowedTags = ['div', 'section', 'article'];
    $validTag = in_array(mb_strtolower($tag), $allowedTags, true) ? mb_strtolower($tag) : 'div';

    // Validação da tag do título
    $allowedTitleTags = ['h2', 'h3', 'h4', 'h5', 'h6'];
    $validTitleTag = in_array(mb_strtolower($titleTag), $allowedTitleTags, true) ? mb_strtolower($titleTag) : 'h3';

    // Validação de posições do conector
    $allowedPositions = ['left', 'right', 'alternate'];
    $validPosition = in_array(mb_strtolower($position), $allowedPositions, true) ? mb_strtolower($position) : 'left';

    // Resolução unificada de conteúdos e slots
    $titleContent = $title ?? $titleSlot ?? null;
    $emptyContent = $emptyText ?? $emptySlot ?? null;
@endphp

<{{ $validTag }}
    {{ $attributes->class([
        'ui-timeline',
        "ui-timeline--pos-{$validPosition}",
        'ui-timeline--has-line' => $line,
        'ui-timeline--is-empty' => $slot->isEmpty(),
    ]) }}
>
    {{-- Título da Timeline --}}
    @if($titleContent)
        <{{ $validTitleTag }} class="ui-timeline__title">
            {{ $titleContent }}
        </{{ $validTitleTag }}>
    @endif

    {{-- Lista de Eventos ou Estado Vazio --}}
    @if($slot->isNotEmpty())
        <ul class="ui-timeline__list" role="list">
            {{ $slot }}
        </ul>
    @else
        <div class="ui-timeline__empty" role="status">
            <div class="ui-timeline__empty-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
            </div>
            <p class="ui-timeline__empty-text">
                {{ $emptyContent }}
            </p>
        </div>
    @endif
</{{ $validTag }}>
