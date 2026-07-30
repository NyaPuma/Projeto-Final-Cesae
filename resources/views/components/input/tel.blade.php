{{--
|--------------------------------------------------------------------------
| Telephone Input Component
|--------------------------------------------------------------------------
|
| Campo especializado para números de telefone com suporte a prefixos, prefixos visuais e A11y.
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
    'placeholder' => '+351 912 345 678',
    'prefix' => null,
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'hint' => null,
    'mask' => false,
    'icon' => true,
    'error' => null,
])

@php
    // Sanitização segura do nome e geração de ID compatível com DOM
    $safeName = $name ?? '';
    $defaultId = $id ?? ($safeName ? str_replace(['.', '[', ']'], ['_', '', ''], $safeName) : 'tel_' . uniqid());

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
    'ui-tel',
    'ui-tel--error' => $hasError,
    'ui-tel--disabled' => $disabled,
    'ui-tel--readonly' => $readonly,
]) }}>
    @if($label)
        <label for="{{ $defaultId }}" class="ui-tel__label">
            {{ $label }}
            @if($required)
                <span class="ui-tel__required-marker" aria-hidden="true">*</span>
            @endif
        </label>
    @endif

    <div class="ui-tel__wrapper @if($hasError) ui-tel__wrapper--error @enderror">
        @if($icon)
            <span class="ui-tel__icon" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C10.163 21 3 13.837 3 5z"/>
                </svg>
            </span>
        @endif

        @if($prefix)
            <span class="ui-tel__prefix" aria-hidden="true">{{ $prefix }}</span>
        @endif

        <input
            id="{{ $defaultId }}"
            @if($safeName) name="{{ $safeName }}" @endif
            type="tel"
            value="{{ $initialValue }}"
            @if($placeholder) placeholder="{{ $placeholder }}" @endif
            autocomplete="tel"
            class="ui-tel__input"
            @if($mask) data-mask="phone" @endif
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
        <p id="{{ $hintId }}" class="ui-tel__hint">{{ $hint }}</p>
    @endif

    {{-- Mensagem de Erro do Laravel --}}
    @if($hasError)
        <p id="{{ $errorId }}" class="ui-tel__error" role="alert">{{ $resolvedError }}</p>
    @endif
</div>
