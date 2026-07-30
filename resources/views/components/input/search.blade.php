{{--
|--------------------------------------------------------------------------
| Search Input Component
|--------------------------------------------------------------------------
|
| Campo de pesquisa reativo com suporte a limpeza, loading, validação e A11y.
| • 100% livre de CSS ou JS inline.
| • Sanitização robusta de IDs para campos complexos (pontos e arrays).
| • Integração nativa com Request Validation e Old Input do Laravel.
| • Acessibilidade WCAG avançada (aria-invalid, aria-describedby).
|
--}}

@props([
    'id' => null,
    'name' => 'search',
    'value' => null,
    'placeholder' => 'Pesquisar...',
    'label' => null,
    'hint' => null,
    'autocomplete' => 'off',
    'autofocus' => false,
    'clearable' => true,
    'loading' => false,
    'error' => null,
])

@php
    // Sanitização segura do nome e geração de ID compatível com DOM
    $safeName = $name ?? '';
    $defaultId = $id ?? ($safeName ? str_replace(['.', '[', ']'], ['_', '', ''], $safeName) : 'search_' . uniqid());

    // Resolução automática de erros do Laravel caso a prop error não venha preenchida
    $laravelError = $safeName ? $errors->first($safeName) : null;
    $resolvedError = $error ?? $laravelError;
    $hasError = !empty($resolvedError);

    // Definição dos IDs para conexões ARIA
    $hintId = $hint ? "{$defaultId}-hint" : null;
    $errorId = $hasError ? "{$defaultId}-error" : null;
    $describedBy = array_filter([$hintId, $errorId]);

    // Valor inicial considerando o old input do Laravel
    $initialValue = $safeName ? old($safeName, $value) : $value;
@endphp

<div
    {{ $attributes->except(['id', 'name', 'type', 'value', 'placeholder', 'autocomplete', 'autofocus'])->class([
        'ui-search',
        'ui-search--error' => $hasError,
        'ui-search--loading' => $loading,
    ]) }}
    x-data="{ query: @js($initialValue ?? '') }"
>
    @if($label)
        <label class="ui-search__label" for="{{ $defaultId }}">
            {{ $label }}
        </label>
    @endif

    <div class="ui-search__wrapper">
        <span class="ui-search__icon" aria-hidden="true">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <circle cx="11" cy="11" r="7"/>
                <line x1="21" y1="21" x2="16.65" y2="16.65"/>
            </svg>
        </span>

        <input
            x-ref="input"
            x-model="query"
            id="{{ $defaultId }}"
            @if($safeName) name="{{ $safeName }}" @endif
            type="search"
            class="ui-search__input @if($hasError) ui-search__input--error @enderror"
            @if($placeholder) placeholder="{{ $placeholder }}" @endif
            @if($autocomplete) autocomplete="{{ $autocomplete }}" @endif
            @if($autofocus) autofocus @endif
            @if($hasError) aria-invalid="true" @else aria-invalid="false" @endif
            @if($describedBy) aria-describedby="{{ implode(' ', $describedBy) }}" @endif
            {{ $attributes->only(['id', 'name', 'type', 'value', 'placeholder', 'autocomplete', 'autofocus']) }}
        >

        @if($loading)
            <span class="ui-search__loader" aria-hidden="true" aria-label="A carregar..."></span>
        @endif

        @if($clearable)
            <button
                type="button"
                class="ui-search__clear"
                aria-label="Limpar pesquisa"
                x-cloak
                x-show="query && query.length > 0"
                @click="query = ''; $refs.input.focus();"
            >
                <svg viewBox="0 0 20 20" fill="currentColor" width="16" height="16" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
            </button>
        @endif
    </div>

    {{-- Dica de Ajuda (Hint) --}}
    @if($hint && !$hasError)
        <p id="{{ $hintId }}" class="ui-search__hint">{{ $hint }}</p>
    @endif

    {{-- Mensagem de Erro do Laravel --}}
    @if($hasError)
        <p id="{{ $errorId }}" class="ui-search__error-message" role="alert">{{ $resolvedError }}</p>
    @endif
</div>
