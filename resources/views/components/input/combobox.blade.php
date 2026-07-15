{{--
|--------------------------------------------------------------------------
| Combobox Component (Otimizado)
|--------------------------------------------------------------------------
|
| Campo de seleção pesquisável com A11y completo.
| • Acessibilidade: role="combobox" e gestão de estados.
| • UX: Suporte a Loading, Empty e Clear.
|
--}}

@props([
    'name',
    'label' => null,
    'placeholder' => 'Selecionar...',
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'endpoint' => null,
    'error' => null,
])

@php
    $id = $attributes->get('id', $name);
    $dropdownId = "dropdown-{$id}";
@endphp

<div
    class="ui-combobox"
    x-data="comboboxComponent({ endpoint: @js($endpoint) })"
    @click.outside="close()"
>
    @if($label)
        <label class="ui-combobox__label" for="{{ $id }}">{{ $label }}</label>
    @endif

    <div class="ui-combobox__wrapper" role="combobox" aria-expanded="false" aria-haspopup="listbox" aria-controls="{{ $dropdownId }}">

        <input
            id="{{ $id }}"
            class="ui-combobox__input"
            type="text"
            placeholder="{{ $placeholder }}"
            autocomplete="off"
            x-model="query"
            @input.debounce.300ms="search"
            @focus="open"
            @keydown.arrow-down.prevent="next"
            @keydown.arrow-up.prevent="previous"
            @keydown.enter.prevent="selectActive"
            @keydown.escape="close"
            @readonly($readonly)
            @disabled($disabled)
            {{ $attributes }}
        >

        <input type="hidden" name="{{ $name }}" x-model="selected">

        <button type="button" class="ui-combobox__toggle" @click="toggle" aria-label="Mostrar opções">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m19 9-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
    </div>

    {{-- Dropdown Menu --}}
    <ul
        id="{{ $dropdownId }}"
        class="ui-combobox__dropdown"
        x-show="opened"
        x-transition
        role="listbox"
    >
        <template x-if="loading">
            <li class="ui-combobox__state">A pesquisar...</li>
        </template>

        <template x-if="!loading && results.length === 0">
            <li class="ui-combobox__state">Nenhum resultado.</li>
        </template>

        <template x-for="(item, index) in results" :key="item.id">
            <li
                role="option"
                :aria-selected="selected === item.id"
                class="ui-combobox__option"
                :class="{'is-active': active === index, 'is-selected': selected === item.id}"
                @mouseenter="active = index"
                @click="select(item)"
                x-text="item.label"
            ></li>
        </template>
    </ul>

    @if($error)
        <x-ui.input.error>{{ $error }}</x-ui.input.error>
    @endif
</div>
