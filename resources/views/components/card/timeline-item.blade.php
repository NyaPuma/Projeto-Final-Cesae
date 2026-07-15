{{--
|--------------------------------------------------------------------------
| Card Timeline Item Component (Otimizado)
|--------------------------------------------------------------------------
|
| Item de histórico cronológico.
| • Conector de linha CSS integrado.
| • Suporte a ícones ou estados visuais.
|
--}}

@props([
    'title' => null,
    'description' => null,
    'date' => null,
    'icon' => null,
    'status' => 'default', // 'default', 'success', 'warning', 'danger'
    'active' => false,
])

<div {{ $attributes->class([
    'ui-timeline-item',
    "ui-timeline-item--{$status}",
    'ui-timeline-item--active' => $active,
]) }}>

    {{-- Marcador (Ponto da Timeline) --}}
    <div class="ui-timeline-item__marker">
        @if($icon)
            <div class="ui-timeline-item__icon">
                {!! $icon !!}
            </div>
        @else
            <div class="ui-timeline-item__dot"></div>
        @endif
    </div>

    {{-- Conteúdo --}}
    <div class="ui-timeline-item__content">
        @if($date)
            <time class="ui-timeline-item__date">{{ $date }}</time>
        @endif

        @if($title)
            <h4 class="ui-timeline-item__title">{{ $title }}</h4>
        @endif

        @if($description || $slot->isNotEmpty())
            <div class="ui-timeline-item__body">
                @if($description)
                    <p class="ui-timeline-item__description">{{ $description }}</p>
                @endif
                {{ $slot }}
            </div>
        @endif
    </div>
</div>
