/*
|--------------------------------------------------------------------------
| Dropdown Manager (Robust & A11y Ready)
|--------------------------------------------------------------------------
|
| Reusable manager focused on accessibility and CSS state.
|
*/

export default class DropdownManager {
    constructor(options = {}) {
        this.element = options.element ?? null; // Wrapper or main element
        this.trigger = options.trigger ?? null; // Trigger button
        this.menu = options.menu ?? null;       // The dropdown itself

        this.opened = false;
        this.onOpen = options.onOpen ?? (() => {});
        this.onClose = options.onClose ?? (() => {});

        // Bindings
        this.handleKeydown = this.handleKeydown.bind(this);
        this.handleOutsideClick = this.handleOutsideClick.bind(this);

        // Initial state
        this.updateState();
    }

    open() {
        if (this.opened) return;

        this.opened = true;
        this.updateState();
        this.attach();
        this.onOpen();
    }

    close() {
        if (!this.opened) return;

        this.opened = false;
        this.updateState();
        this.detach();
        this.onClose();
    }

    toggle() {
        this.opened ? this.close() : this.open();
    }

    // Updates A11y attributes and CSS state
    updateState() {
        const state = this.opened ? 'open' : 'closed';

        // Updates data attributes for CSS
        this.element?.setAttribute('data-state', state);

        // Updates accessibility on trigger
        if (this.trigger) {
            this.trigger.setAttribute('aria-expanded', this.opened);
            this.trigger.setAttribute('aria-haspopup', 'true');
        }
    }

    attach() {
        document.addEventListener('keydown', this.handleKeydown);
        document.addEventListener('mousedown', this.handleOutsideClick);
    }

    detach() {
        document.removeEventListener('keydown', this.handleKeydown);
        document.removeEventListener('mousedown', this.handleOutsideClick);
    }

    handleKeydown(event) {
        if (event.key === 'Escape' && this.opened) {
            this.close();
            this.trigger?.focus(); // Returns focus to the button
        }
    }

    handleOutsideClick(event) {
        if (this.element && !this.element.contains(event.target)) {
            this.close();
        }
    }

    destroy() {
        this.detach();
        this.element = null;
        this.trigger = null;
        this.menu = null;
    }
}
