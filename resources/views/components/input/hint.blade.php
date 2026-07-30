{{--
|--------------------------------------------------------------------------
| Input Hint Component
|--------------------------------------------------------------------------
|
| Exibe texto de ajuda ou descrições auxiliares abaixo dos inputs.
| • Variantes visuais rigorosamente validadas (default, warning, error, success, info).
| • Gestão dinâmica de ícones (padrão SVG incorporado ou HTML customizado via string).
| • Tratamento seguro de IDs opcionais para associação com aria-describedby.
| • 100% livre de CSS ou JS inline.
|
--}}

@props([
    'id' => null,
    'variant' => 'default', // default, warning, error, success, info
    'icon' => false,
])

@php
    // Validação estrita das variantes permitidas para evitar classes BEM inválidas
    $allowedVariants = ['default', 'warning', 'error', 'success', 'info'];
    $validVariant = in_array(mb_strtolower($variant), $allowedVariants, true) ? mb_strtolower($variant) : 'default';
@endphp

<p
    {{ $attributes->merge($id ? ['id' => $id] : [])->class([
        'ui-input-hint',
        "ui-input-hint--{$validVariant}",
    ]) }}
>
    @if($icon)
        <span class="ui-input-hint__icon" aria-hidden="true">
            @if($icon === true)
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="16" height="16">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                </svg>
            @else
                {!! $icon !!}
            @endif
        </span>
    @endif

    <span class="ui-input-hint__text">
        {{ $slot }}
    </span>
</p>
