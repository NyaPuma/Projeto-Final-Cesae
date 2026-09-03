/*
|--------------------------------------------------------------------------
| Smart Picker
|--------------------------------------------------------------------------
| Reusable searchable picker that renders a list in the same visual style as
| the "Add Items" modal (resources/js/pages/ticket-detail/budget.js): each row
| is a `<label>` with a primary line + reference on the left and a badge on
| the right. It fetches options from an endpoint with debounce and supports
| both single-select (click-to-choose) and multi-select (checkbox) modes.
*/

import { authHeader } from '../utils/api.js';

const DEFAULT_SHAPE = {
    id: (item) => item.id,
    primary: (item) => item.name || '',
    secondary: (item) => item.sku || '',
    badge: (item) => '',
    searchText: (item) => {
        const lines = [item.name, item.sku, item.serial];
        return lines.filter(Boolean).join(' ').toLowerCase();
    },
};

export class SmartPicker {
    /**
     * @param {Object} containerEl   The wrapping element (contains the input + list).
     * @param {Object} options
     *   - inputId:     string  id of the search <input>.
     *   - listId:      string  id of the `<div>` that receives rendered rows.
     *   - hiddenInput: string  id of the hidden input receiving the selected id.
     *   - endpoint:    string  fetch URL (supports ?q= and ?per_page=). Optional.
     *   - resourceKey: string  top-level array key in the response (e.g. 'parts',
     *                          'equipments'). Defaults to raw array / `.data`.
     *   - shape:       Object  adapter mapping raw item -> {id, primary, secondary, badge}.
     *   - multi:       boolean if true, checkbox multi-select (default false).
     *   - openAllOnFocus: boolean if true, open the list when input gains focus even
     *                          with no query (default false).
     *   - requireSelect: boolean if true, submit a value only via selection (default true).
     *   - i18n:        Object  { empty, noResults, loading, error, selected }
     */
    constructor(containerEl, options = {}) {
        this.container = containerEl;
        this.input = this.resolve(options.inputId ?? options.inputEl);
        this.list = this.resolve(options.listId ?? options.listEl);
        this.hidden = options.hiddenInput ? this.resolve(options.hiddenInput) : (options.hiddenEl ?? null);
        this.endpoint = options.endpoint ?? null;
        this.resourceKey = options.resourceKey ?? null;
        this.shape = { ...DEFAULT_SHAPE, ...(options.shape ?? {}) };
        this.multi = options.multi ?? false;
        this.openAllOnFocus = options.openAllOnFocus ?? false;
        this.requireSelect = options.requireSelect ?? true;
        this.i18n = {
            loading: 'A carregar...',
            empty: 'Sem opções disponíveis.',
            noResults: 'Sem resultados para a pesquisa.',
            error: 'Erro ao carregar.',
            ...(options.i18n ?? {}),
        };

        this.items = [];
        this.selected = new Map(); // id -> item
        this.selectedOrder = [];
        this.abortController = null;
        this.debounceTimer = null;
        this.initialFetchDone = false;

        if (!this.input || !this.list) return;

        this.input.addEventListener('input', () => this.onInput());
        if (this.openAllOnFocus) {
            this.input.addEventListener('focus', () => this.onFocus());
        }
        this.list.addEventListener('click', (e) => this.onListClick(e));
        this.list.addEventListener('change', (e) => this.onListChange(e));
        document.addEventListener('click', (e) => {
            if (!this.container.contains(e.target)) this.close();
        });

        if (this.openAllOnFocus || this.multirequire()) this.load('');
    }

    resolve(ref) {
        return typeof ref === 'string' ? document.getElementById(ref) : ref;
    }

    multirequire() {
        return this.multi;
    }

