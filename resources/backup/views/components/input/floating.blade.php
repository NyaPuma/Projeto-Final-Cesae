{{--
|--------------------------------------------------------------------------
| Floating Label Input Component (Otimizado)
|--------------------------------------------------------------------------
|
| Input com label que flutua ao focar ou preencher.
| • Acessibilidade A11y (ARIA-describedby).
| • Suporte total a estados de erro.
|
--}}

@props([
    'name',
    'label',
    'type' => 'text',
    'value' => null,
    'placeholder' => ' ',
    'required' => false,
    'readonly' => false,
    'disabled' => false,
    'autocomplete' => null,
    'hint' => null,
])

@php
    $id = $attributes->get('id', $name);
    $hasError = $errors->has($name);
    $errorId = "{$id}-error";
    $hintId = "{$id}-hint";
@endphp

<div class="ui-floating {{ $hasError ? 'ui-floating--error' : '' }}">
    <input
        id="{{ $id }}"
        name="{{ $name }}"
        type="{{ $type }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        autocomplete="{{ $autocomplete }}"
        @class(['ui-floating__input', 'ui-floating__input--error' => $hasError])
        @required($required)
        @readonly($readonly)
        @disabled($disabled)
        aria-describedby="{{ $hasError ? $errorId : ($hint ? $hintId : '') }}"
        aria-invalid="{{ $hasError ? 'true' : 'false' }}"
        {{ $attributes->except(['id', 'name', 'type', 'placeholder', 'autocomplete', 'class']) }}
    >

    <label for="{{ $id }}" class="ui-floating__label">
        {{ $label }}
        @if($required) <span aria-hidden="true">*</span> @endif
    </label>

    @if($hint && !$hasError)
        <x-ui.input.hint id="{{ $hintId }}">{{ $hint }}</x-ui.input.hint>
    @endif

    @error($name)
        <x-ui.input.error id="{{ $errorId }}">{{ $message }}</x-ui.input.error>
    @enderror
</div>
