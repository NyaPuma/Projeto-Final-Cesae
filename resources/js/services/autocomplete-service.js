/*
|--------------------------------------------------------------------------
| Autocomplete Service
|--------------------------------------------------------------------------
|
| Refactored to use our standard ApiClient, handling
| errors and response formatting centrally.
*/

import SearchEngine from '../core/search-engine';
import NavigationManager from '../core/navigation-manager';
import DropdownManager from '../core/dropdown-manager';

export default class AutocompleteService {
    constructor(options = {}) {
        this.results = [];
        this.loading = false;

        // Callbacks for the UI to react to changes
        this.onResults = options.onResults ?? (() => {});
        this.onNavigate = options.onNavigate ?? (() => {});

        this.search = new SearchEngine(options);

        this.navigation = new NavigationManager({
            count: () => this.results.length,
            loop: true,
            // NavigationManager notifies the UI when the index changes
            onNavigate: (index) => this.onNavigate(this.results[index], index)
        });

        this.dropdown = new DropdownManager({
            element: options.element,
            onClose: () => this.navigation.reset()
        });
    }

    async query(text) {
        if (!text || text.length < (this.search.minLength ?? 2)) {
            this.results = [];
            this.dropdown.close();
            return;
        }

        this.loading = true;
        try {
            this.results = await this.search.search(text);

            if (this.results.length > 0) {
                this.dropdown.open();
            } else {
                this.dropdown.close();
            }

            this.navigation.reset();
            this.onResults(this.results);

        } catch (error) {
            console.error('Autocomplete Error:', error);
            this.results = [];
            this.dropdown.close();
        } finally {
            this.loading = false;
        }
    }

    next() {
        return this.navigation.next();
    }

    previous() {
        return this.navigation.previous();
    }

    select() {
        const item = this.current();
        if (item) {
            this.dropdown.close();
        }
        return item;
    }

    close() {
        this.dropdown.close();
    }

    open() {
        this.dropdown.open();
    }

    current() {
        const index = this.navigation.current();
        return index > -1 ? this.results[index] : null;
    }

    // Important to prevent Memory Leaks in Single Page Applications
    destroy() {
        this.dropdown.destroy?.(); // If the dropdown has a destroy method
        this.results = [];
        this.navigation.reset();
    }
}
