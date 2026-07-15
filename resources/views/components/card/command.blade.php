{{--
|--------------------------------------------------------------------------
| Card Command Component (Otimizado)
|--------------------------------------------------------------------------
|
| Atalhos de ações rápidas com micro-interações e semântica avançada.
| • Tag HTML totalmente dinâmica (<a>, <button> ou <div>) conforme as props.
| • Detecção inteligente de eventos de clique para renderização de botões.
| • Seta de transição SVG que responde visualmente ao estado de hover.
|
--}}

@props([
    'title' => null,
    'description' => null,
    'icon' => null,
    'href' => null,
    'variant' => 'default', // 'default', 'primary', 'success', 'warning', 'danger', 'info'
    'disabled' => false,
    'tag' => null,           // Permite forçar manualmente uma tag (ex: 'li')
])

@php
    $isLink = !empty($href) && !$disabled;

    // Deteta se o utilizador adicionou escutas de clique JavaScript/Alpine
    $hasClick = $attributes->has('onclick') || $attributes->has('@click') || $attributes->has('x-on:click');

    // Resolve a tag HTML ideal e semântica
    $resolvedTag = $tag ?? ($isLink ? 'a' : ($hasClick ? 'button' : 'div'));

    // Define se o comando deve comportar-se como elemento focado e interativo
    $isInteractive = ($isLink || $hasClick || $resolvedTag === 'button' || $resolvedTag === 'a') && !$disabled;

    // Configura os atributos dinâmicos seguros
    $customAttributes = [];
    if ($isLink) {
        $customAttributes['href'] = $href;
    }
    if ($resolvedTag === 'button') {
        $customAttributes['type'] = 'button';
        if ($disabled) {
            $customAttributes['disabled'] = 'disabled';
        }
    }
    if ($isInteractive && $resolvedTag === 'div') {
        $customAttributes['role'] = 'button';
        $customAttributes['tabindex'] = '0';
    }
@endphp

<{{ $resolvedTag }}
    {{ $attributes->merge($customAttributes)->class([
        'ui-card-command',
        "ui-card-command--{$variant}",
        'ui-card-command--interactive' => $isInteractive,
        'ui-card-command--disabled' => $disabled,
    ]) }}
    @if($disabled && $resolvedTag !== 'button') aria-disabled="true" @endif
>
    {{-- Contentor do Ícone --}}
    @if($icon)
        <div class="ui-card-command__icon" aria-hidden="true">
            {!! $icon !!}
        </div>
    @endif

    {{-- Conteúdo (Título + Descrição) --}}
    <div class="ui-card-command__content">
        @if($title)
            <h3 class="ui-card-command__title">
                {{ $title }}
            </h3>
        @endif

        @if($description)
            <p class="ui-card-command__description">
                {{ $description }}
            </p>
        @endif
    </div>

    {{-- Seta Indicadora Interativa (SVG Moderno) --}}
    <div class="ui-card-command__arrow" aria-hidden="true">
        <svg viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
    </div>
</{{ $resolvedTag }}>
