/*
|--------------------------------------------------------------------------
| Line Chart Factory
|--------------------------------------------------------------------------
| Factory otimizada para criação de gráficos de linhas com suporte a
| cleanup automático e merge inteligente de opções.
*/

import Chart from "./register";
import { getChartTheme } from "./theme";

export function createLineChart(canvas, config = {}) {
    const theme = getChartTheme();

    // 1. Prevenção de Memory Leaks: Destruir gráfico existente
    const existingChart = Chart.getChart(canvas);
    if (existingChart) {
        existingChart.destroy();
    }

    const {
        labels = [],
        datasets = [],
        options = {}
    } = config;

    // 2. Mapeamento robusto dos datasets
    const chartDatasets = datasets.map(dataset => ({
        label: dataset.label,
        data: dataset.data,
        borderColor: dataset.color ?? theme.primary,
        backgroundColor: dataset.fill
            ? (dataset.backgroundColor ?? `${dataset.color ?? theme.primary}20`)
            : "transparent",
        fill: dataset.fill ?? false,
        borderWidth: 3,
        tension: 0.35,
        pointRadius: 4,
        pointHoverRadius: 7,
        pointBackgroundColor: dataset.color ?? theme.primary,
        pointBorderWidth: 2,
        pointBorderColor: "#ffffff",
        ...dataset.extra // Permite override manual de propriedades específicas
    }));

    // 3. Configuração de Plugins e Default Options
    const defaultOptions = {
        responsive: true,
        maintainAspectRatio: false,
        interaction: { intersect: false, mode: "index" },
        plugins: {
            legend: {
                display: true,
                position: "bottom",
                labels: {
                    usePointStyle: true,
                    padding: 20,
                    color: theme.text
                }
            }
        },
        scales: {
            x: { grid: { display: false }, ticks: { color: theme.text } },
            y: {
                beginAtZero: true,
                grid: { color: theme.grid },
                ticks: { color: theme.text }
            }
        }
    };

    // 4. Merge inteligente (Evita apagar objetos aninhados ao aplicar custom options)
    const finalOptions = {
        ...defaultOptions,
        ...options,
        plugins: {
            ...defaultOptions.plugins,
            ...options.plugins
        },
        scales: {
            ...defaultOptions.scales,
            ...options.scales
        }
    };

    return new Chart(canvas, {
        type: "line",
        data: { labels, datasets: chartDatasets },
        options: finalOptions
    });
}
