{{--
|--------------------------------------------------------------------------
| Telephone Input Component (Otimizado)
|--------------------------------------------------------------------------
|
| Campo especializado para números de telefone com suporte a prefixos.
|
--}}

@props([
    'name',
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
])

@php
    $id = $attributes->get('id', $name);
    $hasError = $errors->has($name);
    $hintId = $id . '-hint';
    $errorId = $id . '-error';
@endphp

<div class="ui-tel">
    @if($label)
        <label for="{{ $id }}" class="ui-tel__label">
            {{ $label }}
            @if($required) <span aria-hidden="true">*</span> @endif
        </label>
    @endif

    <div class="ui-tel__wrapper @class(['ui-tel__wrapper--error' => $hasError])">
        @if($icon)
            <span class="ui-tel__icon" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C10.163 21 3 13.837 3 5z"/>
                </svg>
            </span>
        @endif

        @if($prefix)
            <span class="ui-tel__prefix">{{ $prefix }}</span>
        @endif

        <input
            id="{{ $id }}"
            name="{{ $name }}"
            type="tel"
            value="{{ old($name, $value) }}"
            placeholder="{{ $placeholder }}"
            autocomplete="tel"
            @class(['ui-tel__input'])
            @if($mask) data-mask="phone" @endif
            @required($required)
            @disabled($disabled)
            @readonly($readonly)
            aria-describedby="{{ $hasError ? $errorId : ($hint ? $hintId : '') }}"
            {{ $attributes->except(['id', 'name', 'type', 'value', 'placeholder', 'class']) }}
        />
    </div>

    @if($hint && !$hasError)
        <p id="{{ $hintId }}" class="ui-tel__hint">{{ $hint }}</p>
    @endif

    @error($name)
        <p id="{{ $errorId }}" class="ui-tel__error">{{ $message }}</p>
    @enderror
</div>
