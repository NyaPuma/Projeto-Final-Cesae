/*
|--------------------------------------------------------------------------
| Tabs Module
|--------------------------------------------------------------------------
| Gestão de alternância entre Login e Registo com foco em performance
| e acessibilidade.
*/

import { qs } from './utils';

// Cache para evitar pesquisas repetitivas no DOM
let elements = null;

/**
 * Inicialização do módulo de Tabs
 */
export function initTabs() {
    elements = {
        loginTab: qs('#loginTab'),
        registerTab: qs('#registerTab'),
        loginPanel: qs('#loginPanel'),
        registerPanel: qs('#registerPanel')
    };

    // Validação defensiva: se faltar algum, paramos
    if (!elements.loginTab || !elements.registerTab || !elements.loginPanel || !elements.registerPanel) {
        return;
    }

    // Event Listeners
    elements.loginTab.addEventListener('click', activateLogin);
    elements.registerTab.addEventListener('click', activateRegister);
}

/**
 * Função privada centralizadora de lógica
 */
function switchTab(type) {
    if (!elements) return;

    const isLogin = type === 'login';

    // 1. Alternar Classes (CSS)
    elements.loginTab.classList.toggle('active', isLogin);
    elements.registerTab.classList.toggle('active', !isLogin);

    elements.loginPanel.classList.toggle('active', isLogin);
    elements.registerPanel.classList.toggle('active', !isLogin);

    // 2. Alternar Atributos de Acessibilidade (A11y)
    elements.loginTab.setAttribute('aria-selected', isLogin);
    elements.registerTab.setAttribute('aria-selected', !isLogin);

    elements.loginPanel.setAttribute('aria-hidden', !isLogin);
    elements.registerPanel.setAttribute('aria-hidden', isLogin);
}

/*
|--------------------------------------------------------------------------
| API Pública
|--------------------------------------------------------------------------
*/

export function activateLogin() {
    switchTab('login');
}

export function activateRegister() {
    switchTab('register');
}
