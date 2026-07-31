{{--
|--------------------------------------------------------------------------
| Number Input Component (Otimizado)
|--------------------------------------------------------------------------
|
| Campo numérico com controlo de incremento e decremento.
| • x-model para two-way binding.
| • Acessibilidade A11y (aria-label, aria-describedby).
|
--}}

@props([
    'name',
    'label' => null,
    'value' => 0,
    'placeholder' => null,
    'min' => null,
    'max' => null,
    'step' => 1,
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'hint' => null,
])

@php
    $hasError = $errors->has($name);
    $id = $attributes->get('id', $name);
@endphp

<div class="ui-number"
    x-data="{
        value: Number(@js(old($name, $value) ?? 0)),
        increase() {
            let max = {{ $max ?? 'null' }};
            let next = this.value + {{ $step }};
            if (max !== null && next > max) return;
            this.value = next;
        },
        decrease() {
            let min = {{ $min ?? 'null' }};
            let next = this.value - {{ $step }};
            if (min !== null && next < min) return;
            this.value = next;
        }
    }"
>
    @if($label)
        <label for="{{ $id }}" class="ui-number__label">
            {{ $label }}
            @if($required) <span aria-hidden="true">*</span> @endif
        </label>
    @endif

    <div class="ui-number__wrapper">
        <button
            type="button"
            class="ui-number__button"
            @click="decrease()"
            @disabled($disabled || $readonly)
            aria-label="Decrementar valor"
        >−</button>

        <input
            x-model.number="value"
            id="{{ $id }}"
            name="{{ $name }}"
            type="number"
            placeholder="{{ $placeholder }}"
            min="{{ $min }}"
            max="{{ $max }}"
            step="{{ $step }}"
            @class([
                'ui-number__input',
                'ui-number__input--error' => $hasError
            ])
            @required($required)
            @disabled($disabled)
            @readonly($readonly)
            {{ $attributes->except(['id', 'name', 'type', 'placeholder', 'min', 'max', 'step', 'class']) }}
        >

        <button
            type="button"
            class="ui-number__button"
            @click="increase()"
            @disabled($disabled || $readonly)
            aria-label="Incrementar valor"
        >+</button>
    </div>

    @if($hasError)
        <x-ui.input.error :name="$name" />
    @elseif($hint)
        <p class="ui-number__hint">{{ $hint }}</p>
    @endif
</div>
