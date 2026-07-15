/*
|--------------------------------------------------------------------------
| Focus Manager
|--------------------------------------------------------------------------
|
| Gestor reutilizável de foco para componentes interativos.
|
| Funcionalidades:
| • Navegação circular (loop)
| • Filtro de elementos visíveis e focáveis
| • Guardar/Restaurar contexto
*/

export default class FocusManager {
    /**
     * @param {HTMLElement[]|NodeList} elements - Elementos a gerir
     * @param {Object} options - Configurações
     */
    constructor(elements = [], options = {}) {
        this.elements = [];
        this.previous = null;
        this.loop = options.loop ?? true;
        this.setElements(elements);
    }

    /**
     * Define e filtra elementos focáveis
     * @param {Array} elements
     */
    setElements(elements = []) {
        // Seletor padrão de elementos focáveis da W3C
        const selector = 'a[href], button, input, textarea, select, [tabindex]:not([tabindex="-1"])';

        // Converte NodeList para array e filtra
        this.elements = Array.from(elements)
            .filter(el => this.isFocusable(el));
    }

    refresh(elements = []) {
        this.setElements(elements);
    }

    /**
     * Verifica se o elemento é elegível para receber foco
     */
    isFocusable(element) {
        if (!(element instanceof HTMLElement)) return false;

        // Verifica se está visível no DOM e não está desabilitado
        const isVisible = !!(element.offsetWidth || element.offsetHeight || element.getClientRects().length);
        const isDisabled = element.hasAttribute('disabled') || element.getAttribute('aria-disabled') === 'true';

        return isVisible && !isDisabled;
    }

    first() {
        this.elements[0]?.focus();
    }

    last() {
        this.elements.at(-1)?.focus();
    }

    next(current) {
        if (this.elements.length === 0) return;

        let index = this.elements.indexOf(current);
        let nextIndex = index + 1;

        if (nextIndex >= this.elements.length) {
            if (this.loop) nextIndex = 0;
            else return;
        }

        this.elements[nextIndex]?.focus();
    }

    previous(current) {
        if (this.elements.length === 0) return;

        let index = this.elements.indexOf(current);
        let prevIndex = index - 1;

        if (prevIndex < 0) {
            if (this.loop) prevIndex = this.elements.length - 1;
            else return;
        }

        this.elements[prevIndex]?.focus();
    }

    save() {
        this.previous = document.activeElement;
    }

    restore() {
        if (this.previous) {
            this.previous.focus();
            this.previous = null;
        }
    }
}
