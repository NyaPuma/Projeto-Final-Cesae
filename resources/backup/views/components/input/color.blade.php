{{--
|--------------------------------------------------------------------------
| Color Input Component (Otimizado)
|--------------------------------------------------------------------------
|
| Seletor de cor profissional com sincronização HEX.
| • Sincronização visual em tempo real.
| • Acessibilidade A11y (label associado).
| • Tratamento de erros e estados.
|
--}}

@props([
    'name',
    'label' => null,
    'value' => '#2563eb',
    'hint' => null,
    'error' => null,
    'required' => false,
    'disabled' => false,
])

<div class="ui-color {{ $error ? 'ui-color--error' : '' }}"
     x-data="{ color: '{{ old($name, $value) }}' }">

    @if($label)
        <label for="{{ $name }}" class="ui-color__label">
            {{ $label }}
            @if($required) <span class="ui-color__required">*</span> @endif
        </label>
    @endif

    <div class="ui-color__wrapper">
        {{-- Seletor Visual (Oculto mas acessível) --}}
        <input
            type="color"
            x-model="color"
            class="ui-color__picker"
            @disabled($disabled)
        >

        {{-- Input de Texto HEX --}}
        <input
            id="{{ $name }}"
            name="{{ $name }}"
            type="text"
            x-model="color"
            class="ui-color__value"
            maxlength="7"
            placeholder="#000000"
            aria-label="Código de cor hexadecimal"
            @required($required)
            @disabled($disabled)
        >
    </div>

    @if($hint)
        <p class="ui-color__hint">{{ $hint }}</p>
    @endif

    @if($error)
        <x-ui.input.error>{{ $error }}</x-ui.input.error>
    @endif
</div>
