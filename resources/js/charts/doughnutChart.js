/*
|--------------------------------------------------------------------------
| Doughnut Chart Factory
|--------------------------------------------------------------------------
|
| Gráficos Doughnut reutilizáveis para toda a aplicação.
|
*/

import { Chart } from "chart.js";

import {

    destroyChart

} from "./helpers";

import {

    doughnutPalette

} from "./gradients";

/*
|--------------------------------------------------------------------------
| Criar Doughnut
|--------------------------------------------------------------------------
*/

export function createDoughnutChart({

    canvas,

    chart,

    labels = [],

    data = [],

    colors = doughnutPalette(),

    cutout = "72%",

    options = {}

}) {

    chart = destroyChart(chart);

    const config = {

        responsive: true,

        maintainAspectRatio: false,

        animation: {

            animateRotate: true,

            animateScale: true,

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

                displayColors: true

            }

        }

    };

    Object.assign(config, options);

    return new Chart(canvas, {

        type: "doughnut",

        data: {

            labels,

            datasets: [

                {

                    data,

                    backgroundColor: colors,

                    borderWidth: 0,

                    spacing: 4,

                    hoverOffset: 14,

                    borderRadius: 8

                }

            ]

        },

        options: {

            cutout,

            ...config

        }

    });

}
