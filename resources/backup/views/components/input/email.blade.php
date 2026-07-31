{{--
|--------------------------------------------------------------------------
| Email Input Component (Otimizado)
|--------------------------------------------------------------------------
|
| Campo de email com suporte a A11y (ARIA) e validação nativa Laravel.
| • Acessibilidade A11y (aria-invalid, aria-describedby).
| • Tratamento de erros automático.
|
--}}

@props([
    'name',
    'label' => null,
    'value' => null,
    'placeholder' => 'email@exemplo.com',
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'hint' => null,
    'icon' => true,
])

@php
    $hasError = $errors->has($name);
    $hintId = $hint ? "{$name}-hint" : null;
    $errorId = $hasError ? "{$name}-error" : null;
@endphp

<div class="ui-email">
    @if($label)
        <label for="{{ $name }}" class="ui-email__label">
            {{ $label }}
            @if($required) <span class="ui-email__required">*</span> @endif
        </label>
    @endif

    <div class="ui-email__wrapper">
        @if($icon)
            <span class="ui-email__icon" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </span>
        @endif

        <input
            id="{{ $name }}"
            name="{{ $name }}"
            type="email"
            value="{{ old($name, $value) }}"
            placeholder="{{ $placeholder }}"
            autocomplete="email"
            @class([
                'ui-email__input',
                'ui-email__input--error' => $hasError
            ])
            @required($required)
            @disabled($disabled)
            @readonly($readonly)
            aria-invalid="{{ $hasError ? 'true' : 'false' }}"
            aria-describedby="{{ $hasError ? $errorId : $hintId }}"
            {{ $attributes }}
        />
    </div>

    {{-- Feedback de Mensagens --}}
    @if($hasError)
        <p id="{{ $errorId }}" class="ui-email__error">{{ $errors->first($name) }}</p>
    @elseif($hint)
        <p id="{{ $hintId }}" class="ui-email__hint">{{ $hint }}</p>
    @endif
</div>
