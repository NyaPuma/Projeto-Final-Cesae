/**
 * NavigationManager
 * Gestor reutilizável de navegação por teclado/índice.
 * * @param {Object} options - Configurações do gestor
 * @param {Function} options.count - Função que retorna o número total de itens
 * @param {boolean} [options.loop=true] - Se deve voltar ao início/fim
 * @param {number} [options.active=-1] - Índice inicial
 * @param {Function} [options.onNavigate] - Callback executado na mudança de índice (index) => void
 */
export default class NavigationManager {
    constructor(options = {}) {
        this.count = options.count ?? (() => 0);
        this.loop = options.loop ?? true;
        this.active = options.active ?? -1;
        this.onNavigate = options.onNavigate ?? (() => {});
    }

    /**
     * Atualiza o estado interno e dispara o callback
     * @private
     */
    _update(index) {
        if (this.active !== index) {
            this.active = index;
            this.onNavigate(this.active);
        }
        return this.active;
    }

    current() {
        return this.active;
    }

    is(index) {
        return this.active === index;
    }

    select(index) {
        const total = this.count();
        if (index < 0 || index >= total) return this.active;
        return this._update(index);
    }

    next() {
        const total = this.count();
        if (!total) return -1;

        let newIndex = this.active + 1;
        if (newIndex >= total) {
            newIndex = this.loop ? 0 : total - 1;
        }
        return this._update(newIndex);
    }

    previous() {
        const total = this.count();
        if (!total) return -1;

        let newIndex = this.active - 1;
        if (newIndex < 0) {
            newIndex = this.loop ? total - 1 : 0;
        }
        return this._update(newIndex);
    }

    home() {
        return this._update(0);
    }

    end() {
        return this._update(Math.max(this.count() - 1, 0));
    }

    reset() {
        return this._update(-1);
    }
}
