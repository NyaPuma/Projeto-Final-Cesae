@props([
    'name',
    'label' => null,
    'placeholder' => 'Pesquisar...',
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'hint' => null,
    'icon' => true,
])

@php
    $id = $attributes->get('id', $name);
    $dropdownId = "dropdown-{$id}";
@endphp

<div
    class="ui-autocomplete"
    x-data="autocompleteComponent()"
    @click.outside="close()"
>
    @if($label)
        <label for="{{ $id }}" class="ui-autocomplete__label">
            {{ $label }}
        </label>
    @endif

    <div class="ui-autocomplete__wrapper" role="combobox" aria-expanded="false" aria-haspopup="listbox" aria-controls="{{ $dropdownId }}">

        @if($icon)
            <span class="ui-autocomplete__icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z" />
                </svg>
            </span>
        @endif

        <input
            id="{{ $id }}"
            name="{{ $name }}"
            type="text"
            autocomplete="off"
            placeholder="{{ $placeholder }}"
            class="ui-autocomplete__input"
            x-model="query"
            x-ref="input"
            @input.debounce.300ms="search()"
            @focus="open()"
            @keydown.arrow-down.prevent="next()"
            @keydown.arrow-up.prevent="previous()"
            @keydown.enter.prevent="selectActive()"
            @keydown.escape="close()"
            {{ $attributes->merge(['required' => $required, 'disabled' => $disabled, 'readonly' => $readonly]) }}
        >

        {{-- Botão para limpar a seleção --}}
        <button
            type="button"
            x-show="selected"
            @click="clearSelection()"
            class="ui-autocomplete__clear"
            aria-label="Limpar seleção"
        >
            &times;
        </button>

        <input type="hidden" name="{{ $name }}_value" x-model="selectedId">

        <x-ui.input.loader x-show="loading" class="ui-input-loader--absolute" />
    </div>

    {{-- Dropdown list --}}
    <ul
        id="{{ $dropdownId }}"
        class="ui-autocomplete__dropdown"
        x-show="opened"
        role="listbox"
        x-transition
    >
        <template x-if="loading">
            <li class="ui-autocomplete__state">A pesquisar...</li>
        </template>

        <template x-if="!loading && results.length === 0">
            <li class="ui-autocomplete__state">Nenhum resultado encontrado.</li>
        </template>

        <template x-for="(item, index) in results" :key="item.id ?? index">
            <li
                role="option"
                :aria-selected="active === index"
                class="ui-autocomplete__option"
                :class="{'is-active': active === index}"
                @mouseenter="active = index"
                @click="select(item)"
                x-text="item.label"
            ></li>
        </template>
    </ul>

    @if($hint)
        <x-ui.input.hint>{{ $hint }}</x-ui.input.hint>
    @endif

    <x-ui.input.error :name="$name"/>
</div>
