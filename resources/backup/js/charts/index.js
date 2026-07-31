/*
|--------------------------------------------------------------------------
| Chart Library API Surface
|--------------------------------------------------------------------------
| Ponto único de entrada para toda a biblioteca.
| Utiliza este ficheiro para expor apenas o que é necessário.
*/

/**
 * @module Theme
 * Gestão de estilos, temas e configurações visuais.
 */
export { applyChartTheme, refreshChartTheme, getChartTheme } from "./theme";

/**
 * @module Factories
 * Construtores de componentes de gráficos.
 */
export { createBarChart } from "./barChart";
export { createLineChart } from "./lineChart";
export { createDoughnutChart } from "./doughnutChart";

/**
 * @module Helpers
 * Utilitários de formatação, cálculos e acesso a tokens.
 */
export {
    formatCurrency,
    formatNumber,
    formatPercent,
    getGridColor,
    getTextColor,
    getSoftTextColor,
    getBorderColor,
    getSurfaceColor,
    getSurfaceAltColor,
    getTooltipBackground,
    getTooltipText,
    isDarkMode,
    sum,
    max,
    min
} from "./helpers";

/**
 * @module Colors
 * Gestão de paletas e esquemas de cores.
 */
export {
    COLORS,
    PALETTE,
    SOFT_PALETTE,
    getPaletteColor,
    getSoftPaletteColor,
    getStatusColor
} from "./colors";

/**
 * @module Gradients
 * Fábrica de gradientes dinâmicos para Chart.js.
 */
export {
    createVerticalGradient,
    createHorizontalGradient,
    createLineGradient,
    createAreaGradient,
    createPaletteGradients
} from "./gradients";
