{{--
|--------------------------------------------------------------------------
| Floating Action Button (FAB) - Otimizado
|--------------------------------------------------------------------------
|
| Botão flutuante para ações principais da página.
| • Garante acessibilidade com tooltips e aria-labels automáticos.
| • Evita quebra de tags no IDE utilizando tags dinâmicas.
| • Tratamento robusto para estados desativados em âncoras (links).
|
--}}

@props([
    'href' => null,
    'type' => 'button',
    'icon' => null,
    'label' => null,
    'variant' => 'primary',
    'size' => 'md',
    'position' => 'bottom-right',
    'extended' => false,
    'fixed' => true,
    'disabled' => false,
])

@php
    // Determina se o elemento final será um link ou botão nativo
    $tag = $href ? 'a' : 'button';

    // Configuração dinâmica de atributos conforme o tipo de tag e acessibilidade
    $customAttributes = [];

    if ($tag === 'button') {
        $customAttributes['type'] = $type;
        if ($disabled) {
            $customAttributes['disabled'] = true;
        }
    } else {
        // Fallback seguro para âncoras desativadas
        if ($disabled) {
            $customAttributes['aria-disabled'] = 'true';
            $customAttributes['role'] = 'button';
            $customAttributes['tabindex'] = '-1';
        } else {
            $customAttributes['href'] = $href;
        }
    }

    // UX & Acessibilidade: Se não for estendido, o label vira aria-label e tooltip visual (title)
    if ($label) {
        if (!$extended) {
            $customAttributes['aria-label'] = $label;
            $customAttributes['title'] = $label;
        }
    }
@endphp

<{{ $tag }}
    {{ $attributes->merge($customAttributes)->class([
        'ui-fab',
        "ui-fab--{$variant}",
        "ui-fab--{$size}",
        "ui-fab--{$position}",
        'ui-fab--extended' => $extended,
        'ui-fab--fixed' => $fixed,
        'ui-fab--disabled' => $disabled,
    ]) }}
>
    {{-- Ícone do FAB --}}
    @if($icon)
        <span class="ui-fab__icon" aria-hidden="true">
            {!! $icon !!}
        </span>
    @endif

    {{-- Texto visível apenas se estiver no modo expandido --}}
    @if($extended && $label)
        <span class="ui-fab__label">
            {{ $label }}
        </span>
    @endif
</{{ $tag }}>
