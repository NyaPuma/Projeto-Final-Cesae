/*
|--------------------------------------------------------------------------
| Chart Helpers
|--------------------------------------------------------------------------
|
| Funções reutilizáveis por todos os gráficos da aplicação.
|
*/

import { Chart } from "chart.js";

/*
|--------------------------------------------------------------------------
| Tema Atual
|--------------------------------------------------------------------------
*/

export function isDarkMode() {

    return document.documentElement.classList.contains("dark");

}

/*
|--------------------------------------------------------------------------
| Cores do Tema
|--------------------------------------------------------------------------
*/

export function getTextColor() {

    return isDarkMode()

        ? "#E5E7EB"

        : "#374151";

}

export function getGridColor() {

    return isDarkMode()

        ? "rgba(255,255,255,.08)"

        : "rgba(0,0,0,.08)";

}

export function getBorderColor() {

    return isDarkMode()

        ? "#2A2A28"

        : "#E5E7EB";

}

export function getTooltipBackground() {

    return isDarkMode()

        ? "#111827"

        : "#FFFFFF";

}

export function getTooltipText() {

    return isDarkMode()

        ? "#F9FAFB"

        : "#111827";

}

/*
|--------------------------------------------------------------------------
| Destruir gráfico existente
|--------------------------------------------------------------------------
*/

export function destroyChart(chart) {

    if (!chart) {

        return null;

    }

    chart.destroy();

    return null;

}

/*
|--------------------------------------------------------------------------
| Configuração Base
|--------------------------------------------------------------------------
*/

export function createBaseOptions() {

    return {

        responsive: true,

        maintainAspectRatio: false,

        interaction: {

            intersect: false,

            mode: "index"

        },

        animation: {

            duration: 900,

            easing: "easeOutQuart"

        },

        plugins: {

            legend: {

                display: false

            },

            tooltip: {

                cornerRadius: 14,

                padding: 14,

                borderWidth: 1,

                displayColors: true

            }

        },

        scales: {

            x: {

                grid: {

                    display: false

                },

                ticks: {

                    color: getTextColor(),

                    font: {

                        size: 13,

                        weight: 600

                    }

                }

            },

            y: {

                beginAtZero: true,

                grid: {

                    color: getGridColor(),

                    drawBorder: false

                },

                ticks: {

                    precision: 0,

                    color: getTextColor()

                }

            }

        }

    };

}
