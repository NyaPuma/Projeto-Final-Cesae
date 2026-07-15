{{--
|--------------------------------------------------------------------------
| Checkbox Component (Otimizado)
|--------------------------------------------------------------------------
|
| Checkbox com suporte a estados de validação e acessibilidade A11y.
| • ID dinâmico para ligações ARIA.
| • Suporte a hints e erros.
|
--}}

@props([
    'id' => null,
    'name',
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
    $id = $id ?? $name;
    $hasError = !!$error;
    $hasSuccess = !!$success;

    // Define os IDs para ARIA connections
    $hintId = $hint ? "{$id}-hint" : null;
    $errorId = $hasError ? "{$id}-error" : null;
    $successId = $hasSuccess ? "{$id}-success" : null;

    $describedBy = array_filter([$hintId, $errorId, $successId]);
@endphp

<div {{ $attributes->class([
    'ui-checkbox',
    'ui-checkbox--error' => $hasError,
    'ui-checkbox--success' => $hasSuccess,
]) }}>

    <label class="ui-checkbox__wrapper" for="{{ $id }}">
        <input
            id="{{ $id }}"
            class="ui-checkbox__input"
            type="checkbox"
            name="{{ $name }}"
            value="{{ $value }}"
            @checked($checked)
            @disabled($disabled)
            @required($required)
            @if($describedBy) aria-describedby="{{ implode(' ', $describedBy) }}" @endif
        >

        <span class="ui-checkbox__control" aria-hidden="true">
            <svg class="ui-checkbox__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </span>

        @if($label)
            <span class="ui-checkbox__label">{{ $label }}</span>
        @endif
    </label>

    {{-- Passamos os IDs para os componentes auxiliares para que o aria-describedby funcione --}}
    @if($hint)
        <x-ui.input.hint id="{{ $hintId }}">{{ $hint }}</x-ui.input.hint>
    @endif

    @if($hasError)
        <x-ui.input.error id="{{ $errorId }}">{{ $error }}</x-ui.input.error>
    @endif

    @if($hasSuccess)
        <x-ui.input.success id="{{ $successId }}">{{ $success }}</x-ui.input.success>
    @endif
</div>
