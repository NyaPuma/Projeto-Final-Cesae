{{--
|--------------------------------------------------------------------------
| Checkbox Component
|--------------------------------------------------------------------------
|
| Componente de caixa de seleção (checkbox) com suporte a estados de validação e A11y.
| • Integração automática com o Request Validation e Old Input do Laravel.
| • IDs dinâmicos e seguros (com tratamento preventivo para names com pontos ou arrays).
| • Ligações ARIA rigorosas (aria-describedby, aria-invalid).
| • Suporte híbrido a rótulos via prop ou slot (permite links e HTML customizado).
| • 100% livre de CSS ou JS inline.
|
--}}

@props([
    'id' => null,
    'name' => null,
    'label' => null,
    'hint' => null,
    'error' => null,
    'success' => null,
    'checked' => false,
    'disabled' => false,
    'required' => false,
    'value' => '1',
])

@php
    // Sanitização segura do nome e geração de ID compatível com DOM (evita erros com notações como user.terms)
    $safeName = $name ?? '';
    $defaultId = $id ?? ($safeName ? str_replace(['.', '[', ']'], ['_', '', ''], $safeName) : 'checkbox_' . uniqid());

    // Resolução automática de erros do Laravel caso a prop error não venha preenchida
    $laravelError = $safeName ? $errors->first($safeName) : null;
    $resolvedError = $error ?? $laravelError;

    $hasError = !empty($resolvedError);
    $hasSuccess = !empty($success);

    // Definição dos IDs para conexões ARIA
    $hintId = $hint ? "{$defaultId}-hint" : null;
    $errorId = $hasError ? "{$defaultId}-error" : null;
    $successId = $hasSuccess ? "{$defaultId}-success" : null;

    $describedBy = array_filter([$hintId, $errorId, $successId]);

    // Resolução de conteúdo do rótulo (prop label ou corpo do slot)
    $labelContent = $label ?? ($slot->isNotEmpty() ? $slot : null);

    // Determina se o checkbox deve vir marcado (considerando o estado old do Laravel)
    $isOldChecked = $safeName ? old($safeName, $checked) : $checked;
    $isChecked = filter_var($isOldChecked, FILTER_VALIDATE_BOOLEAN) || (string) old($safeName) === (string) $value;
@endphp

<div {{ $attributes->except(['id', 'name', 'value', 'checked', 'disabled', 'required'])->class([
    'ui-checkbox',
    'ui-checkbox--error' => $hasError,
    'ui-checkbox--success' => $hasSuccess,
    'ui-checkbox--disabled' => $disabled,
]) }}>

    <label class="ui-checkbox__wrapper" for="{{ $defaultId }}">
        <input
            id="{{ $defaultId }}"
            class="ui-checkbox__input"
            type="checkbox"
            @if($safeName) name="{{ $safeName }}" @endif
            value="{{ $value }}"
            @checked($isChecked)
            @disabled($disabled)
            @required($required)
            @if($hasError) aria-invalid="true" @endif
            @if($describedBy) aria-describedby="{{ implode(' ', $describedBy) }}" @endif
            {{ $attributes->only(['id', 'name', 'value', 'checked', 'disabled', 'required']) }}
        >

        <span class="ui-checkbox__control" aria-hidden="true">
            <svg class="ui-checkbox__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </span>

        @if($labelContent)
            <span class="ui-checkbox__label">{{ $labelContent }}</span>
        @endif
    </label>

    {{-- Componentes auxiliares conectados por ARIA --}}
    @if($hint)
        <x-ui.input.hint id="{{ $hintId }}">{{ $hint }}</x-ui.input.hint>
    @endif

    @if($hasError)
        <x-ui.input.error id="{{ $errorId }}">{{ $resolvedError }}</x-ui.input.error>
    @endif

    @if($hasSuccess)
        <x-ui.input.success id="{{ $successId }}">{{ $success }}</x-ui.input.success>
    @endif
</div>
