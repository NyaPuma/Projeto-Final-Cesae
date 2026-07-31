{{--
|--------------------------------------------------------------------------
| Password Input Component (Otimizado)
|--------------------------------------------------------------------------
|
| Input de palavra-passe com toggle de visibilidade e medidor de força.
|
--}}

@props([
    'name',
    'label' => 'Palavra-passe',
    'value' => null,
    'placeholder' => '••••••••',
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'autocomplete' => 'current-password',
    'showStrength' => false,
    'hint' => null,
])

@php
    $id = $attributes->get('id', $name);
    $hasError = $errors->has($name);
@endphp

<div
    class="ui-password"
    x-data="{
        show: false,
        strength: 0,
        get strengthClass() {
            if (this.strength === 0) return 'empty';
            if (this.strength < 3) return 'weak';
            if (this.strength < 4) return 'medium';
            return 'strong';
        },
        updateStrength(val) {
            let score = 0;
            if (val.length >= 8) score++;
            if (/[A-Z]/.test(val)) score++;
            if (/[a-z]/.test(val)) score++;
            if (/[0-9]/.test(val)) score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;
            this.strength = val ? score : 0;
        }
    }"
>
    @if($label)
        <label for="{{ $id }}" class="ui-password__label">
            {{ $label }}
            @if($required) <span aria-hidden="true">*</span> @endif
        </label>
    @endif

    <div class="ui-password__wrapper">
        <input
            x-ref="input"
            @input="updateStrength($refs.input.value)"
            id="{{ $id }}"
            name="{{ $name }}"
            :type="show ? 'text' : 'password'"
            value="{{ old($name, $value) }}"
            placeholder="{{ $placeholder }}"
            autocomplete="{{ $autocomplete }}"
            @class(['ui-password__input', 'ui-password__input--error' => $hasError])
            @required($required)
            @readonly($readonly)
            @disabled($disabled)
            aria-describedby="{{ $hasError ? "{$id}-error" : ($showStrength ? "{$id}-strength" : '') }}"
        >

        <button
            type="button"
            class="ui-password__toggle"
            @click="show = !show"
            :aria-label="show ? 'Ocultar palavra-passe' : 'Mostrar palavra-passe'"
        >
            {{-- Ícones SVG aqui (podes manter os teus originais) --}}
            <span x-show="!show">👁️</span>
            <span x-show="show" style="display:none">🙈</span>
        </button>
    </div>

    @if($showStrength)
        <div class="ui-password-strength" id="{{ $id }}-strength" aria-live="polite">
            <div class="ui-password-strength__bar" :class="strengthClass" :style="'width:' + (strength * 20) + '%'"></div>
        </div>
    @endif

    @error($name)
        <p id="{{ $id }}-error" class="ui-password__error">{{ $message }}</p>
    @enderror

    @if($hint && !$hasError)
        <p class="ui-password__hint">{{ $hint }}</p>
    @endif
</div>
