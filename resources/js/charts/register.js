/*
|--------------------------------------------------------------------------
| Chart.js Register (Design System Core)
|--------------------------------------------------------------------------
|
| Regista todos os componentes necessários e define as configurações
| globais. Este ficheiro garante consistência visual e comportamental
| em todos os gráficos da aplicação.
|
*/

import {
    Chart,
    CategoryScale,
    LinearScale,
    BarController,
    BarElement,
    LineController,
    LineElement,
    PointElement,
    DoughnutController,
    ArcElement,
    Tooltip,
    Legend,
    Title,
    Filler
} from "chart.js";

// 1. Registo de Componentes (Controllers e Elements)
Chart.register(
    CategoryScale,
    LinearScale,
    BarController,
    BarElement,
    LineController,
    LineElement,
    PointElement,
    DoughnutController,
    ArcElement,
    Tooltip,
    Legend,
    Title,
    Filler
);

// 2. Configurações Globais (Design System Consistency)
// Define aqui as fontes, comportamentos e defaults para toda a app
Chart.defaults.responsive = true;
Chart.defaults.maintainAspectRatio = false; // Permite controlar a altura via CSS do container
Chart.defaults.font.family = "'Inter', system-ui, sans-serif"; // Garante consistência com o resto do sistema
Chart.defaults.plugins.legend.position = 'bottom'; // Padrão de legibilidade
Chart.defaults.plugins.tooltip.padding = 12;
Chart.defaults.plugins.tooltip.cornerRadius = 8;

export default Chart;
