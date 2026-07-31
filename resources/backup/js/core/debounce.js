/**
 * Debounce utility
 * * Executa uma função apenas após um período de inatividade.
 * Ideal para eventos de scroll, resize, ou inputs de pesquisa.
 * * @param {Function} callback - A função a ser executada.
 * @param {number} delay - Tempo de espera em milissegundos (default: 300ms).
 * @returns {Function} Uma nova função com debounce e um método .cancel().
 */
export default function debounce(callback, delay = 300) {
    let timer = null;

    const debounced = function (...args) {
        // Limpa o temporizador anterior a cada nova chamada
        clearTimeout(timer);

        // Define um novo temporizador
        timer = setTimeout(() => {
            callback.apply(this, args);
        }, delay);
    };

    /**
     * Permite cancelar a execução pendente.
     * Útil em ciclos de vida de componentes (ex: ao destruir o componente).
     */
    debounced.cancel = () => {
        clearTimeout(timer);
        timer = null;
    };

    return debounced;
}
