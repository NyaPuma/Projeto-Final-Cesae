/*
|--------------------------------------------------------------------------
| Bar Chart Factory
|--------------------------------------------------------------------------
| Factory para criação de gráficos de barras otimizada para o Design System.
| Suporta destruição de instâncias anteriores e configuração dinâmica.
*/

import Chart from "./register";
import { getChartTheme } from "./theme";

export function createBarChart({
    canvas,
    labels = [],
    datasets = [], // Aceita um array de objetos para múltiplos datasets
    data = null,   // Mantido para compatibilidade com datasets simples
    label = "",
    backgroundColor = null,
    borderColor = null,
    options = {}
}) {
    // 1. Limpeza: Prevenir memória e conflitos de canvas
    const existingChart = Chart.getChart(canvas);
    if (existingChart) {
        existingChart.destroy();
    }

    const theme = getChartTheme();

    // 2. Normalização: Se não vierem datasets, construímos a estrutura básica
    const finalDatasets = datasets.length > 0
        ? datasets
        : [{
            label,
            data,
            borderRadius: 8,
            borderSkipped: false,
            backgroundColor: backgroundColor ?? theme.primary,
            borderColor: borderColor ?? theme.primary,
            borderWidth: 0
        }];

    return new Chart(canvas, {
        type: "bar",
        data: {
            labels,
            datasets: finalDatasets
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: { duration: 600 },
            interaction: {
                intersect: false,
                mode: "index"
            },
            plugins: {
                legend: { display: finalDatasets.length > 1 }, // Auto-esconder se for só uma barra
                tooltip: {
                    position: "average",
                    padding: 12,
                    backgroundColor: theme.surface,
                    titleColor: theme.text,
                    bodyColor: theme.text
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { color: theme.text }
                },
                y: {
                    beginAtZero: true,
                    grid: { color: theme.grid },
                    ticks: { color: theme.text }
                }
            },
            ...options // Sobrescrita manual permitida
        }
    });
}
