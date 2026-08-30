/**
 * Analytics Export Actions
 * Intercepts async export buttons (CSV/PDF) to:
 *  • prevent navigation to the endpoint (which responds with JSON);
 *  • show "processing" feedback and the message returned by the server;
 *  • allow the user to download the file once the notification is ready.
 */

import { authHeader } from '../../utils/api.js';
import { showMessage } from './helpers.js';

const translations = () => window.SGM_ANALYTICS_I18N || {};

let initialized = false;
let printInitialized = false;

/**
 * Binds [data-action="print"] buttons to window.print().
 * Keeps the handler out of the markup (no inline onclick).
 */
export function initPrintActions() {
    if (printInitialized) return;
    printInitialized = true;

    document.querySelectorAll('[data-action="print"]').forEach((button) => {
        button.addEventListener('click', () => window.print());
    });
}

export function initExportActions() {
    if (initialized) return;
    initialized = true;

    const buttons = document.querySelectorAll('[data-async-export]');
    const messageEl = document.querySelector('[data-async-message]') || document.getElementById('analyticsMessage');

    buttons.forEach((button) => {
        const labelEl = button.querySelector('.ui-button__label');
        const originalLabel = labelEl ? labelEl.textContent : '';

        button.addEventListener('click', (event) => {
            event.preventDefault();
            triggerExport(button, labelEl, originalLabel, messageEl);
        });
    });
}

async function triggerExport(button, labelEl, originalLabel, messageEl) {
    if (button.dataset.busy === 'true') return;

    const url = button.getAttribute('href');
    const processingLabel = button.dataset.processingLabel || translations().exportProcessing || 'Generating...';

    button.dataset.busy = 'true';
    button.classList.add('opacity-50', 'pointer-events-none');
    if (labelEl) labelEl.textContent = processingLabel;

    try {
        const response = await fetch(url, {
            method: 'GET',
            headers: authHeader(),
            credentials: 'same-origin',
        });

        const data = await response.json().catch(() => ({}));

        if (response.ok && data.message) {
            showMessage(messageEl, data.message, 'success');
        } else {
            showMessage(messageEl, data.message || translations().exportStartError || 'Failed to start the export.', 'error');
        }
    } catch (error) {
        showMessage(messageEl, translations().exportNetworkError || 'Network error while starting the export. Please try again.', 'error');
    } finally {
        button.dataset.busy = 'false';
        button.classList.remove('opacity-50', 'pointer-events-none');
        if (labelEl) labelEl.textContent = originalLabel;
    }
}
