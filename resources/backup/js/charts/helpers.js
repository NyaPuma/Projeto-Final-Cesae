/*
|--------------------------------------------------------------------------
| Helpers para Chart.js
|--------------------------------------------------------------------------
*/

/**
 * Obtém uma variável CSS de forma eficiente.
 */
export function getCssVariable(name) {
    return getComputedStyle(document.documentElement).getPropertyValue(name).trim();
}

/**
 * Detecta o tema atual.
 * Sugestão: Se mudares para data-theme="dark" no futuro, altera apenas esta linha.
 */
export const isDarkMode = () => document.documentElement.classList.contains("dark");

/*
|--------------------------------------------------------------------------
| Theme Colors (Agrupadas para performance)
|--------------------------------------------------------------------------
*/
export const getThemeColors = () => {
    const dark = isDarkMode();
    return {
        text: getCssVariable("--text") || "#1F2937",
        textSoft: getCssVariable("--text-soft") || "#6B7280",
        border: getCssVariable("--border") || "#E5E7EB",
        surface: getCssVariable("--surface") || "#FFFFFF",
        surfaceAlt: getCssVariable("--surface-2") || "#F8FAFC",
        grid: dark ? "rgba(255,255,255,0.08)" : "rgba(15,23,42,0.08)",
        tooltipBg: dark ? "#111827" : "#FFFFFF",
        tooltipText: dark ? "#F9FAFB" : "#111827"
    };
};

/*
|--------------------------------------------------------------------------
| Formatação de Dados
|--------------------------------------------------------------------------
*/

export const formatNumber = (value) =>
    new Intl.NumberFormat("pt-PT").format(value);

export const formatCurrency = (value) =>
    new Intl.NumberFormat("pt-PT", { style: "currency", currency: "EUR" }).format(value);

/**
 * Formata percentagens seguindo as regras de i18n.
 * @param {number} value - Ex: 50.5 (para 50.5%)
 */
export const formatPercent = (value) => {
    return new Intl.NumberFormat("pt-PT", {
        style: "percent",
        minimumFractionDigits: 1,
        maximumFractionDigits: 1
    }).format(Number(value) / 100);
};

/*
|--------------------------------------------------------------------------
| Manipulação de Arrays (Robustez garantida)
|--------------------------------------------------------------------------
*/

export const sum = (values = []) =>
    Array.isArray(values) ? values.reduce((acc, v) => acc + Number(v || 0), 0) : 0;

export const max = (values = []) =>
    Array.isArray(values) && values.length > 0 ? Math.max(...values) : 0;

export const min = (values = []) =>
    Array.isArray(values) && values.length > 0 ? Math.min(...values) : 0;
