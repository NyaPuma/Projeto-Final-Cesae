/*
|--------------------------------------------------------------------------
| Bar Chart Factory
|--------------------------------------------------------------------------
|
| Criação de gráficos de barras com o tema global da aplicação.
|
*/

import { Chart } from "chart.js";

import { destroyChart, createBaseOptions } from "./helpers";

import { primaryGradient } from "./gradients";

/*
|--------------------------------------------------------------------------
| Criar Gráfico de Barras
|--------------------------------------------------------------------------
*/

export function createBarChart({

    canvas,

    chart,

    labels = [],

    data = [],

    label = "",

    gradient = primaryGradient,

    horizontal = false,

    options = {}

}) {

    chart = destroyChart(chart);

    const config = createBaseOptions();

    /*
    |--------------------------------------------------------------------------
    | Permitir gráfico horizontal
    |--------------------------------------------------------------------------
    */

    if (horizontal) {

        config.indexAxis = "y";

    }

    /*
    |--------------------------------------------------------------------------
    | Merge das opções adicionais
    |--------------------------------------------------------------------------
    */

    Object.assign(config, options);

    /*
    |--------------------------------------------------------------------------
    | Criar gráfico
    |--------------------------------------------------------------------------
    */

    return new Chart(canvas, {

        type: "bar",

        data: {

            labels,

            datasets: [

                {

                    label,

                    data,

                    backgroundColor: gradient,

                    borderRadius: 12,

                    borderSkipped: false,

                    borderWidth: 0,

                    hoverBorderWidth: 0,

                    barThickness: 28,

                    maxBarThickness: 36

                }

            ]

        },

        options: config

    });

}
