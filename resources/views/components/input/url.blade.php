{{--
|--------------------------------------------------------------------------
| URL Input Component (Otimizado)
|--------------------------------------------------------------------------
|
| Campo especializado para URLs com suporte a validação HTML5.
|
--}}

@props([
    'name',
    'label' => null,
    'value' => null,
    'placeholder' => 'https://exemplo.com',
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'hint' => null,
    'icon' => true,
])

@php
    $id = $attributes->get('id', $name);
    $hasError = $errors->has($name);
    $hintId = $id . '-hint';
    $errorId = $id . '-error';
@endphp

<div class="ui-url">
    @if($label)
        <label for="{{ $id }}" class="ui-url__label">
            {{ $label }}
            @if($required) <span aria-hidden="true">*</span> @endif
        </label>
    @endif

    <div @class(['ui-url__wrapper', 'ui-url__wrapper--error' => $hasError])>
        @if($icon)
            <span class="ui-url__icon" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 010 5.656l-4 4a4 4 0 01-5.656-5.656l1.172-1.172m9.314-4.314a4 4 0 010-5.656l4-4a4 4 0 015.656 5.656l-1.172 1.172M8 12h8" />
                </svg>
            </span>
        @endif

        <input
            id="{{ $id }}"
            name="{{ $name }}"
            type="url"
            value="{{ old($name, $value) }}"
            placeholder="{{ $placeholder }}"
            autocomplete="url"
            @class(['ui-url__input'])
            @required($required)
            @disabled($disabled)
            @readonly($readonly)
            aria-describedby="{{ $hasError ? $errorId : ($hint ? $hintId : '') }}"
            {{ $attributes->except(['id', 'name', 'type', 'value', 'placeholder', 'class']) }}
        />
    </div>

    @if($hint && !$hasError)
        <p id="{{ $hintId }}" class="ui-url__hint">{{ $hint }}</p>
    @endif

    @error($name)
        <p id="{{ $errorId }}" class="ui-url__error">{{ $message }}</p>
    @enderror
</div>
