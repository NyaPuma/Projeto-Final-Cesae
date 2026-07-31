{{--
|--------------------------------------------------------------------------
| Card Action Component (Otimizado)
|--------------------------------------------------------------------------
|
| Botão de ação reutilizável para cards de conteúdo.
| • Converte-se automaticamente de link para botão caso seja desativado.
| • Inclui spinner SVG nativo que herda a cor do tema.
| • Estrutura de tags dinâmica que previne quebra de código nas IDEs.
|
--}}

@props([
    'href' => null,
    'type' => 'button',
    'variant' => 'default',
    'size' => 'md',
    'icon' => null,
    'disabled' => false,
    'loading' => false,
])

@php
    // Decisão semântica: se tem link e não está desativado, é uma âncora.
    // Caso contrário, renderiza como um <button> nativo para segurança de acessibilidade.
    $tag = ($href && !$disabled) ? 'a' : 'button';

    // Atributos específicos baseados na tag selecionada
    $customAttributes = [];

    if ($tag === 'button') {
        $customAttributes['type'] = $type;
        if ($disabled || $loading) {
            $customAttributes['disabled'] = true;
        }
    } else {
        $customAttributes['href'] = $href;
    }

    if ($loading) {
        $customAttributes['aria-busy'] = 'true';
    }
@endphp

<{{ $tag }}
    {{ $attributes->merge($customAttributes)->class([
        'ui-card-action',
        "ui-card-action--{$variant}",
        "ui-card-action--{$size}",
        'ui-card-action--disabled' => $disabled,
        'ui-card-action--loading' => $loading,
    ]) }}
>
    {{-- Spinner de Carregamento --}}
    @if($loading)
        <span class="ui-card-action__loader" aria-hidden="true">
            <svg class="ui-card-action__spinner" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle class="ui-card-action__spinner-bg" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" style="opacity: 0.25;"></circle>
                <path class="ui-card-action__spinner-path" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" style="opacity: 0.75;"></path>
            </svg>
        </span>
        {{-- Texto alternativo para leitores de ecrã --}}
        <span class="sr-only">A processar...</span>
    @endif

    {{-- Ícone da Ação (ocultado se estiver a carregar para evitar sobreposição) --}}
    @if($icon && !$loading)
        <span class="ui-card-action__icon" aria-hidden="true">
            {!! $icon !!}
        </span>
    @endif

    {{-- Texto do Botão --}}
    <span class="ui-card-action__label">
        {{ $slot }}
    </span>
</{{ $tag }}>
