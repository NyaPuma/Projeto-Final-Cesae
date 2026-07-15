/*
|--------------------------------------------------------------------------
| Dropdown Manager (Robust & A11y Ready)
|--------------------------------------------------------------------------
|
| Gestor reutilizável com foco em acessibilidade e estado CSS.
|
*/

export default class DropdownManager {
    constructor(options = {}) {
        this.element = options.element ?? null; // Wrapper ou elemento principal
        this.trigger = options.trigger ?? null; // Botão de disparo
        this.menu = options.menu ?? null;       // O dropdown em si

        this.opened = false;
        this.onOpen = options.onOpen ?? (() => {});
        this.onClose = options.onClose ?? (() => {});

        // Bindings
        this.handleKeydown = this.handleKeydown.bind(this);
        this.handleOutsideClick = this.handleOutsideClick.bind(this);

        // Estado inicial
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

    // Atualiza atributos de Acessibilidade e Estado CSS
    updateState() {
        const state = this.opened ? 'open' : 'closed';

        // Atualiza atributos de dados para o CSS
        this.element?.setAttribute('data-state', state);

        // Atualiza acessibilidade no trigger
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
            this.trigger?.focus(); // Devolve o foco ao botão
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
