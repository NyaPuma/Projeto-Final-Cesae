/**
 * Analytics Dashboard Entry Point
 * Delegates to the modular analytics implementation
 */

import { init } from './pages/analytics/index.js';

// Initialization
document.addEventListener("DOMContentLoaded", () => {
    init();
});

