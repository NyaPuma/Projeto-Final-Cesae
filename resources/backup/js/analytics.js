/**
 * Analytics Dashboard Entry Point
 * Delegates to the modular analytics implementation
 */

import { init } from './pages/analytics/index.js';

// Inicialização
document.addEventListener("DOMContentLoaded", () => {
    init();
});

