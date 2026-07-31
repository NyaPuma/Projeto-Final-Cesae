/*
|--------------------------------------------------------------------------
| Chart Color Palettes
|--------------------------------------------------------------------------
| Gestão centralizada de cores para gráficos (Chart.js / D3.js).
| As paletas são derivadas automaticamente da constante COLORS.
*/

export const COLORS = {
    primary: "#2563EB",
    secondary: "#7C3AED",
    success: "#16A34A",
    warning: "#D97706",
    danger: "#DC2626",
    info: "#0891B2",
    pink: "#EC4899",
    lime: "#84CC16",
    orange: "#F97316",
    neutral: "#64748B"
};

/**
 * Converte Hex para RGBA.
 * Útil para gerar estados "soft" ou "hover" automaticamente.
 */
const hexToRgba = (hex, alpha = 0.18) => {
    const r = parseInt(hex.slice(1, 3), 16);
    const g = parseInt(hex.slice(3, 5), 16);
    const b = parseInt(hex.slice(5, 7), 16);
    return `rgba(${r}, ${g}, ${b}, ${alpha})`;
};

// Paletas derivadas (Garantem consistência total)
export const PALETTE = Object.values(COLORS);
export const SOFT_PALETTE = PALETTE.map(color => hexToRgba(color, 0.18));

// Mapeamento de Estados para fácil manutenção
const STATUS_MAP = {
    open: COLORS.warning,
    pending: COLORS.info,
    progress: COLORS.primary,
    closed: COLORS.success,
    cancelled: COLORS.danger
};

/*
|--------------------------------------------------------------------------
| Helpers
|--------------------------------------------------------------------------
*/

export function getPaletteColor(index) {
    return PALETTE[index % PALETTE.length];
}

export function getSoftPaletteColor(index) {
    return SOFT_PALETTE[index % SOFT_PALETTE.length];
}

export function getStatusColor(status) {
    return STATUS_MAP[status?.toLowerCase()] ?? COLORS.neutral;
}
