{{--
|--------------------------------------------------------------------------
| Tag Input Component (Otimizado)
|--------------------------------------------------------------------------
|
| Campo para gestão de tags com autocomplete e AJAX.
|
--}}

@props([
    'name',
    'label' => null,
    'placeholder' => 'Adicionar...',
    'endpoint' => null,
    'initial' => [], // Ex: [{"id": 1, "label": "Admin"}]
])

<div
    class="ui-tag-input"
    x-data="tagInputComponent({
        endpoint: @js($endpoint),
        initial: @js($initial)
    })"
    @click.away="opened = false"
>
    @if($label)
        <label class="ui-tag-input__label">{{ $label }}</label>
    @endif

    <div class="ui-tag-input__container" @click="$refs.input.focus()">
        <template x-for="(tag, index) in tags" :key="tag.id">
            <div class="ui-tag-input__tag">
                <span x-text="tag.label"></span>
                <button type="button" class="ui-tag-input__remove" @click="remove(index)" aria-label="Remover tag">×</button>
                <input type="hidden" name="{{ $name }}[]" :value="tag.id">
            </div>
        </template>

        <input
            x-ref="input"
            class="ui-tag-input__input"
            type="text"
            autocomplete="off"
            x-model="query"
            placeholder="{{ $placeholder }}"
            @input.debounce.300ms="search"
            @keydown.backspace="if(query === '') removeLast()"
            @keydown.arrow-down.prevent="active = Math.min(active + 1, results.length - 1)"
            @keydown.arrow-up.prevent="active = Math.max(active - 1, 0)"
            @keydown.enter.prevent="results[active] && add(results[active])"
            @focus="opened = true"
        >
    </div>

    <ul class="ui-tag-input__dropdown" x-show="opened && results.length > 0" role="listbox" x-cloak>
        <template x-for="(item, index) in results" :key="item.id">
            <li
                class="ui-tag-input__option"
                :class="{'is-active': active === index}"
                @click="add(item)"
                @mouseover="active = index"
                role="option"
            >
                <span x-text="item.label"></span>
            </li>
        </template>
    </ul>
</div>

<script>
function tagInputComponent(config) {
    return {
        tags: config.initial || [],
        query: '',
        results: [],
        opened: false,
        active: 0,
        endpoint: config.endpoint,

        async search() {
            if (this.query.length < 2) {
                this.results = [];
                this.opened = false;
                return;
            }

            // Simulação de chamada AJAX (substituir por fetch real)
            try {
                let response = await fetch(`${this.endpoint}?q=${this.query}`);
                this.results = await response.json();
                this.opened = this.results.length > 0;
                this.active = 0;
            } catch (e) {
                console.error('Erro ao buscar tags', e);
            }
        },

        add(item) {
            if (!this.tags.find(t => t.id === item.id)) {
                this.tags.push(item);
            }
            this.query = '';
            this.results = [];
            this.opened = false;
        },

        remove(index) {
            this.tags.splice(index, 1);
        },

        removeLast() {
            this.tags.pop();
        }
    }
}
</script>
