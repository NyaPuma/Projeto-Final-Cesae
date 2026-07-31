/*
|--------------------------------------------------------------------------
| Gradient Factory
|--------------------------------------------------------------------------
|
| Criação de gradientes dinâmicos e responsivos para Chart.js.
|
*/

import { COLORS } from "./colors";

/**
 * Função interna para obter a altura/largura real da área do gráfico.
 * Isso garante que o gradiente se adapte ao tamanho do canvas.
 */
const getChartDimensions = (chart) => {
    const area = chart.chartArea;
    if (!area) return { width: 300, height: 300 };
    return {
        width: area.right - area.left,
        height: area.bottom - area.top
    };
};

/**
 * Utilitário para adicionar opacidade a uma cor Hex se necessário.
 * Mantém a flexibilidade para usar cores CSS nativas.
 */
const withOpacity = (color, opacity) => {
    // Se a cor já for rgba/hsla, retorna-a tal como está
    if (color.startsWith('rgb')) return color;
    // Se for hex, podes expandir a lógica aqui se necessário
    return `${color}${opacity}`;
};

/*
|--------------------------------------------------------------------------
| Fábrica de Gradientes
|--------------------------------------------------------------------------
*/

export const createGradient = {
    /**
     * Gradiente Vertical (Ideal para Barcharts e AreaCharts)
     */
    vertical: (chart, color = COLORS.primary) => {
        const { height } = getChartDimensions(chart);
        const ctx = chart.ctx;
        const gradient = ctx.createLinearGradient(0, 0, 0, height);

        gradient.addColorStop(0, withOpacity(color, 'E6'));
        gradient.addColorStop(0.5, withOpacity(color, '99'));
        gradient.addColorStop(1, withOpacity(color, '15'));
        return gradient;
    },

    /**
     * Gradiente Horizontal (Ideal para barras horizontais)
     */
    horizontal: (chart, color = COLORS.primary) => {
        const { width } = getChartDimensions(chart);
        const ctx = chart.ctx;
        const gradient = ctx.createLinearGradient(0, 0, width, 0);

        gradient.addColorStop(0, withOpacity(color, 'E6'));
        gradient.addColorStop(1, withOpacity(color, '33'));
        return gradient;
    },

    /**
     * Gradiente de Linha (Fade out)
     */
    line: (chart, color = COLORS.primary) => {
        const { height } = getChartDimensions(chart);
        const ctx = chart.ctx;
        const gradient = ctx.createLinearGradient(0, 0, 0, height);

        gradient.addColorStop(0, withOpacity(color, '66'));
        gradient.addColorStop(1, withOpacity(color, '00'));
        return gradient;
    },

    /**
     * Gradiente Customizado
     */
    custom: (chart, startColor, endColor) => {
        const { height } = getChartDimensions(chart);
        const ctx = chart.ctx;
        const gradient = ctx.createLinearGradient(0, 0, 0, height);

        gradient.addColorStop(0, startColor);
        gradient.addColorStop(1, endColor);
        return gradient;
    }
};

/**
 * Mapeamento de paleta para múltiplos datasets
 */
export const createPaletteGradients = (chart, colors) => {
    return colors.map(color => createGradient.vertical(chart, color));
};
