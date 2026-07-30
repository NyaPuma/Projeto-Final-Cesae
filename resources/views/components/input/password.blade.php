{{--
|--------------------------------------------------------------------------
| Password Input Component
|--------------------------------------------------------------------------
|
| Input de palavra-passe com alternância de visibilidade (toggle) e medidor de força reativo.
| • 100% livre de CSS ou JS inline (sem estilos embutidos ou atributos style hardcoded).
| • Sanitização robusta de IDs para campos complexos (pontos e arrays).
| • Suporte integrado a old input do Laravel, validação e acessibilidade WCAG.
|
--}}

@props([
    'id' => null,
    'name' => 'password',
    'label' => 'Palavra-passe',
    'value' => null,
    'placeholder' => '••••••••',
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'autocomplete' => 'current-password',
    'showStrength' => false,
    'hint' => null,
    'error' => null,
])

@php
    // Sanitização segura do nome e geração de ID compatível com DOM
    $safeName = $name ?? '';
    $defaultId = $id ?? ($safeName ? str_replace(['.', '[', ']'], ['_', '', ''], $safeName) : 'password_' . uniqid());

    // Resolução automática de erros do Laravel caso a prop error não venha preenchida
    $laravelError = $safeName ? $errors->first($safeName) : null;
    $resolvedError = $error ?? $laravelError;
    $hasError = !empty($resolvedError);

    // Definição dos IDs para conexões ARIA
    $hintId = $hint ? "{$defaultId}-hint" : null;
    $errorId = $hasError ? "{$defaultId}-error" : null;
    $strengthId = $showStrength ? "{$defaultId}-strength" : null;
    $describedBy = array_filter([$hintId, $errorId, $strengthId]);

    // Valor inicial considerando o old input do Laravel
    $initialValue = $safeName ? old($safeName, $value) : $value;
@endphp

<div
    {{ $attributes->except(['id', 'name', 'type', 'value', 'placeholder', 'autocomplete', 'required', 'disabled', 'readonly'])->class([
        'ui-password',
        'ui-password--error' => $hasError,
        'ui-password--disabled' => $disabled,
        'ui-password--readonly' => $readonly,
    ]) }}
    x-data="{
        show: false,
        value: @js($initialValue ?? ''),
        strength: 0,
        get strengthClass() {
            if (this.strength === 0) return 'ui-password-strength__bar--empty';
            if (this.strength < 3) return 'ui-password-strength__bar--weak';
            if (this.strength < 4) return 'ui-password-strength__bar--medium';
            return 'ui-password-strength__bar--strong';
        },
        updateStrength(val) {
            let score = 0;
            if (!val) {
                this.strength = 0;
                return;
            }
            if (val.length >= 8) score++;
            if (/[A-Z]/.test(val)) score++;
            if (/[a-z]/.test(val)) score++;
            if (/[0-9]/.test(val)) score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;
            this.strength = score;
        },
        init() {
            this.updateStrength(this.value);
        }
    }"
    x-init="init()"
>
    @if($label)
        <label for="{{ $defaultId }}" class="ui-password__label">
            {{ $label }}
            @if($required)
                <span class="ui-password__required-marker" aria-hidden="true">*</span>
            @endif
        </label>
    @endif

    <div class="ui-password__wrapper">
        <input
            x-model="value"
            @input="updateStrength(value)"
            id="{{ $defaultId }}"
            @if($safeName) name="{{ $safeName }}" @endif
            :type="show ? 'text' : 'password'"
            @if($placeholder) placeholder="{{ $placeholder }}" @endif
            @if($autocomplete) autocomplete="{{ $autocomplete }}" @endif
            class="ui-password__input @if($hasError) ui-password__input--error @enderror"
            @if($required) required @endif
            @if($readonly) readonly @endif
            @if($disabled) disabled @endif
            @if($hasError) aria-invalid="true" @else aria-invalid="false" @endif
            @if($describedBy) aria-describedby="{{ implode(' ', $describedBy) }}" @endif
            {{ $attributes->only(['id', 'name', 'type', 'value', 'placeholder', 'autocomplete', 'required', 'disabled', 'readonly']) }}
        >

        <button
            type="button"
            class="ui-password__toggle"
            @click="show = !show"
            :aria-label="show ? 'Ocultar palavra-passe' : 'Mostrar palavra-passe'"
            @if($disabled || $readonly) disabled @endif
        >
            {{-- Ícones controlados puramente por classes BEM e atributos hidden/x-cloak (Sem estilos inline) --}}
            <span class="ui-password__icon ui-password__icon--show" :class="{ 'ui-password__icon--hidden': show }" aria-hidden="true">👁️</span>
            <span class="ui-password__icon ui-password__icon--hide" :class="{ 'ui-password__icon--hidden': !show }" aria-hidden="true" x-cloak>🙈</span>
        </button>
    </div>

    {{-- Medidor de Força da Palavra-passe --}}
    @if($showStrength)
        <div id="{{ $strengthId }}" class="ui-password-strength" aria-live="polite" aria-label="Medidor de força da palavra-passe">
            <div
                class="ui-password-strength__bar"
                :class="strengthClass"
                :data-strength="strength"
            ></div>
        </div>
    @endif

    {{-- Dica de Ajuda (Hint) --}}
    @if($hint && !$hasError)
        <p id="{{ $hintId }}" class="ui-password__hint">{{ $hint }}</p>
    @endif

    {{-- Mensagem de Erro do Laravel --}}
    @if($hasError)
        <p id="{{ $errorId }}" class="ui-password__error-message" role="alert">{{ $resolvedError }}</p>
    @endif
</div>
