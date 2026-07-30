{{--
|--------------------------------------------------------------------------
| Number Input Component
|--------------------------------------------------------------------------
|
| Campo numérico com controlo de incremento e decremento via Alpine.js.
| • Integração nativa com Request Validation e Old Input do Laravel.
| • Sanitização robusta de IDs para campos complexos (pontos e arrays).
| • Acessibilidade WCAG avançada (aria-label, aria-describedby, aria-invalid).
| • Controlo de limites (min, max, step) com tratamento de precisão numérica.
| • 100% livre de CSS ou JS inline.
|
--}}

@props([
    'id' => null,
    'name' => null,
    'label' => null,
    'value' => 0,
    'placeholder' => null,
    'min' => null,
    'max' => null,
    'step' => 1,
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'hint' => null,
    'error' => null,
])

@php
    // Sanitização segura do nome e geração de ID compatível com DOM
    $safeName = $name ?? '';
    $defaultId = $id ?? ($safeName ? str_replace(['.', '[', ']'], ['_', '', ''], $safeName) : 'number_' . uniqid());

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
    {{ $attributes->except(['id', 'name', 'type', 'value', 'placeholder', 'min', 'max', 'step', 'required', 'disabled', 'readonly'])->class([
        'ui-number',
        'ui-number--error' => $hasError,
        'ui-number--disabled' => $disabled,
        'ui-number--readonly' => $readonly,
    ]) }}
    x-data="{
        value: Number(@js($initialValue)),
        min: @js($min !== null ? (float)$min : null),
        max: @js($max !== null ? (float)$max : null),
        step: @js((float)$step),
        disabled: @js($disabled),
        readonly: @js($readonly),
        increase() {
            if (this.disabled || this.readonly) return;
            let next = this.value + this.step;
            if (this.max !== null && next > this.max) return;
            // Previne problemas de precisão de ponto flutuante (ex: 0.1 + 0.2)
            this.value = Number(next.toFixed(10));
        },
        decrease() {
            if (this.disabled || this.readonly) return;
            let next = this.value - this.step;
            if (this.min !== null && next < this.min) return;
            this.value = Number(next.toFixed(10));
        }
    }"
>
    @if($label)
        <label for="{{ $defaultId }}" class="ui-number__label">
            {{ $label }}
            @if($required)
                <span class="ui-number__required-marker" aria-hidden="true">*</span>
            @endif
        </label>
    @endif

    <div class="ui-number__wrapper">
        <button
            type="button"
            class="ui-number__button ui-number__button--decrease"
            @click="decrease()"
            @if($disabled || $readonly) disabled @endif
            aria-label="Decrementar valor"
        >
            <span aria-hidden="true">−</span>
        </button>

        <input
            x-model.number="value"
            id="{{ $defaultId }}"
            @if($safeName) name="{{ $safeName }}" @endif
            type="number"
            @if($placeholder) placeholder="{{ $placeholder }}" @endif
            @if($min !== null) min="{{ $min }}" @endif
            @if($max !== null) max="{{ $max }}" @endif
            step="{{ $step }}"
            class="ui-number__input @if($hasError) ui-number__input--error @enderror"
            @if($required) required @endif
            @if($readonly) readonly @endif
            @if($disabled) disabled @endif
            @if($hasError) aria-invalid="true" @else aria-invalid="false" @endif
            @if($describedBy) aria-describedby="{{ implode(' ', $describedBy) }}" @endif
            {{ $attributes->only(['id', 'name', 'type', 'value', 'placeholder', 'min', 'max', 'step', 'required', 'disabled', 'readonly']) }}
        >

        <button
            type="button"
            class="ui-number__button ui-number__button--increase"
            @click="increase()"
            @if($disabled || $readonly) disabled @endif
            aria-label="Incrementar valor"
        >
            <span aria-hidden="true">+</span>
        </button>
    </div>

    {{-- Dica de Ajuda (Hint) --}}
    @if($hint && !$hasError)
        <p id="{{ $hintId }}" class="ui-number__hint">{{ $hint }}</p>
    @endif

    {{-- Mensagem de Erro --}}
    @if($hasError)
        <p id="{{ $errorId }}" class="ui-number__error-message" role="alert">{{ $resolvedError }}</p>
    @endif
</div>
