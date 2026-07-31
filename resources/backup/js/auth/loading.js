/*
|--------------------------------------------------------------------------
| Loading Module
|--------------------------------------------------------------------------
| Gestão do overlay global e do estado dos botões.
| Melhorado com suporte a Acessibilidade (ARIA) e Lazy-Caching.
*/

import { qs, show, hide, setButtonLoading } from './utils';

let overlay = null;

/**
 * Procura o overlay no DOM apenas quando necessário (Lazy Load).
 * @returns {HTMLElement|null}
 */
const getOverlay = () => {
    if (!overlay) {
        overlay = qs('#loadingOverlay');

        // Dica de Debug: Ajuda a identificar se esqueceste de colocar o HTML no layout
        if (!overlay && process.env.NODE_ENV === 'development') {
            console.warn('[UI Loading] #loadingOverlay não encontrado no DOM.');
        }
    }
    return overlay;
};

/**
 * Atualiza o atributo aria-busy no body para acessibilidade.
 * @param {boolean} isBusy
 */
const toggleAriaBusy = (isBusy) => {
    if (isBusy) {
        document.body.setAttribute('aria-busy', 'true');
    } else {
        document.body.removeAttribute('aria-busy');
    }
};

/*
|--------------------------------------------------------------------------
| Overlay Global
|--------------------------------------------------------------------------
*/

export function showLoading() {
    const el = getOverlay();
    if (el) {
        show(el);
        toggleAriaBusy(true);
    }
}

export function hideLoading() {
    const el = getOverlay();
    if (el) {
        hide(el);
        toggleAriaBusy(false);
    }
}

/*
|--------------------------------------------------------------------------
| Estado do Botão
|--------------------------------------------------------------------------
*/

export function startButtonLoading(button) {
    if (button) setButtonLoading(button, true);
}

export function stopButtonLoading(button) {
    if (button) setButtonLoading(button, false);
}

/*
|--------------------------------------------------------------------------
| Estado Completo (Helper)
|--------------------------------------------------------------------------
*/

/**
 * Inicia carregamento global e, opcionalmente, de um botão específico.
 * @param {HTMLElement|null} button
 */
export function startLoading(button = null) {
    showLoading();
    if (button) startButtonLoading(button);
}

/**
 * Para carregamento global e, opcionalmente, de um botão específico.
 * @param {HTMLElement|null} button
 */
export function stopLoading(button = null) {
    hideLoading();
    if (button) stopButtonLoading(button);
}