    async load(query = '') {
        if (!this.endpoint) {
            this.render(this.filter(query));
            return;
        }

        if (this.abortController) this.abortController.abort();
        this.abortController = new AbortController();

        this.list.innerHTML = `<div class="py-4 text-center text-xs text-(--text-soft)">${this.i18n.loading}</div>`;
        this.open();

        try {
            const params = new URLSearchParams({ per_page: '100' });
            if (query.trim()) params.set('q', query.trim());
            const res = await fetch(`${this.endpoint}?${params.toString()}`, {
                headers: authHeader(),
                signal: this.abortController.signal,
            });
            if (!res.ok) throw new Error(`HTTP ${res.status}`);
            const data = await res.json().catch(() => ({}));

            let raw = this.resourceKey ? data[this.resourceKey] : data;
            raw = Array.isArray(raw) ? raw : Array.isArray(raw?.data) ? raw.data : [];
            this.items = raw.map((item) => item?.data ?? item);

            this.render(this.filter(query));
        } catch (error) {
            if (error?.name === 'AbortError') return;
            this.list.innerHTML = `<div class="py-4 text-center text-xs text-danger">${this.i18n.error}</div>`;
        }
    }

    onInput() {
        const query = this.input.value.trim().toLowerCase();
        if (this.requireSelect && !this.multi) {
            // Any keystroke invalidates a previously picked value.
            if (this.hidden) this.hidden.value = '';
            this.selected.clear();
        }
        this.notify();

        if (this.endpoint) {
            clearTimeout(this.debounceTimer);
            if (query.length === 0) {
                this.debounceTimer = setTimeout(() => this.load(''), 200);
                return;
            }
            this.debounceTimer = setTimeout(() => this.load(query), 250);
            return;
        }

        if (query.length === 0 && !this.openAllOnFocus) {
            this.close();
            return;
        }
        this.render(this.filter(query) );
        this.open();
    }

    onFocus() {
        if (!this.openAllOnFocus) return;
        this.load(this.input.value.trim());
    }

    filter(query) {
        if (!query) return this.items;
        return this.items.filter((item) => {
            const text = this.shape.searchText(item) || '';
            return text.includes(query);
        });
    }

    badge(item) {
        const value = this.shape.badge(item);
        return value === null || value === undefined ? '' : value;
    }

    render(matches) {
        if (matches.length === 0) {
            this.list.innerHTML = `<div class="py-4 text-center text-xs text-(--text-soft)">${this.i18n.noResults}</div>`;
            return;
        }

        this.list.innerHTML = matches.map((item) => {
            const id = String(this.shape.id(item));
            const primary = this.shape.primary(item) || '';
            const secondary = this.shape.secondary(item) || '';
            const badge = this.badge(item);
            const selected = this.selected.has(id);

            if (this.multi) {
                const checked = selected ? 'checked' : '';
                return `
                    <label class="flex items-center gap-3 p-2.5 rounded-xl border border-(--border) bg-(--surface-2)/60 hover:bg-(--surface-2) transition cursor-pointer">
                        <input type="checkbox" data-smart-pick="${id}" ${checked} class="h-4 w-4 accent-primary shrink-0 cursor-pointer">
                        <span class="min-w-0 flex-1">
                            <span class="block truncate text-xs font-semibold text-(--text)">${primary}</span>
                            <span class="block truncate text-[11px] text-(--text-soft)">${secondary}</span>
                        </span>
                        ${badge ? `<span class="shrink-0 text-right">${badge}</span>` : ''}
                    </label>
                `;
            }

            const active = selected ? ' border-primary bg-(--surface-2) ring-1 ring-primary/30' : '';
            return `
                <button type="button" data-smart-pick="${id}" class="flex w-full items-center gap-3 p-2.5 rounded-xl border border-(--border) bg-(--surface-2)/60 hover:bg-(--surface-2) transition cursor-pointer text-left ${active}">
                    <span class="min-w-0 flex-1">
                        <span class="block truncate text-xs font-semibold text-(--text)">${primary}</span>
                        <span class="block truncate text-[11px] text-(--text-soft)">${secondary}</span>
                    </span>
                    ${badge ? `<span class="shrink-0 text-right">${badge}</span>` : ''}
                </button>
            `;
        }).join('');
    }

