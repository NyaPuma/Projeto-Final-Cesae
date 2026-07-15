{{--
|--------------------------------------------------------------------------
| Range Input Component (Otimizado)
|--------------------------------------------------------------------------
|
| Slider de valor com binding reativo Alpine.js.
|
--}}

@props([
    'name',
    'label' => null,
    'value' => 50,
    'min' => 0,
    'max' => 100,
    'step' => 1,
    'showValue' => true,
    'hint' => null,
    'disabled' => false,
])

@php
    $id = $attributes->get('id', $name);
@endphp

<div class="ui-range" x-data="{ value: Number(@js(old($name, $value))) }">

    @if($label || $showValue)
        <div class="ui-range__header">
            @if($label)
                <label for="{{ $id }}" class="ui-range__label">
                    {{ $label }}
                </label>
            @endif

            @if($showValue)
                <span class="ui-range__value" x-text="value"></span>
            @endif
        </div>
    @endif

    <div class="ui-range__wrapper">
        <input
            type="range"
            id="{{ $id }}"
            name="{{ $name }}"
            min="{{ $min }}"
            max="{{ $max }}"
            step="{{ $step }}"
            x-model.number="value"
            @class(['ui-range__input', 'ui-range__input--disabled' => $disabled])
            @disabled($disabled)
            {{ $attributes->except(['id', 'name', 'type', 'min', 'max', 'step', 'class']) }}
            @if($hint) aria-describedby="{{ $id }}-hint" @endif
        />
    </div>

    @if($hint)
        <p id="{{ $id }}-hint" class="ui-range__hint">
            {{ $hint }}
        </p>
    @endif
</div>
