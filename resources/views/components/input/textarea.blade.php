{{--
|--------------------------------------------------------------------------
| Textarea Component
|--------------------------------------------------------------------------
|
| Textarea reativo com contador de caracteres dinâmico, suporte a validação e A11y.
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
    'placeholder' => null,
    'rows' => 5,
    'maxlength' => null,
    'showCounter' => false,
    'resize' => 'vertical', // vertical, horizontal, none, both
    'required' => false,
    'readonly' => false,
    'disabled' => false,
    'hint' => null,
    'error' => null,
])

@php
    // Sanitização segura do nome e geração de ID compatível com DOM
    $safeName = $name ?? '';
    $defaultId = $id ?? ($safeName ? str_replace(['.', '[', ']'], ['_', '', ''], $safeName) : 'textarea_' . uniqid());

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

<div
    {{ $attributes->except(['id', 'name', 'rows', 'placeholder', 'maxlength', 'required', 'readonly', 'disabled'])->class([
        'ui-textarea-field',
        'ui-textarea-field--error' => $hasError,
        'ui-textarea-field--disabled' => $disabled,
        'ui-textarea-field--readonly' => $readonly,
    ]) }}
    x-data="{
        value: @js($initialValue ?? ''),
        get length() {
            return this.value ? this.value.length : 0;
        }
    }"
>
    @if($label)
        <label for="{{ $defaultId }}" class="ui-textarea-field__label">
            {{ $label }}
            @if($required)
                <span class="ui-textarea-field__required-marker" aria-hidden="true">*</span>
            @endif
        </label>
    @endif

    <textarea
        id="{{ $defaultId }}"
        @if($safeName) name="{{ $safeName }}" @endif
        rows="{{ $rows }}"
        @if($placeholder) placeholder="{{ $placeholder }}" @endif
        x-model="value"
        class="ui-textarea ui-textarea--{{ $resize }} @if($hasError) ui-textarea--error @enderror"
        @if($required) required @endif
        @if($readonly) readonly @endif
        @if($disabled) disabled @endif
        @if($maxlength) maxlength="{{ $maxlength }}" @endif
        @if($hasError) aria-invalid="true" @else aria-invalid="false" @endif
        @if($describedBy) aria-describedby="{{ implode(' ', $describedBy) }}" @endif
        {{ $attributes->only(['id', 'name', 'rows', 'placeholder', 'maxlength', 'required', 'readonly', 'disabled']) }}
    ></textarea>

    <div class="ui-textarea-field__footer">
        <div class="ui-textarea-field__messages">
            {{-- Dica de Ajuda (Hint) --}}
            @if($hint && !$hasError)
                <p id="{{ $hintId }}" class="ui-textarea-field__hint">{{ $hint }}</p>
            @endif

            {{-- Mensagem de Erro do Laravel --}}
            @if($hasError)
                <p id="{{ $errorId }}" class="ui-textarea-field__error-message" role="alert">{{ $resolvedError }}</p>
            @endif
        </div>

        {{-- Contador de Caracteres Reativo --}}
        @if($showCounter && $maxlength)
            <div class="ui-textarea-field__counter" aria-live="polite">
                <span x-text="length"></span> / {{ $maxlength }}
            </div>
        @endif
    </div>
</div>
