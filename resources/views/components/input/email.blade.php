{{--
|--------------------------------------------------------------------------
| Email Input Component
|--------------------------------------------------------------------------
|
| Campo de entrada de email com suporte a A11y (ARIA) e validação nativa Laravel.
| • Integração automática com Request Validation e Old Input do Laravel.
| • Sanitização robusta de IDs para campos complexos (pontos e arrays).
| • Acessibilidade WCAG avançada (aria-invalid, aria-describedby).
| • Suporte a ícones decorativos e estados dinâmicos (erro, desativado, readonly).
| • 100% livre de CSS ou JS inline.
|
--}}

@props([
    'id' => null,
    'name' => null,
    'label' => null,
    'value' => null,
    'placeholder' => 'email@exemplo.com',
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'hint' => null,
    'error' => null,
    'icon' => true,
])

@php
    // Sanitização segura do nome e geração de ID compatível com DOM (evita erros com notações como user.email)
    $safeName = $name ?? '';
    $defaultId = $id ?? ($safeName ? str_replace(['.', '[', ']'], ['_', '', ''], $safeName) : 'email_' . uniqid());

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

<div {{ $attributes->except(['id', 'name', 'type', 'value', 'placeholder', 'required', 'disabled', 'readonly', 'autocomplete'])->class([
    'ui-email',
    'ui-email--error' => $hasError,
    'ui-email--disabled' => $disabled,
    'ui-email--readonly' => $readonly,
]) }}>
    @if($label)
        <label for="{{ $defaultId }}" class="ui-email__label">
            {{ $label }}
            @if($required)
                <span class="ui-email__required-marker" aria-hidden="true">*</span>
            @endif
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
            id="{{ $defaultId }}"
            @if($safeName) name="{{ $safeName }}" @endif
            type="email"
            value="{{ $initialValue }}"
            placeholder="{{ $placeholder }}"
            autocomplete="email"
            class="ui-email__input @error($safeName) ui-email__input--error @enderror"
            @if($required) required @endif
            @if($disabled) disabled @endif
            @if($readonly) readonly @endif
            @if($hasError) aria-invalid="true" @else aria-invalid="false" @endif
            @if($describedBy) aria-describedby="{{ implode(' ', $describedBy) }}" @endif
            {{ $attributes->only(['id', 'name', 'type', 'value', 'placeholder', 'required', 'disabled', 'readonly', 'autocomplete']) }}
        >
    </div>

    {{-- Dica de Ajuda (Hint) --}}
    @if($hint)
        <p id="{{ $hintId }}" class="ui-email__hint">{{ $hint }}</p>
    @endif

    {{-- Mensagem de Erro do Laravel --}}
    @if($hasError)
        <p id="{{ $errorId }}" class="ui-email__error-message" role="alert">{{ $resolvedError }}</p>
    @endif
</div>
