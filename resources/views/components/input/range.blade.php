{{--
|--------------------------------------------------------------------------
| Range Input Component
|--------------------------------------------------------------------------
|
| Slider de valor com binding reativo Alpine.js e suporte completo a A11y.
| • 100% livre de CSS ou JS inline.
| • Sanitização robusta de IDs para campos complexos (pontos e arrays).
| • Integração nativa com Request Validation e Old Input do Laravel.
| • Acessibilidade WCAG avançada (aria-invalid, aria-describedby, aria-label).
|
--}}

@props([
    'id' => null,
    'name' => null,
    'label' => null,
    'value' => 50,
    'min' => 0,
    'max' => 100,
    'step' => 1,
    'showValue' => true,
    'hint' => null,
    'disabled' => false,
    'error' => null,
])

@php
    // Sanitização segura do nome e geração de ID compatível com DOM
    $safeName = $name ?? '';
    $defaultId = $id ?? ($safeName ? str_replace(['.', '[', ']'], ['_', '', ''], $safeName) : 'range_' . uniqid());

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
    {{ $attributes->except(['id', 'name', 'type', 'min', 'max', 'step', 'value', 'disabled'])->class([
        'ui-range',
        'ui-range--error' => $hasError,
        'ui-range--disabled' => $disabled,
    ]) }}
    x-data="{ value: Number(@js($initialValue)) }"
>
    @if($label || $showValue)
        <div class="ui-range__header">
            @if($label)
                <label for="{{ $defaultId }}" class="ui-range__label">
                    {{ $label }}
                </label>
            @endif

            @if($showValue)
                <span class="ui-range__value" x-text="value" aria-hidden="true"></span>
            @endif
        </div>
    @endif

    <div class="ui-range__wrapper">
        <input
            type="range"
            id="{{ $defaultId }}"
            @if($safeName) name="{{ $safeName }}" @endif
            min="{{ $min }}"
            max="{{ $max }}"
            step="{{ $step }}"
            x-model.number="value"
            class="ui-range__input @if($hasError) ui-range__input--error @enderror"
            @if($disabled) disabled @endif
            @if($hasError) aria-invalid="true" @else aria-invalid="false" @endif
            @if($describedBy) aria-describedby="{{ implode(' ', $describedBy) }}" @endif
            {{ $attributes->only(['id', 'name', 'type', 'min', 'max', 'step', 'value', 'disabled']) }}
        >
    </div>

    {{-- Dica de Ajuda (Hint) --}}
    @if($hint && !$hasError)
        <p id="{{ $hintId }}" class="ui-range__hint">
            {{ $hint }}
        </p>
    @endif

    {{-- Mensagem de Erro do Laravel --}}
    @if($hasError)
        <p id="{{ $errorId }}" class="ui-range__error-message" role="alert">
            {{ $resolvedError }}
        </p>
    @endif
</div>
