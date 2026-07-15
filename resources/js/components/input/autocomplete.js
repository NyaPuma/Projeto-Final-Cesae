/*
|--------------------------------------------------------------------------
| Autocomplete Component (Enhanced)
|--------------------------------------------------------------------------
| Melhorias: AbortController, A11y, UX de Limpeza e Event Dispatching.
*/

export default function autocompleteComponent(options = {}) {
    return {
        // Config
        endpoint: options.endpoint ?? null,
        items: options.items ?? [],
        minLength: options.minLength ?? 2,
        debounceTime: options.debounce ?? 300,
        maxResults: options.maxResults ?? 10,

        // State
        query: '',
        selected: null,
        results: [],
        active: -1,
        opened: false,
        loading: false,
        timer: null,
        cache: new Map(),
        abortController: null,

        // Lifecycle
        init() {
            this.results = [];
        },

        // Search Logic
        search() {
            clearTimeout(this.timer);

            // Se o utilizador limpar o input, garantimos que o estado é limpo
            if (this.query.length === 0) {
                this.selected = null;
                this.reset();
                return;
            }

            if (this.query.length < this.minLength) {
                this.reset();
                return;
            }

            this.timer = setTimeout(() => {
                if (this.endpoint) {
                    this.remoteSearch();
                } else {
                    this.localSearch();
                }
            }, this.debounceTime);
        },

        localSearch() {
            const search = this.query.toLowerCase().trim();
            this.results = this.items
                .filter(item => item.label.toLowerCase().includes(search))
                .slice(0, this.maxResults);

            this.open();
        },

        async remoteSearch() {
            // Cancela pedido anterior para evitar race conditions
            if (this.abortController) {
                this.abortController.abort();
            }

            if (this.cache.has(this.query)) {
                this.results = this.cache.get(this.query);
                this.open();
                return;
            }

            this.abortController = new AbortController();
            this.loading = true;

            try {
                const response = await fetch(
                    `${this.endpoint}?search=${encodeURIComponent(this.query)}`,
                    { signal: this.abortController.signal }
                );

                if (!response.ok) throw new Error('Network error');

                const data = await response.json();
                this.results = data;
                this.cache.set(this.query, data);
                this.open();
            } catch (error) {
                if (error.name !== 'AbortError') {
                    console.error('Autocomplete Error:', error);
                    this.results = [];
                }
            } finally {
                this.loading = false;
            }
        },

        // Selection
        select(item) {
            this.selected = item.value ?? item.id;
            this.query = item.label;
            this.close();

            // Dispatch evento para o Alpine/Formulário saber que o valor mudou
            this.$dispatch('input', { value: this.selected });
        },

        selectActive() {
            if (this.active >= 0 && this.results[this.active]) {
                this.select(this.results[this.active]);
            }
        },

        // Navigation
        next() {
            if (!this.opened) return this.open();
            this.active = Math.min(this.active + 1, this.results.length - 1);
        },

        previous() {
            this.active = Math.max(this.active - 1, 0);
        },

        // UI State
        open() {
            this.opened = true;
        },

        close() {
            this.opened = false;
            this.active = -1;
        },

        reset() {
            this.results = [];
            this.close();
        }
    };
}
