{{--
|--------------------------------------------------------------------------
| Color Input Component
|--------------------------------------------------------------------------
|
| Seletor de cor profissional com sincronização bidirecional HEX (Alpine.js).
| • Integração automática com Request Validation e Old Input do Laravel.
| • IDs dinâmicos e seguros (com tratamento preventivo para names com pontos ou arrays).
| • Ligações ARIA rigorosas (aria-describedby, aria-invalid, aria-label).
| • Sincronização visual em tempo real entre o seletor nativo e o campo de texto.
| • 100% livre de CSS ou JS inline.
|
--}}

@props([
    'id' => null,
    'name' => null,
    'label' => null,
    'value' => '#2563eb',
    'hint' => null,
    'error' => null,
    'required' => false,
    'disabled' => false,
])

@php
    // Sanitização segura do nome e geração de ID compatível com DOM
    $safeName = $name ?? '';
    $defaultId = $id ?? ($safeName ? str_replace(['.', '[', ']'], ['_', '', ''], $safeName) : 'color_' . uniqid());

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

<div {{ $attributes->except(['id', 'name', 'value', 'required', 'disabled'])->class([
    'ui-color',
    'ui-color--error' => $hasError,
    'ui-color--disabled' => $disabled,
]) }}
    x-data="{ color: @js($initialValue) }"
>
    @if($label)
        <label for="{{ $defaultId }}" class="ui-color__label">
            {{ $label }}
            @if($required)
                <span class="ui-color__required-marker" aria-hidden="true">*</span>
            @endif
        </label>
    @endif

    <div class="ui-color__wrapper">
        {{-- Seletor Visual Nativo (Color Picker) --}}
        <input
            type="color"
            x-model="color"
            class="ui-color__picker"
            @disabled($disabled)
            aria-label="Selecionador visual de cor para {{ $label ?? $safeName }}"
            tabindex="-1"
        >

        {{-- Input de Texto HEX --}}
        <input
            id="{{ $defaultId }}"
            @if($safeName) name="{{ $safeName }}" @endif
            type="text"
            x-model="color"
            class="ui-color__value @error($safeName) ui-color__value--error @enderror"
            maxlength="7"
            placeholder="#000000"
            @if($required) required @endif
            @if($disabled) disabled @endif
            @if($hasError) aria-invalid="true" @endif
            @if($describedBy) aria-describedby="{{ implode(' ', $describedBy) }}" @endif
            {{ $attributes->only(['id', 'name', 'value', 'required', 'disabled']) }}
        >
    </div>

    @if($hint)
        <p id="{{ $hintId }}" class="ui-color__hint">{{ $hint }}</p>
    @endif

    @if($hasError)
        <p id="{{ $errorId }}" class="ui-color__error-message" role="alert">{{ $resolvedError }}</p>
    @endif
</div>
