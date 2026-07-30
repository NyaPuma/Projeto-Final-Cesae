{{--
|--------------------------------------------------------------------------
| Autocomplete Component
|--------------------------------------------------------------------------
|
| Campo de pesquisa interativo com sugestões em tempo real via Alpine.js.
| • Acessibilidade A11y WCAG completa (combobox, listbox, aria-expanded, aria-activedescendant).
| • Tratamento automático de estados (loading, vazio, erros de validação do Laravel).
| • Separação correta de atributos entre o contentor principal e o input.
| • 100% livre de CSS ou JS inline (utiliza [x-cloak] para prevenção de FOUC).
|
--}}

@props([
    'name',
    'label' => null,
    'placeholder' => 'Pesquisar...',
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'hint' => null,
    'icon' => true,
    'value' => null,
    'valueName' => null, // Nome para o input hidden do ID selecionado (ex: name_id)
])

@php
    $id = $attributes->get('id', $name);
    $dropdownId = "dropdown-{$id}";
    $hiddenInputName = $valueName ?? "{$name}_id";

    // Verifica erros de validação do Laravel para o campo
    $hasError = $errors->has($name) || $errors->has($hiddenInputName);
@endphp

<div
    {{ $attributes->except(['id', 'name', 'type', 'value', 'placeholder', 'required', 'disabled', 'readonly'])->class([
        'ui-autocomplete',
        'ui-autocomplete--error' => $hasError,
        'ui-autocomplete--disabled' => $disabled,
    ]) }}
    x-data="autocompleteComponent({ initialValue: @js($value) })"
    @click.outside="close()"
>
    @if($label)
        <label for="{{ $id }}" class="ui-autocomplete__label">
            {{ $label }}
            @if($required)
                <span class="ui-autocomplete__required-marker" aria-hidden="true">*</span>
            @endif
        </label>
    @endif

    <div
        class="ui-autocomplete__wrapper"
        role="combobox"
        :aria-expanded="opened.toString()"
        aria-haspopup="listbox"
        aria-controls="{{ $dropdownId }}"
    >
        @if($icon)
            <span class="ui-autocomplete__icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </span>
        @endif

        <input
            id="{{ $id }}"
            name="{{ $name }}"
            type="text"
            autocomplete="off"
            placeholder="{{ $placeholder }}"
            class="ui-autocomplete__input @error($name) ui-autocomplete__input--error @enderror"
            x-model="query"
            x-ref="input"
            @input.debounce.300ms="search()"
            @focus="open()"
            @keydown.arrow-down.prevent="next()"
            @keydown.arrow-up.prevent="previous()"
            @keydown.enter.prevent="selectActive()"
            @keydown.escape="close()"
            @if($required) required @endif
            @if($disabled) disabled @endif
            @if($readonly) readonly @endif
            :aria-activedescendant="active >= 0 ? '{{ $id }}-option-' + active : null"
        >

        {{-- Botão para limpar a seleção --}}
        <button
            type="button"
            x-show="selected"
            x-cloak
            @click="clearSelection()"
            class="ui-autocomplete__clear"
            aria-label="Limpar seleção"
        >
            &times;
        </button>

        <input type="hidden" name="{{ $hiddenInputName }}" x-model="selectedId">

        <div class="ui-autocomplete__loader" x-show="loading" x-cloak aria-hidden="true">
            <span class="ui-autocomplete__spinner"></span>
        </div>
    </div>

    {{-- Dropdown list --}}
    <ul
        id="{{ $dropdownId }}"
        class="ui-autocomplete__dropdown"
        x-show="opened"
        x-cloak
        role="listbox"
        x-transition
    >
        <template x-if="loading">
            <li class="ui-autocomplete__state" role="status">A pesquisar...</li>
        </template>

        <template x-if="!loading && results.length === 0">
            <li class="ui-autocomplete__state" role="status">Nenhum resultado encontrado.</li>
        </template>

        <template x-for="(item, index) in results" :key="item.id ?? index">
            <li
                :id="'{{ $id }}-option-' + index"
                role="option"
                :aria-selected="active === index ? 'true' : 'false'"
                class="ui-autocomplete__option"
                :class="{'is-active': active === index}"
                @mouseenter="active = index"
                @click="select(item)"
                x-text="item.label"
            ></li>
        </template>
    </ul>

    @if($hint && !$hasError)
        <p class="ui-autocomplete__hint">{{ $hint }}</p>
    @endif

    @error($name)
        <p class="ui-autocomplete__error-message" role="alert">{{ $message }}</p>
    @enderror
    @error($hiddenInputName)
        <p class="ui-autocomplete__error-message" role="alert">{{ $message }}</p>
    @enderror
</div>
