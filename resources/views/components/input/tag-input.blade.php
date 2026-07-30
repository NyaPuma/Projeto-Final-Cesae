{{--
|--------------------------------------------------------------------------
| Tag Input Component
|--------------------------------------------------------------------------
|
| Campo para gestão de tags com autocomplete, AJAX e A11y.
| • 100% livre de CSS ou JS inline (lógica Alpine encapsulada).
| • Sanitização robusta de IDs para campos complexos (pontos e arrays).
| • Integração nativa com Request Validation e Old Input do Laravel.
| • Acessibilidade WCAG avançada (aria-expanded, aria-controls, aria-invalid).
|
--}}

@props([
    'id' => null,
    'name' => null,
    'label' => null,
    'placeholder' => 'Adicionar...',
    'endpoint' => null,
    'initial' => [], // Ex: [{"id": 1, "label": "Admin"}]
    'hint' => null,
    'error' => null,
    'disabled' => false,
    'readonly' => false,
])

@php
    // Sanitização segura do nome e geração de ID compatível com DOM
    $safeName = $name ?? '';
    $defaultId = $id ?? ($safeName ? str_replace(['.', '[', ']'], ['_', '', ''], $safeName) : 'tags_' . uniqid());

    // Resolução automática de erros do Laravel caso a prop error não venha preenchida
    $laravelError = $safeName ? $errors->first($safeName) : null;
    $resolvedError = $error ?? $laravelError;
    $hasError = !empty($resolvedError);

    // Definição dos IDs para conexões ARIA
    $hintId = $hint ? "{$defaultId}-hint" : null;
    $errorId = $hasError ? "{$defaultId}-error" : null;
    $dropdownId = "{$defaultId}-dropdown";
    $describedBy = array_filter([$hintId, $errorId]);

    // Tratamento de valores iniciais considerando o old input do Laravel ou a prop
    $oldValues = $safeName ? old($safeName, $initial) : $initial;
@endphp

<div
    {{ $attributes->except(['id', 'name', 'type', 'placeholder', 'endpoint', 'initial', 'disabled', 'readonly'])->class([
        'ui-tag-input',
        'ui-tag-input--error' => $hasError,
        'ui-tag-input--disabled' => $disabled,
        'ui-tag-input--readonly' => $readonly,
    ]) }}
    x-data="{
        tags: @js($oldValues),
        query: '',
        results: [],
        opened: false,
        active: 0,
        endpoint: @js($endpoint),
        disabled: @js((bool)$disabled),
        readonly: @js((bool)$readonly),
        async search() {
            if (this.disabled || this.readonly) return;
            if (this.query.length < 2 || !this.endpoint) {
                this.results = [];
                this.opened = false;
                return;
            }
            try {
                let response = await fetch(`${this.endpoint}?q=${encodeURIComponent(this.query)}`);
                if (!response.ok) throw new Error('Erro na rede');
                this.results = await response.json();
                this.opened = this.results.length > 0;
                this.active = 0;
            } catch (e) {
                console.error('Erro ao buscar tags:', e);
                this.results = [];
                this.opened = false;
            }
        },
        add(item) {
            if (this.disabled || this.readonly) return;
            if (!this.tags.some(t => t.id === item.id)) {
                this.tags.push(item);
            }
            this.query = '';
            this.results = [];
            this.opened = false;
        },
        remove(index) {
            if (this.disabled || this.readonly) return;
            this.tags.splice(index, 1);
        },
        removeLast() {
            if (this.disabled || this.readonly) return;
            if (this.tags.length > 0) {
                this.tags.pop();
            }
        }
    }"
    @click.away="opened = false"
>
    @if($label)
        <label for="{{ $defaultId }}" class="ui-tag-input__label">
            {{ $label }}
        </label>
    @endif

    <div
        class="ui-tag-input__container @if($hasError) ui-tag-input__container--error @enderror"
        @click="!disabled && !readonly && $refs.input.focus()"
    >
        <template x-for="(tag, index) in tags" :key="tag.id ?? index">
            <div class="ui-tag-input__tag">
                <span x-text="tag.label ?? tag"></span>
                <button
                    type="button"
                    class="ui-tag-input__remove"
                    @click.stop="remove(index)"
                    :aria-label="'Remover tag ' + (tag.label ?? tag)"
                    :disabled="disabled || readonly"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
                @if($safeName)
                    <input type="hidden" name="{{ $safeName }}[]" :value="tag.id ?? tag">
                @endif
            </div>
        </template>

        <input
            x-ref="input"
            id="{{ $defaultId }}"
            class="ui-tag-input__input"
            type="text"
            autocomplete="off"
            x-model="query"
            @if($placeholder) placeholder="{{ $placeholder }}" @endif
            @input.debounce.300ms="search"
            @keydown.backspace="if(query === '') removeLast()"
            @keydown.arrow-down.prevent="if(opened && results.length > 0) active = Math.min(active + 1, results.length - 1)"
            @keydown.arrow-up.prevent="if(opened && results.length > 0) active = Math.max(active - 1, 0)"
            @keydown.enter.prevent="if(opened && results[active]) add(results[active])"
            @keydown.escape="opened = false"
            @focus="if(!disabled && !readonly && query.length >= 2 && results.length > 0) opened = true"
            :disabled="disabled"
            :readonly="readonly"
            :aria-expanded="opened ? 'true' : 'false'"
            aria-haspopup="listbox"
            :aria-controls="opened ? '{{ $dropdownId }}' : null"
            @if($hasError) aria-invalid="true" @else aria-invalid="false" @endif
            @if($describedBy) aria-describedby="{{ implode(' ', $describedBy) }}" @endif
        >
    </div>

    {{-- Dropdown de Autocomplete --}}
    <ul
        id="{{ $dropdownId }}"
        class="ui-tag-input__dropdown"
        x-show="opened && results.length > 0"
        role="listbox"
        x-cloak
    >
        <template x-for="(item, index) in results" :key="item.id ?? index">
            <li
                class="ui-tag-input__option"
                :class="{ 'ui-tag-input__option--active': active === index }"
                @click="add(item)"
                @mouseenter="active = index"
                role="option"
                :id="'{{ $defaultId }}-option-' + index"
                :aria-selected="active === index ? 'true' : 'false'"
            >
                <span x-text="item.label ?? item"></span>
            </li>
        </template>
    </ul>

    {{-- Dica de Ajuda (Hint) --}}
    @if($hint && !$hasError)
        <p id="{{ $hintId }}" class="ui-tag-input__hint">{{ $hint }}</p>
    @endif

    {{-- Mensagem de Erro do Laravel --}}
    @if($hasError)
        <p id="{{ $errorId }}" class="ui-tag-input__error-message" role="alert">{{ $resolvedError }}</p>
    @endif
</div>
