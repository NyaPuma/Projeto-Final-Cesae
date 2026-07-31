/*
|--------------------------------------------------------------------------
| Keyboard Navigation Manager
|--------------------------------------------------------------------------
|
| Gestor reutilizável de navegação por teclado para componentes UI.
|
| Funcionalidades:
| • Navegação (Up/Down/Home/End)
| • Callbacks de ação (Enter/Escape)
| • Loop infinito opcional
| • Notificação de mudança de índice
|
*/

export default class KeyboardNavigation {
    /**
     * @param {Object} options
     * @param {Function} options.count - Retorna o total de elementos.
     * @param {boolean} [options.loop=true] - Se permite voltar ao início/fim.
     * @param {number} [options.index=-1] - Índice inicial.
     * @param {Function} [options.onSelect] - Callback ao pressionar Enter.
     * @param {Function} [options.onEscape] - Callback ao pressionar Escape.
     * @param {Function} [options.onNavigate] - Callback após qualquer mudança de índice.
     */
    constructor(options = {}) {
        this.count = options.count ?? (() => 0);
        this.loop = options.loop ?? true;
        this.index = options.index ?? -1;

        // Callbacks de evento
        this.onSelect = options.onSelect ?? (() => {});
        this.onEscape = options.onEscape ?? (() => {});
        this.onNavigate = options.onNavigate ?? (() => {});
    }

    /**
     * Define o índice manualmente (ex: após clique do rato).
     */
    setIndex(index) {
        this.index = index;
    }

    current() {
        return this.index;
    }

    reset() {
        this.index = -1;
    }

    next() {
        const total = this.count();
        if (total <= 0) return this.index;

        if (this.index >= total - 1) {
            this.index = this.loop ? 0 : total - 1;
        } else {
            this.index++;
        }

        this.onNavigate(this.index);
        return this.index;
    }

    previous() {
        const total = this.count();
        if (total <= 0) return this.index;

        if (this.index <= 0) {
            this.index = this.loop ? total - 1 : 0;
        } else {
            this.index--;
        }

        this.onNavigate(this.index);
        return this.index;
    }

    home() {
        this.index = 0;
        this.onNavigate(this.index);
        return this.index;
    }

    end() {
        const total = this.count();
        this.index = Math.max(total - 1, 0);
        this.onNavigate(this.index);
        return this.index;
    }

    /**
     * Processador central de eventos.
     * @param {KeyboardEvent} event
     */
    handle(event) {
        switch (event.key) {
            case 'ArrowDown':
                event.preventDefault();
                this.next();
                break;
            case 'ArrowUp':
                event.preventDefault();
                this.previous();
                break;
            case 'Home':
                event.preventDefault();
                this.home();
                break;
            case 'End':
                event.preventDefault();
                this.end();
                break;
            case 'Enter':
                event.preventDefault();
                this.onSelect(this.index);
                break;
            case 'Escape':
                event.preventDefault();
                this.onEscape();
                break;
            case 'Tab':
                // O Tab é geralmente gerido pelo browser/browser default,
                // mas podes disparar algo aqui se for necessário um comportamento customizado.
                break;
        }
        return this.index;
    }
}
