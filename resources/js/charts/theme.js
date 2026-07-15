/*
|--------------------------------------------------------------------------
| Global Chart Theme & Instance Manager
|--------------------------------------------------------------------------
|
| Gestão centralizada de estilos e instâncias de gráficos.
| Agora com suporte a atualização dinâmica de temas.
|
*/

import Chart from "./register";
import {
    getGridColor,
    getTextColor,
    getTooltipBackground,
    getTooltipText
} from "./helpers";

// Array para rastrear instâncias de gráficos ativos na página
const activeCharts = [];

/**
 * Regista uma instância de gráfico para que possa ser atualizada dinamicamente.
 */
export function registerChart(chartInstance) {
    activeCharts.push(chartInstance);
}

/**
 * Remove instância ao destruir o componente (prevenção de memory leaks).
 */
export function unregisterChart(chartInstance) {
    const index = activeCharts.indexOf(chartInstance);
    if (index > -1) activeCharts.splice(index, 1);
}

/*
|--------------------------------------------------------------------------
| Configurações Base
|--------------------------------------------------------------------------
*/

export function applyChartTheme() {
    Chart.defaults.font.family = "'Inter', sans-serif";
    Chart.defaults.font.size = 13;
    Chart.defaults.font.weight = "500";
    Chart.defaults.responsive = true;
    Chart.defaults.maintainAspectRatio = false;
    Chart.defaults.layout.padding = 8;

    // Animações suaves
    Chart.defaults.animation = { duration: 900, easing: "easeOutQuart" };

    // Configuração inicial de cores
    updateChartColors();

    // Defaults dos elementos
    if (Chart.defaults.elements.bar) {
        Chart.defaults.elements.bar.borderRadius = 12;
        Chart.defaults.elements.bar.borderSkipped = false;
    }
    if (Chart.defaults.elements.line) Chart.defaults.elements.line.tension = 0.35;
    if (Chart.defaults.elements.point) {
        Chart.defaults.elements.point.radius = 4;
        Chart.defaults.elements.point.hoverRadius = 7;
    }
    if (Chart.defaults.elements.arc) {
        Chart.defaults.elements.arc.borderWidth = 0;
        Chart.defaults.elements.arc.hoverOffset = 14;
    }

    Chart.defaults.plugins.legend.display = false;
    Chart.defaults.plugins.tooltip = {
        enabled: true,
        displayColors: true,
        cornerRadius: 14,
        padding: 14,
        borderWidth: 1,
        backgroundColor: getTooltipBackground(),
        titleColor: getTooltipText(),
        bodyColor: getTooltipText()
    };
}

/**
 * Atualiza apenas as propriedades dinâmicas do Chart.defaults
 */
function updateChartColors() {
    Chart.defaults.color = getTextColor();
    Chart.defaults.borderColor = getGridColor();

    if (Chart.defaults.plugins.tooltip) {
        Chart.defaults.plugins.tooltip.backgroundColor = getTooltipBackground();
        Chart.defaults.plugins.tooltip.titleColor = getTooltipText();
        Chart.defaults.plugins.tooltip.bodyColor = getTooltipText();
    }
}

/**
 * Refresh global: atualiza defaults E força re-render de todos os gráficos.
 */
export function refreshChartTheme() {
    updateChartColors();

    // Atualiza todos os gráficos instanciados
    activeCharts.forEach(chart => {
        chart.update('none'); // 'none' evita animação brusca no switch de tema
    });
}

export function getChartTheme() {
    return {
        text: getTextColor(),
        grid: getGridColor(),
        tooltip: {
            background: getTooltipBackground(),
            title: getTooltipText(),
            body: getTooltipText()
        }
    };
}

/*
|--------------------------------------------------------------------------
| Observer (Theming Dinâmico)
|--------------------------------------------------------------------------
*/

const observer = new MutationObserver(() => {
    refreshChartTheme();
});

observer.observe(document.documentElement, {
    attributes: true,
    attributeFilter: ["class"] // Observa mudanças na classe (ex: .dark)
});

// Inicialização
applyChartTheme();
