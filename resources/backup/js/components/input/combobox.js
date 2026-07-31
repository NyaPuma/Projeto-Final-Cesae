/*
|--------------------------------------------------------------------------
| Combobox Component
|--------------------------------------------------------------------------
|
| Otimizado para Alpine.js 3.x
|
| Melhorias:
| - $watch para reatividade limpa
| - Gestão de estado de sincronização
| - Event dispatching para validação
| - UX Profissional (auto-clear, focus)
*/

import AutocompleteService from '../../services/autocomplete-service';

export default function comboboxComponent(options = {}) {
    return {
        // State
        query: '',
        selected: null,
        results: [],
        active: -1,
        opened: false,
        loading: false,
        service: null,

        // Lifecycle
        init() {
            this.service = new AutocompleteService({
                endpoint: options.endpoint,
                items: options.items ?? [],
                element: this.$root,
                minLength: options.minLength ?? 2
            });

            // Reatividade: Observa mudanças no input
            this.$watch('query', (value) => {
                if (!value) {
                    this.selected = null;
                    this.results = [];
                    this.opened = false;
                    return;
                }
                this.search(value);
            });
        },

        // Search Logic
        async search(query) {
            this.loading = true;
            try {
                this.results = await this.service.query(query);
                this.opened = this.results.length > 0;
                this.active = -1;
            } catch (error) {
                console.error("Erro na pesquisa do Combobox:", error);
                this.results = [];
            } finally {
                this.loading = false;
            }
        },

        // Selection
        select(item) {
            this.selected = item.value ?? item.id;
            this.query = item.label;
            this.opened = false;

            // Notificar outros componentes da mudança
            this.$dispatch('input', this.selected);
            this.$dispatch('change', { value: this.selected, label: this.query });
        },

        // UI Helpers
        toggle() {
            this.opened = !this.opened;
        },

        close() {
            this.opened = false;
        },

        // Keyboard Navigation
        keydown(event) {
            const keyMap = {
                'ArrowDown': () => {
                    event.preventDefault();
                    this.active = this.service.next();
                },
                'ArrowUp': () => {
                    event.preventDefault();
                    this.active = this.service.previous();
                },
                'Enter': () => {
                    event.preventDefault();
                    const item = this.service.current();
                    if (item) this.select(item);
                },
                'Escape': () => {
                    this.close();
                }
            };

            if (keyMap[event.key]) {
                keyMap[event.key]();
            }
        }
    };
}
