/*
|--------------------------------------------------------------------------
| Search Engine
|--------------------------------------------------------------------------
| Motor de pesquisa reutilizável e robusto.
*/

export default class SearchEngine {
    constructor(options = {}) {
        this.endpoint = options.endpoint ?? null;
        this.items = options.items ?? [];
        this.searchKey = options.searchKey ?? 'label'; // Agora configurável
        this.minLength = options.minLength ?? 2;
        this.maxResults = options.maxResults ?? 10;
        this.cache = new Map();
        this.abortController = null;
    }

    /**
     * Pesquisa local nos itens fornecidos.
     * @param {string} query
     */
    local(query) {
        if (!query) return [];
        const search = query.toLowerCase();

        return this.items
            .filter(item => {
                const value = item[this.searchKey]?.toString().toLowerCase() ?? '';
                return value.includes(search);
            })
            .slice(0, this.maxResults);
    }

    /**
     * Pesquisa remota via API com suporte a AbortController.
     * @param {string} query
     */
    async remote(query) {
        if (!this.endpoint) return [];

        // Verifica Cache
        if (this.cache.has(query)) {
            return this.cache.get(query);
        }

        // Cancela pedido anterior
        if (this.abortController) {
            this.abortController.abort();
        }

        this.abortController = new AbortController();

        try {
            const response = await fetch(
                `${this.endpoint}?search=${encodeURIComponent(query)}`,
                { signal: this.abortController.signal }
            );

            if (!response.ok) throw new Error(`HTTP Error: ${response.status}`);

            const data = await response.json();

            // Grava no cache
            this.cache.set(query, data);
            return data;
        } catch (error) {
            if (error.name === 'AbortError') {
                console.debug('Search request aborted');
            } else {
                console.error('Search engine error:', error);
            }
            return []; // Retorna array vazio em caso de erro
        }
    }

    /**
     * Método principal de busca.
     * @param {string} query
     */
    async search(query) {
        if (!query || query.length < this.minLength) {
            return [];
        }

        return this.endpoint ? await this.remote(query) : this.local(query);
    }

    clearCache() {
        this.cache.clear();
    }

    setItems(items) {
        this.items = items;
        this.clearCache(); // Limpa cache se os dados locais mudarem
    }
}
