{{--
|--------------------------------------------------------------------------
| Combobox Component
|--------------------------------------------------------------------------
|
| Campo de seleção pesquisável assíncrono com suporte a A11y e Alpine.js.
| • Integração nativa com Validação, Old Input e mensagens de erro do Laravel.
| • Sanitização robusta de IDs para campos complexos (pontos e arrays).
| • Acessibilidade WCAG avançada (combobox, listbox, aria-expanded, aria-activedescendant).
| • Tratamento automático de estados (loading, vazio, limpo, desativado).
| • 100% livre de CSS ou JS inline (suporta [x-cloak]).
|
--}}

@props([
    'id' => null,
    'name' => null,
    'label' => null,
    'placeholder' => 'Selecionar...',
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'endpoint' => null,
    'value' => null,
    'hint' => null,
    'error' => null,
])

@php
    // Sanitização rigorosa do nome e geração de ID compatível com DOM
    $safeName = $name ?? '';
    $defaultId = $id ?? ($safeName ? str_replace(['.', '[', ']'], ['_', '', ''], $safeName) : 'combobox_' . uniqid());
    $dropdownId = "dropdown-{$defaultId}";

    // Resolução automática de erros do Laravel caso a prop error não venha preenchida
    $laravelError = $safeName ? $errors->first($safeName) : null;
    $resolvedError = $error ?? $laravelError;
    $hasError = !empty($resolvedError);

    // Definição dos IDs para conexões ARIA
    $hintId = $hint ? "{$defaultId}-hint" : null;
    $errorId = $hasError ? "{$defaultId}-error" : null;
    $describedBy = array_filter([$hintId, $errorId]);

    // Resolução do valor inicial (considerando old input ou valor passado por prop)
    $initialValue = $safeName ? old($safeName, $value) : $value;
@endphp

<div
    {{ $attributes->except(['id', 'name', 'value', 'required', 'disabled', 'readonly', 'placeholder'])->class([
        'ui-combobox',
        'ui-combobox--error' => $hasError,
        'ui-combobox--disabled' => $disabled,
    ]) }}
    x-data="comboboxComponent({ endpoint: @js($endpoint), initialValue: @js($initialValue) })"
    @click.outside="close()"
>
    @if($label)
        <label class="ui-combobox__label" for="{{ $defaultId }}">
            {{ $label }}
            @if($required)
                <span class="ui-combobox__required-marker" aria-hidden="true">*</span>
            @endif
        </label>
    @endif

    <div
        class="ui-combobox__wrapper"
        role="combobox"
        :aria-expanded="opened.toString()"
        aria-haspopup="listbox"
        aria-controls="{{ $dropdownId }}"
    >
        <input
            id="{{ $defaultId }}"
            class="ui-combobox__input @error($safeName) ui-combobox__input--error @enderror"
            type="text"
            placeholder="{{ $placeholder }}"
            autocomplete="off"
            x-model="query"
            x-ref="input"
            @input.debounce.300ms="search()"
            @focus="open()"
            @keydown.arrow-down.prevent="next()"
            @keydown.arrow-up.prevent="previous()"
            @keydown.enter.prevent="selectActive()"
            @keydown.escape="close()"
            @if($readonly) readonly @endif
            @if($disabled) disabled @endif
            @if($required) required @endif
            @if($hasError) aria-invalid="true" @endif
            @if($describedBy) aria-describedby="{{ implode(' ', $describedBy) }}" @endif
            :aria-activedescendant="active >= 0 ? '{{ $defaultId }}-option-' + active : null"
            {{ $attributes->only(['id', 'name', 'value', 'required', 'disabled', 'readonly', 'placeholder']) }}
        >

        {{-- Input oculto responsável por submeter o valor/ID selecionado --}}
        @if($safeName)
            <input type="hidden" name="{{ $safeName }}" x-model="selected">
        @endif

        {{-- Botão Toggle / Limpar --}}
        <button
            type="button"
            class="ui-combobox__toggle"
            @click="toggle()"
            @if($disabled) disabled @endif
            aria-label="Alternar lista de opções"
        >
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path d="m19 9-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    </div>

    {{-- Dropdown Menu --}}
    <ul
        id="{{ $dropdownId }}"
        class="ui-combobox__dropdown"
        x-show="opened"
        x-cloak
        x-transition
        role="listbox"
    >
        <template x-if="loading">
            <li class="ui-combobox__state" role="status">A pesquisar...</li>
        </template>

        <template x-if="!loading && results.length === 0">
            <li class="ui-combobox__state" role="status">Nenhum resultado encontrado.</li>
        </template>

        <template x-for="(item, index) in results" :key="item.id ?? index">
            <li
                :id="'{{ $defaultId }}-option-' + index"
                role="option"
                :aria-selected="selected == item.id ? 'true' : 'false'"
                class="ui-combobox__option"
                :class="{'is-active': active === index, 'is-selected': selected == item.id}"
                @mouseenter="active = index"
                @click="select(item)"
                x-text="item.label"
            ></li>
        </template>
    </ul>

    {{-- Dica de Ajuda (Hint) --}}
    @if($hint && !$hasError)
        <p id="{{ $hintId }}" class="ui-combobox__hint">{{ $hint }}</p>
    @endif

    {{-- Mensagem de Erro do Laravel --}}
    @if($hasError)
        <p id="{{ $errorId }}" class="ui-combobox__error-message" role="alert">{{ $resolvedError }}</p>
    @endif
</div>
