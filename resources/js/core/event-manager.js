/*
|--------------------------------------------------------------------------
| Event Manager
|--------------------------------------------------------------------------
|
| Gestão centralizada de event listeners com suporte a disposable pattern.
|
| Funcionalidades:
| • Registo de listeners (retorna função de cleanup)
| • Remoção específica
| • Limpeza total
| • Remoção por componente (target)
|
*/

export default class EventManager {
    constructor() {
        this.listeners = [];
    }

    /**
     * Adiciona um evento e retorna uma função para removê-lo (Disposable Pattern).
     */
    on(target, event, handler, options = false) {
        if (!target || !event || !handler) {
            console.warn('EventManager: Parâmetros inválidos no registo de evento.');
            return () => {}; // Retorna função vazia para não quebrar
        }

        target.addEventListener(event, handler, options);

        const listener = { target, event, handler, options };
        this.listeners.push(listener);

        // Retorna função "unsubscribe" para facilitar cleanup
        return () => this.off(target, event, handler, options);
    }

    /**
     * Remove um evento específico.
     */
    off(target, event, handler, options = false) {
        if (!target) return;

        target.removeEventListener(event, handler, options);

        this.listeners = this.listeners.filter(l =>
            !(l.target === target && l.event === event && l.handler === handler)
        );
    }

    /**
     * Limpa todos os eventos registados neste manager.
     */
    clear() {
        this.listeners.forEach(({ target, event, handler, options }) => {
            target.removeEventListener(event, handler, options);
        });
        this.listeners = [];
    }

    /**
     * Remove todos os eventos associados a um target específico.
     * Útil para o "destroy" de componentes.
     */
    removeAllByTarget(target) {
        const remaining = [];

        this.listeners.forEach(listener => {
            if (listener.target === target) {
                listener.target.removeEventListener(listener.event, listener.handler, listener.options);
            } else {
                remaining.push(listener);
            }
        });

        this.listeners = remaining;
    }
}
