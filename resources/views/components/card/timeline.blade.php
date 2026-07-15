{{--
|--------------------------------------------------------------------------
| Card Timeline Container Component (Otimizado)
|--------------------------------------------------------------------------
|
| Wrapper principal para a linha temporal.
| • Semântica A11y (lista de eventos).
| • Tratamento automático para estados vazios.
| • Header opcional para títulos de histórico.
|
--}}

@props([
    'title' => null,
    'position' => 'left',
    'line' => true,
])

<div {{ $attributes->class([
    'ui-timeline',
    "ui-timeline--pos-{$position}",
    'ui-timeline--has-line' => $line,
]) }}>

    @if($title)
        <h3 class="ui-timeline__title">{{ $title }}</h3>
    @endif

    {{-- Se o slot estiver vazio, mostramos um aviso visual --}}
    @if($slot->isNotEmpty())
        <ul class="ui-timeline__list">
            {{ $slot }}
        </ul>
    @else
        <div class="ui-timeline__empty">
            <p>Nenhum registo de histórico disponível.</p>
        </div>
    @endif
</div>
