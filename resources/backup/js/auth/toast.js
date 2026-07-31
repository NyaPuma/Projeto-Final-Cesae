/*
|--------------------------------------------------------------------------
| Toast Module
|--------------------------------------------------------------------------
| Sistema global de notificações.
| Requisito: O elemento #authToast deve ter role="status" ou aria-live="polite" no HTML.
*/

import { qs, hide, show } from './utils';

// Cache para evitar pesquisas repetitivas no DOM
let elements = {
    toast: null,
    icon: null,
    title: null,
    message: null,
};

let timeout = null;

// Configuração centralizada para fácil manutenção e escalabilidade
const TOAST_TYPES = {
    success: { icon: '✓', class: 'toast-success' },
    error:   { icon: '✕', class: 'toast-error' },
    warning: { icon: '⚠', class: 'toast-warning' },
    info:    { icon: 'ℹ', class: 'toast-info' }
};

/**
 * Inicialização
 */
export function initToast() {
    elements.toast = qs('#authToast');

    if (!elements.toast) return;

    // Busca interna para garantir scoping correto
    elements.icon = elements.toast.querySelector('.auth-toast-icon');
    elements.title = elements.toast.querySelector('#toastTitle');
    elements.message = elements.toast.querySelector('#toastMessage');
}

/**
 * Mostrar Toast
 */
export function showToast({
    title: toastTitle = 'Informação',
    message: toastMessage = '',
    type = 'info',
    duration = 3500
} = {}) {
    if (!elements.toast) return;

    clearTimeout(timeout);

    // Seleciona configuração ou fallback para 'info'
    const config = TOAST_TYPES[type] || TOAST_TYPES.info;

    // Atualiza conteúdo
    if (elements.title) elements.title.textContent = toastTitle;
    if (elements.message) elements.message.textContent = toastMessage;
    if (elements.icon) elements.icon.textContent = config.icon;

    // Gestão de Classes
    elements.toast.classList.remove(...Object.values(TOAST_TYPES).map(t => t.class));
    elements.toast.classList.add(config.class);

    show(elements.toast);

    // Auto-hide
    timeout = setTimeout(hideToast, duration);
}

/**
 * Esconder Toast
 */
export function hideToast() {
    if (elements.toast) {
        hide(elements.toast);
    }
}
