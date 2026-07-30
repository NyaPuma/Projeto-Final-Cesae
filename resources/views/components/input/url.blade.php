{{--
|--------------------------------------------------------------------------
| URL Input Component
|--------------------------------------------------------------------------
|
| Campo especializado para URLs com suporte a validação HTML5 e A11y.
| • 100% livre de CSS ou JS inline.
| • Sanitização robusta de IDs para campos complexos (pontos e arrays).
| • Integração nativa com Request Validation e Old Input do Laravel.
| • Acessibilidade WCAG avançada (aria-invalid, aria-describedby).
|
--}}

@props([
    'id' => null,
    'name' => null,
    'label' => null,
    'value' => null,
    'placeholder' => 'https://exemplo.com',
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'hint' => null,
    'icon' => true,
    'error' => null,
])

@php
    // Sanitização segura do nome e geração de ID compatível com DOM
    $safeName = $name ?? '';
    $defaultId = $id ?? ($safeName ? str_replace(['.', '[', ']'], ['_', '', ''], $safeName) : 'url_' . uniqid());

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
@endphp

<div {{ $attributes->except(['id', 'name', 'type', 'value', 'placeholder', 'required', 'disabled', 'readonly'])->class([
    'ui-url',
    'ui-url--error' => $hasError,
    'ui-url--disabled' => $disabled,
    'ui-url--readonly' => $readonly,
]) }}>
    @if($label)
        <label for="{{ $defaultId }}" class="ui-url__label">
            {{ $label }}
            @if($required)
                <span class="ui-url__required-marker" aria-hidden="true">*</span>
            @endif
        </label>
    @endif

    <div class="ui-url__wrapper @if($hasError) ui-url__wrapper--error @enderror">
        @if($icon)
            <span class="ui-url__icon" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 010 5.656l-4 4a4 4 0 01-5.656-5.656l1.172-1.172m9.314-4.314a4 4 0 010-5.656l4-4a4 4 0 015.656 5.656l-1.172 1.172M8 12h8" />
                </svg>
            </span>
        @endif

        <input
            id="{{ $defaultId }}"
            @if($safeName) name="{{ $safeName }}" @endif
            type="url"
            value="{{ $initialValue }}"
            @if($placeholder) placeholder="{{ $placeholder }}" @endif
            autocomplete="url"
            class="ui-url__input"
            @if($required) required @endif
            @if($disabled) disabled @endif
            @if($readonly) readonly @endif
            @if($hasError) aria-invalid="true" @else aria-invalid="false" @endif
            @if($describedBy) aria-describedby="{{ implode(' ', $describedBy) }}" @endif
            {{ $attributes->only(['id', 'name', 'type', 'value', 'placeholder', 'required', 'disabled', 'readonly']) }}
        />
    </div>

    {{-- Dica de Ajuda (Hint) --}}
    @if($hint && !$hasError)
        <p id="{{ $hintId }}" class="ui-url__hint">{{ $hint }}</p>
    @endif

    {{-- Mensagem de Erro do Laravel --}}
    @if($hasError)
        <p id="{{ $errorId }}" class="ui-url__error" role="alert">{{ $resolvedError }}</p>
    @endif
</div>
