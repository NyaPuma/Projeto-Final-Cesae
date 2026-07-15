/*
|--------------------------------------------------------------------------
| Doughnut Chart Factory
|--------------------------------------------------------------------------
| Factory otimizada para criação de gráficos Doughnut com suporte
| a temas e fusão de configurações.
*/

import Chart from "./register";
import { getChartTheme } from "./theme";
import { PALETTE } from "./colors"; // Assumindo que importas a paleta do teu ficheiro de cores

/**
 * Função utilitária para merge simples de objetos de configuração
 */
const deepMerge = (target, source) => {
    for (const key in source) {
        if (source[key] instanceof Object && key in target) {
            Object.assign(source[key], deepMerge(target[key], source[key]));
        }
    }
    return { ...target, ...source };
};

export function createDoughnutChart({
    canvas,
    labels = [],
    data = [],
    colors = PALETTE,
    options = {}
}) {
    const theme = getChartTheme();

    // Configuração base (Default)
    const baseOptions = {
        responsive: true,
        maintainAspectRatio: false,
        cutout: "68%",
        interaction: { intersect: false },
        plugins: {
            legend: { display: false },
            tooltip: {
                backgroundColor: theme.surface,
                titleColor: theme.text,
                bodyColor: theme.textSoft,
                borderColor: theme.border,
                borderWidth: 1,
                padding: 12,
                callbacks: {
                    label(context) {
                        const value = context.raw ?? 0;
                        const total = context.dataset.data.reduce((sum, current) => sum + current, 0);
                        const percentage = total ? ((value / total) * 100).toFixed(1) : 0;
                        return `${context.label}: ${value} (${percentage}%)`;
                    }
                }
            }
        }
    };

    // Aplica o merge de opções (preservando plugins e estruturas profundas)
    const mergedOptions = deepMerge(baseOptions, options);

    return new Chart(canvas, {
        type: "doughnut",
        data: {
            labels,
            datasets: [{
                data,
                backgroundColor: colors,
                borderWidth: 0,
                hoverOffset: 12,
                borderRadius: 4
            }]
        },
        options: mergedOptions
    });
}
