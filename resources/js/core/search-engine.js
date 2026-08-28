/*
|--------------------------------------------------------------------------
| Search Engine
|--------------------------------------------------------------------------
| Reusable and robust search engine.
*/

export default class SearchEngine {
    constructor(options = {}) {
        this.endpoint = options.endpoint ?? null;
        this.items = options.items ?? [];
        this.searchKey = options.searchKey ?? 'label'; // Now configurable
        this.minLength = options.minLength ?? 2;
        this.maxResults = options.maxResults ?? 10;
        this.cache = new Map();
        this.abortController = null;
    }

    /**
     * Local search on provided items.
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
     * Remote search via API with AbortController support.
     * @param {string} query
     */
    async remote(query) {
        if (!this.endpoint) return [];

        // Check cache
        if (this.cache.has(query)) {
            return this.cache.get(query);
        }

        // Cancel previous request
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

            // Save to cache
            this.cache.set(query, data);
            return data;
        } catch (error) {
            if (error.name === 'AbortError') {
                console.debug('Search request aborted');
            } else {
                console.error('Search engine error:', error);
            }
            return []; // Return empty array on error
        }
    }

    /**
     * Main search method.
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
        this.clearCache(); // Clear cache if local data changes
    }
}
