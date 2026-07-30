{{--
|--------------------------------------------------------------------------
| Card Timeline Item Component
|--------------------------------------------------------------------------
|
| Item de histórico cronológico para fluxos, auditorias e atividades.
| • Conector de linha CSS integrado gerido por BEM (sem CSS inline).
| • Suporte a ícones customizados, dots e múltiplos estados/variantes.
| • Estrutura semântica flexível (compatível com tags <div>, <li> ou <article>).
| • Acessibilidade WCAG e suporte avançado à tag <time> com datetime machine-readable.
| • 100% livre de CSS ou JS inline.
|
--}}

@props([
    'title' => null,            // Título principal do evento
    'description' => null,      // Descrição textual do evento
    'date' => null,             // Texto ou valor da data visível ao utilizador
    'datetime' => null,         // Atributo técnico para a tag <time> (ex: 2026-07-30T14:21:00)
    'icon' => null,             // Ícone SVG ou HTML opcional para o marcador
    'status' => 'default',      // 'default', 'success', 'warning', 'danger', 'info', 'primary'
    'active' => false,          // Estado ativo ou em destaque
    'tag' => 'div',             // Tag HTML semântica ('div', 'li', 'article', 'section')
    'titleTag' => 'h4',         // Tag HTML para o título ('h4', 'h3', 'h5', 'strong', etc.)
])

@php
    // Validação da tag HTML principal
    $allowedTags = ['div', 'li', 'article', 'section'];
    $validTag = in_array(mb_strtolower($tag), $allowedTags, true) ? mb_strtolower($tag) : 'div';

    // Validação da tag do título
    $allowedTitleTags = ['h2', 'h3', 'h4', 'h5', 'h6', 'strong', 'span', 'div'];
    $validTitleTag = in_array(mb_strtolower($titleTag), $allowedTitleTags, true) ? mb_strtolower($titleTag) : 'h4';

    // Normalização e validação de status
    $normalizedStatus = match(mb_strtolower($status)) {
        'error', 'critical' => 'danger',
        'ok', 'complete' => 'success',
        'neutral' => 'default',
        default => mb_strtolower($status),
    };
    $allowedStatuses = ['default', 'success', 'warning', 'danger', 'info', 'primary'];
    $validStatus = in_array($normalizedStatus, $allowedStatuses, true) ? $normalizedStatus : 'default';

    // Resolução unificada de slots e propriedades
    $titleContent = $title ?? $titleSlot ?? null;
    $descriptionContent = $description ?? $descriptionSlot ?? null;
    $dateContent = $date ?? $dateSlot ?? null;
    $iconContent = $icon ?? $iconSlot ?? null;

    // Atributo datetime otimizado
    $machineDateTime = $datetime ?? (is_string($dateContent) ? $dateContent : null);
@endphp

<{{ $validTag }}
    {{ $attributes->class([
        'ui-timeline-item',
        "ui-timeline-item--status-{$validStatus}",
        'ui-timeline-item--active' => $active,
        'ui-timeline-item--has-icon' => !empty($iconContent),
    ]) }}
>
    {{-- Marcador (Ponto ou Ícone da Timeline) --}}
    <div class="ui-timeline-item__marker" aria-hidden="true">
        @if($iconContent)
            <div class="ui-timeline-item__icon">
                @if(is_string($iconContent) && str_starts_with(trim($iconContent), '<svg'))
                    {!! $iconContent !!}
                @else
                    {{ $iconContent }}
                @endif
            </div>
        @else
            <div class="ui-timeline-item__dot"></div>
        @endif
    </div>

    {{-- Bloco de Conteúdo --}}
    <div class="ui-timeline-item__content">
        @if($dateContent)
            <div class="ui-timeline-item__meta">
                <time class="ui-timeline-item__date" @if($machineDateTime) datetime="{{ $machineDateTime }}" @endif>
                    {{ $dateContent }}
                </time>
            </div>
        @endif

        @if($titleContent)
            <{{ $validTitleTag }} class="ui-timeline-item__title">
                {{ $titleContent }}
            </{{ $validTitleTag }}>
        @endif

        @if($descriptionContent || $slot->isNotEmpty())
            <div class="ui-timeline-item__body">
                @if($descriptionContent)
                    <p class="ui-timeline-item__description">
                        {{ $descriptionContent }}
                    </p>
                @endif

                {{ $slot }}
            </div>
        @endif
    </div>
</{{ $validTag }}>
