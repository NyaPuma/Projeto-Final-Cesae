{{--
|--------------------------------------------------------------------------
| Button Group Component
|--------------------------------------------------------------------------
|
| Agrupa vários botões numa única unidade visual e semântica.
| • Cumpre as diretrizes ARIA (role="group" dinâmico e aria-label).
| • Tag HTML customizável para maior semântica (<nav>, <div>, etc.).
| • Permite o controlo de tamanhos e layout por cascata CSS.
|
--}}

@props([
    'direction' => 'horizontal', // 'horizontal' ou 'vertical'
    'attached' => true,          // Une os botões removendo margens e cantos internos
    'size' => 'md',              // 'sm', 'md', 'lg'
    'fullWidth' => false,        // Ocupa 100% da largura do container
    'label' => null,             // Nome acessível para leitores de ecrã
    'tag' => 'div',              // Tag HTML do container ('div', 'nav', etc.)
])

@php
    $customAttributes = [];

    // O elemento <nav> já possui um papel semântico implícito no HTML5;
    // para outras tags (como 'div'), aplicamos role="group" por padrão.
    if ($tag !== 'nav') {
        $customAttributes['role'] = 'group';
    }

    // Define aria-label a menos que já tenha sido passado explicitamente via $attributes
    if ($label && ! $attributes->has('aria-label')) {
        $customAttributes['aria-label'] = $label;
    }
@endphp

<{{ $tag }}
    {{ $attributes->merge($customAttributes)->class([
        'ui-button-group',
        "ui-button-group--{$direction}",
        "ui-button-group--{$size}",
        'ui-button-group--attached' => $attached,
        'ui-button-group--block' => $fullWidth,
    ]) }}
>
    {{ $slot }}
</{{ $tag }}>
