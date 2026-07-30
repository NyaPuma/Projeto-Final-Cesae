/**
 * Room Management Module (Não usado ativamente - gestão via inline script em rooms.blade.php)
 * Mantido para referência. Gestão de salas feita via scripts inline nas Blade views.
 */

/**
 * Show toast notification
 * @param {Object} options - Toast options
 */
function showToast({ type = 'success', title, message }) {
    console.log(`[${type.toUpperCase()}] ${title}: ${message}`);
}

/**
 * Initialize room management page (No-op, handled by blade inline script)
 */
export function initRoomManagement() {
    // Gestão de salas feita via inline script em rooms.blade.php
}
