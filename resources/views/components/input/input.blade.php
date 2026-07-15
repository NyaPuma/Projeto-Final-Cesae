{{--
|--------------------------------------------------------------------------
| Input Component (Otimizado)
|--------------------------------------------------------------------------
|
| Campo de texto base com suporte a A11y, estados de erro e addons.
|
--}}

@props([
    'name',
    'label' => null,
    'value' => null,
    'placeholder' => null,
    'type' => 'text',
    'size' => 'md',
    'variant' => 'default',
    'icon' => null,
    'prefix' => null,
    'suffix' => null,
    'hint' => null,
    'required' => false,
    'readonly' => false,
    'disabled' => false,
    'loading' => false,
])

@php
    $id = $attributes->get('id', $name);
    $hasError = $errors->has($name);
    $errorId = "{$id}-error";
    $hintId = "{$id}-hint";
@endphp

<div class="ui-input-field">
    @if($label)
        <label for="{{ $id }}" class="ui-input-field__label">
            {{ $label }}
            @if($required) <span aria-hidden="true">*</span> @endif
        </label>
    @endif

    <div @class(['ui-input__wrapper', 'ui-input__wrapper--disabled' => $disabled])>
        @if($prefix)
            <span class="ui-input__prefix">{{ $prefix }}</span>
        @endif

        @if($icon)
            <span class="ui-input__icon" aria-hidden="true">{!! $icon !!}</span>
        @endif

        <input
            {{ $attributes->merge([
                'id' => $id,
                'name' => $name,
                'type' => $type,
                'value' => old($name, $value),
                'placeholder' => $placeholder,
            ])->class([
                'ui-input',
                "ui-input--{$size}",
                "ui-input--{$variant}",
                'ui-input--error' => $hasError,
                'ui-input--loading' => $loading,
            ]) }}
            @required($required)
            @readonly($readonly)
            @disabled($disabled)
            aria-invalid="{{ $hasError ? 'true' : 'false' }}"
            aria-describedby="{{ $hasError ? $errorId : ($hint ? $hintId : '') }}"
        >

        @if($loading)
            <span class="ui-input__loader" aria-hidden="true"></span>
        @endif

        @if($suffix)
            <span class="ui-input__suffix">{{ $suffix }}</span>
        @endif
    </div>

    {{-- Feedback de mensagens --}}
    @if($hasError)
        <p id="{{ $errorId }}" class="ui-input-field__error" role="alert">
            {{ $errors->first($name) }}
        </p>
    @elseif($hint)
        <p id="{{ $hintId }}" class="ui-input-field__hint">
            {{ $hint }}
        </p>
    @endif
</div>
