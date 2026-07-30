{{--
|--------------------------------------------------------------------------
| Input Component
|--------------------------------------------------------------------------
|
| Campo de texto base com suporte a A11y, estados de erro, loaders e addons.
| • Integração nativa com Request Validation e Old Input do Laravel.
| • Sanitização robusta de IDs para campos complexos (pontos e arrays).
| • Validação estrita de tamanhos e variantes BEM (sem classes arbitrárias).
| • Acessibilidade WCAG avançada (aria-invalid, aria-describedby).
| • 100% livre de CSS ou JS inline.
|
--}}

@props([
    'id' => null,
    'name' => null,
    'label' => null,
    'value' => null,
    'placeholder' => null,
    'type' => 'text',
    'size' => 'md',           // 'xs', 'sm', 'md', 'lg', 'xl'
    'variant' => 'default',   // 'default', 'primary', 'success', 'warning', 'error'
    'icon' => null,
    'prefix' => null,
    'suffix' => null,
    'hint' => null,
    'required' => false,
    'readonly' => false,
    'disabled' => false,
    'loading' => false,
    'error' => null,
])

@php
    // Sanitização segura do nome e geração de ID compatível com DOM
    $safeName = $name ?? '';
    $defaultId = $id ?? ($safeName ? str_replace(['.', '[', ']'], ['_', '', ''], $safeName) : 'input_' . uniqid());

    // Resolução automática de erros do Laravel caso a prop error não venha preenchida
    $laravelError = $safeName ? $errors->first($safeName) : null;
    $resolvedError = $error ?? $laravelError;
    $hasError = !empty($resolvedError);

    // Definição dos IDs para conexões ARIA
    $hintId = $hint ? "{$defaultId}-hint" : null;
    $errorId = $hasError ? "{$defaultId}-error" : null;
    $describedBy = array_filter([$hintId, $errorId]);

    // Valor inicial considerando o old input do Laravel
    $initialValue = $safeName ? old($safeName, $value) : $value;

    // Validação estrita de tamanhos
    $allowedSizes = ['xs', 'sm', 'md', 'lg', 'xl'];
    $validSize = in_array(mb_strtolower($size), $allowedSizes, true) ? mb_strtolower($size) : 'md';

    // Validação estrita de variantes
    $allowedVariants = ['default', 'primary', 'success', 'warning', 'error'];
    $validVariant = in_array(mb_strtolower($variant), $allowedVariants, true) ? mb_strtolower($variant) : 'default';
@endphp

<div {{ $attributes->except(['id', 'name', 'type', 'value', 'placeholder', 'required', 'readonly', 'disabled', 'autocomplete'])->class([
    'ui-input-field',
    'ui-input-field--error' => $hasError,
    'ui-input-field--disabled' => $disabled,
    'ui-input-field--readonly' => $readonly,
    'ui-input-field--loading' => $loading,
]) }}>
    @if($label)
        <label for="{{ $defaultId }}" class="ui-input-field__label">
            {{ $label }}
            @if($required)
                <span class="ui-input-field__required-marker" aria-hidden="true">*</span>
            @endif
        </label>
    @endif

    <div class="ui-input__wrapper @if($disabled) ui-input__wrapper--disabled @endif">
        @if($prefix)
            <span class="ui-input__prefix" aria-hidden="true">{{ $prefix }}</span>
        @endif

        @if($icon)
            <span class="ui-input__icon" aria-hidden="true">
                {!! $icon !!}
            </span>
        @endif

        <input
            id="{{ $defaultId }}"
            @if($safeName) name="{{ $safeName }}" @endif
            type="{{ $type }}"
            value="{{ $initialValue }}"
            @if($placeholder) placeholder="{{ $placeholder }}" @endif
            class="ui-input ui-input--size-{{ $validSize }} ui-input--variant-{{ $validVariant }} @if($hasError) ui-input--error @endif @if($loading) ui-input--loading @endif"
            @if($required) required @endif
            @if($readonly) readonly @endif
            @if($disabled) disabled @endif
            @if($hasError) aria-invalid="true" @else aria-invalid="false" @endif
            @if($describedBy) aria-describedby="{{ implode(' ', $describedBy) }}" @endif
            {{ $attributes->only(['id', 'name', 'type', 'value', 'placeholder', 'required', 'readonly', 'disabled', 'autocomplete']) }}
        >

        @if($loading)
            <span class="ui-input__loader" aria-hidden="true"></span>
        @endif

        @if($suffix)
            <span class="ui-input__suffix" aria-hidden="true">{{ $suffix }}</span>
        @endif
    </div>

    {{-- Dica de Ajuda (Hint) --}}
    @if($hint)
        <p id="{{ $hintId }}" class="ui-input-field__hint">{{ $hint }}</p>
    @endif

    {{-- Mensagem de Erro --}}
    @if($hasError)
        <p id="{{ $errorId }}" class="ui-input-field__error" role="alert">{{ $resolvedError }}</p>
    @endif
</div>
