{{--
|--------------------------------------------------------------------------
| Textarea Component (Otimizado)
|--------------------------------------------------------------------------
|
| Textarea reativo com contador de caracteres e suporte A11y.
|
--}}

@props([
    'name',
    'label' => null,
    'value' => null,
    'placeholder' => null,
    'rows' => 5,
    'maxlength' => null,
    'showCounter' => false,
    'resize' => 'vertical',
    'required' => false,
    'readonly' => false,
    'disabled' => false,
    'hint' => null,
])

@php
    $id = $attributes->get('id', $name);
    $hasError = $errors->has($name);
    $initialValue = old($name, $value);
@endphp

<div class="ui-textarea-field"
     x-data="{ length: '{{ strlen($initialValue) }}', maxLength: {{ $maxlength ?? 'null' }} }">

    @if($label)
        <label class="ui-textarea-field__label" for="{{ $id }}">
            {{ $label }}
            @if($required) <span aria-hidden="true">*</span> @endif
        </label>
    @endif

    <textarea
        id="{{ $id }}"
        name="{{ $name }}"
        rows="{{ $rows }}"
        placeholder="{{ $placeholder }}"
        x-on:input="length = $event.target.value.length"
        @class([
            'ui-textarea',
            'ui-textarea--' . $resize,
            'ui-textarea--error' => $hasError
        ])
        @required($required)
        @readonly($readonly)
        @disabled($disabled)
        @if($maxlength) maxlength="{{ $maxlength }}" @endif
        aria-describedby="{{ $hasError ? "{$id}-error" : ($hint ? "{$id}-hint" : '') }}"
        {{ $attributes->except(['id', 'name', 'rows', 'placeholder', 'class']) }}
    >{{ $initialValue }}</textarea>

    <div class="ui-textarea-field__footer">
        @if($hint && !$hasError)
            <p id="{{ $id }}-hint" class="ui-textarea-field__hint">{{ $hint }}</p>
        @endif

        @error($name)
            <p id="{{ $id }}-error" class="ui-textarea-field__error">{{ $message }}</p>
        @enderror

        @if($showCounter && $maxlength)
            <div class="ui-textarea-field__counter" aria-live="polite">
                <span x-text="length"></span> / <span x-text="maxLength"></span>
            </div>
        @endif
    </div>
</div>