    onListClick(e) {
        if (this.multi) return;
        const row = e.target.closest('[data-smart-pick]');
        if (!row) return;
        const id = row.getAttribute('data-smart-pick');
        const item = this.items.find((it) => String(this.shape.id(it)) === id);
        if (!item) return;
        this.selected.clear();
        this.selected.set(id, item);
        if (this.hidden) this.hidden.value = id;
        this.input.value = this.shape.primary(item) || '';
        this.notify();
        this.render(this.filter(this.input.value.trim().toLowerCase()));
        this.close();
    }

    onListChange(e) {
        if (!this.multi) return;
        const checkbox = e.target.closest('[data-smart-pick]');
        if (!checkbox) return;
        const id = checkbox.getAttribute('data-smart-pick');
        const item = this.items.find((it) => String(this.shape.id(it)) === id);
        if (!item) return;
        if (checkbox.checked) {
            if (!this.selected.has(id)) {
                this.selected.set(id, item);
                this.selectedOrder.push(id);
            }
        } else {
            this.selected.delete(id);
            this.selectedOrder = this.selectedOrder.filter((x) => x !== id);
        }
        this.notify();
    }

    /* Return the current selection.
       single: item object or null. multi: array of {id, item, ...}. */
    value() {
        if (this.multi) {
            return this.selectedOrder
                .map((id) => ({ id, item: this.selected.get(id) }))
                .filter((x) => x.item);
        }
        if (!this.selected.size) return null;
        const id = this.selected.keys().next().value;
        return { id, item: this.selected.get(id) };
    }

    setSelected(id, item = null) {
        if (id === undefined || id === null || id === '') {
            this.selected.clear();
            this.input.value = '';
            if (this.hidden) this.hidden.value = '';
            this.notify();
            return;
        }
        if (!item) {
            const found = this.items.find((it) => String(this.shape.id(it)) === String(id));
            if (found) item = found;
        }
        this.selected.clear();
        this.selected.set(String(id), item);
        if (this.hidden) this.hidden.value = String(id);
        if (item) this.input.value = this.shape.primary(item) || '';
        this.close();
        this.notify();
    }

    clear() {
        this.setSelected('');
    }

    open() {
        this.list.classList.remove('hidden');
    }

    close() {
        this.list.classList.add('hidden');
    }

    /* Optional onChange callback. */
    onChange(cb) {
        this._onChange = cb;
    }

    notify() {
        if (this._onChange) this._onChange();
    }

    destroy() {
        if (this.abortController) this.abortController.abort();
        // Handlers hold references; detaching them is optional since these pickers
        // are page-scoped.
    }
}

/*
|--------------------------------------------------------------------------
| Adapters
|--------------------------------------------------------------------------
| Map raw API items to the shape the picker expects.
*/

export const partShape = {
    id: (item) => item.id,
    primary: (item) => item.name || '',
    secondary: (item) => item.sku || '',
    badge: (item) => {
        const price = Number(item.sale_price) > 0
            ? Number(item.sale_price)
            : Number(item.price_with_vat) || 0;
        const formatted = new Intl.NumberFormat('pt-PT', {
            style: 'currency', currency: 'EUR', minimumFractionDigits: 2,
        }).format(price);
        const stock = item.current_stock ?? 0;
        const unit = item.unit_of_measure || 'un';
        return `<span class="block font-mono text-xs font-bold text-(--text)">${formatted}</span>
                <span class="block text-[11px] text-(--text-soft)">${stock} ${unit}</span>`;
    },
    searchText: (item) => [item.name, item.sku, item.description].filter(Boolean).join(' ').toLowerCase(),
};

export const equipmentShape = {
    id: (item) => item.id,
    primary: (item) => item.name || '',
    secondary: (item) => {
        const parts = [];
        if (item.serial) parts.push(item.serial);
        if (item.room?.name) parts.push(item.room.name);
        return parts.join(' • ');
    },
    badge: (item) => {
        const category = item.category?.name;
        if (!category) return '';
        return `<span class="block rounded-md bg-(--surface-2) px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider text-(--text-soft)">${category}</span>`;
    },
    searchText: (item) => {
        const parts = [item.name, item.serial, item.room?.name];
        return parts.filter(Boolean).join(' ').toLowerCase();
    },
};