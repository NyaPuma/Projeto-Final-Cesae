{{--
|--------------------------------------------------------------------------
| Search Input Component (Otimizado)
|--------------------------------------------------------------------------
|
| Campo de pesquisa reativo com suporte a limpeza e loading.
|
--}}

@props([
    'name' => 'search',
    'value' => null,
    'placeholder' => 'Pesquisar...',
    'label' => null,
    'hint' => null,
    'autocomplete' => 'off',
    'autofocus' => false,
    'clearable' => true,
    'loading' => false,
])

@php
    $id = $attributes->get('id', $name);
@endphp

<div class="ui-search" x-data="{ query: @js(old($name, $value)) }">
    @if($label)
        <label class="ui-search__label" for="{{ $id }}">
            {{ $label }}
        </label>
    @endif

    <div class="ui-search__wrapper">
        <span class="ui-search__icon" aria-hidden="true">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="7"/>
                <line x1="21" y1="21" x2="16.65" y2="16.65"/>
            </svg>
        </span>

        <input
            x-ref="input"
            x-model="query"
            id="{{ $id }}"
            name="{{ $name }}"
            type="search"
            class="ui-search__input"
            placeholder="{{ $placeholder }}"
            autocomplete="{{ $autocomplete }}"
            @if($autofocus) autofocus @endif
            {{ $attributes->except(['id', 'name', 'type', 'class']) }}
        >

        @if($loading)
            <span class="ui-search__loader" aria-label="A carregar..."></span>
        @elseif($clearable)
            <button
                type="button"
                class="ui-search__clear"
                aria-label="Limpar pesquisa"
                x-cloak
                x-show="query && query.length > 0"
                @click="query = ''; $refs.input.focus();"
            >
                <svg viewBox="0 0 20 20" fill="currentColor" width="16" height="16">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
            </button>
        @endif
    </div>

    @if($hint)
        <p class="ui-search__hint">{{ $hint }}</p>
    @endif
</div>
