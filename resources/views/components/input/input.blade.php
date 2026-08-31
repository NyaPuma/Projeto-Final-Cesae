{{--
|--------------------------------------------------------------------------
| Input Component
|--------------------------------------------------------------------------
| Text field with label, hint and validation (error) state.
| • 100% free of inline CSS or JS.
|--}}
@props([
    'id' => null,
    'name',
    'label' => null,
    'type' => 'text',
    'placeholder' => null,
    'required' => false,
    'hint' => null,
    'value' => null,
])

@php
    $fieldId = $id ?? str_replace(['.', '[', ']'], ['-', '', ''], $name);
    $errors = $errors ?? new \Illuminate\Support\ViewErrorBag;
    $hasError = $errors->has($name);
@endphp

<div {{ $attributes->merge(['class' => trim('ui-input-field' . ($hasError ? ' ui-input-field--error' : ''))]) }}>
    @if ($label)
        <label class="ui-input-field__label" for="{{ $fieldId }}">
            {{ $label }}
            @if ($required)<span class="ui-input-field__required" aria-hidden="true">*</span>@endif
        </label>
    @endif

    <input
        id="{{ $fieldId }}"
        name="{{ $name }}"
        type="{{ $type }}"
        value="{{ old($name, $value) }}"
        @if ($placeholder) placeholder="{{ $placeholder }}" @endif
        @if ($required) required @endif
        aria-invalid="{{ $hasError ? 'true' : 'false' }}"
        class="ui-input-field__control"
    >

    @if ($hint && ! $hasError)
        <p class="ui-input-field__hint">{{ $hint }}</p>
    @endif

    @if ($hasError)
        <p class="ui-input-field__error">{{ $errors->first($name) }}</p>
    @endif
</div>
