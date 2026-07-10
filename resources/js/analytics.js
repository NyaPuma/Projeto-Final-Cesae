/*
|--------------------------------------------------------------------------
| Analytics Dashboard
|--------------------------------------------------------------------------
| Inicialização e configuração global
|--------------------------------------------------------------------------
*/

document.addEventListener("DOMContentLoaded", () => {

    /*
    |--------------------------------------------------------------------------
    | Elementos da Página
    |--------------------------------------------------------------------------
    */

    const kpiPanel = document.getElementById("kpiPanel");

    const ticketChartCanvas = document.getElementById("ticketChart");

    const equipmentChartCanvas = document.getElementById("equipmentChart");

    const equipmentLegend = document.getElementById("equipmentLegend");

    const equipmentTotal = document.getElementById("equipmentTotal");

    const activityTimeline = document.getElementById("activityTimeline");

    const topEquipments = document.getElementById("topEquipments");

    const topRooms = document.getElementById("topRooms");

    const topTechnicians = document.getElementById("topTechnicians");

    const analyticsMessage = document.getElementById("analyticsMessage");

    /*
    |--------------------------------------------------------------------------
    | Instâncias dos gráficos
    |--------------------------------------------------------------------------
    */

    let ticketChart = null;

    let equipmentChart = null;

    /*
    |--------------------------------------------------------------------------
    | Configuração Global do Chart.js
    |--------------------------------------------------------------------------
    */

    Chart.defaults.font.family =
        "'Inter', system-ui, sans-serif";

    Chart.defaults.font.size = 13;

    Chart.defaults.plugins.legend.display = false;

    Chart.defaults.responsive = true;

    Chart.defaults.maintainAspectRatio = false;

    Chart.defaults.animation.duration = 800;

    /*
    |--------------------------------------------------------------------------
    | Utilitários
    |--------------------------------------------------------------------------
    */

    function showMessage(message, type = "success") {

        if (!analyticsMessage) return;

        analyticsMessage.className =
            "mt-6 rounded-2xl border px-5 py-4 text-sm font-medium";

        if (type === "success") {

            analyticsMessage.classList.add(
                "border-emerald-300",
                "bg-emerald-50",
                "text-emerald-700",
                "block"
            );

        } else {

            analyticsMessage.classList.add(
                "border-red-300",
                "bg-red-50",
                "text-red-700",
                "block"
            );

        }

        analyticsMessage.textContent = message;

    }

    function clearMessage() {

        if (!analyticsMessage) return;

        analyticsMessage.className = "hidden";

        analyticsMessage.textContent = "";

    }

    /*
|--------------------------------------------------------------------------
| Comunicação com a API
|--------------------------------------------------------------------------
*/

const API_ENDPOINT = "/analytics";

function getAuthToken() {

    return (
        localStorage.getItem("api_token") ||
        document.cookie
            .split("; ")
            .find(row => row.startsWith("api_token="))
            ?.split("=")[1] ||
        ""
    );

}

function buildHeaders() {

    return {

        "Accept": "application/json",

        "Content-Type": "application/json",

        "Authorization": `Bearer ${getAuthToken()}`,

        "X-Requested-With": "XMLHttpRequest"

    };

}

async function fetchAnalytics() {

    clearMessage();

    try {

        const response = await fetch(API_ENDPOINT, {

            method: "GET",

            credentials: "include",

            headers: buildHeaders()

        });

        if (!response.ok) {

            throw new Error(
                `Erro ${response.status}`
            );

        }

        return await response.json();

    }

    catch (error) {

        console.error(
            "Erro ao carregar Analytics:",
            error
        );

        showMessage(
            "Não foi possível carregar os dados analíticos.",
            "error"
        );

        return null;

    }

}

/*
|--------------------------------------------------------------------------
| Inicialização
|--------------------------------------------------------------------------
*/

async function initDashboard() {

    const analytics = await fetchAnalytics();

    if (!analytics) {

        return;

    }

    console.log(
        "Analytics carregado:",
        analytics
    );

}

/*
|--------------------------------------------------------------------------
| KPI Dashboard
|--------------------------------------------------------------------------
*/

function renderKPIs(data) {

    if (!kpiPanel) return;

    const cards = [

        {
            title: "Tempo Médio de Resolução",
            value: `${Math.round(data.average_resolution_minutes ?? 0)} min`,
            subtitle: "MTTR",
            color: "emerald",
            icon: "🛠️"
        },

        {
            title: "Tempo Médio de Espera",
            value: `${Math.round(data.average_waiting_minutes ?? 0)} min`,
            subtitle: "Tempo até atribuição",
            color: "blue",
            icon: "⏱️"
        },

        {
            title: "Tickets Abertos",
            value: data.open_tickets ?? 0,
            subtitle: "Ocorrências ativas",
            color: "amber",
            icon: "📂"
        },

        {
            title: "Tickets Resolvidos",
            value: data.closed_tickets ?? 0,
            subtitle: "Intervenções concluídas",
            color: "purple",
            icon: "✅"
        }

    ];

    kpiPanel.innerHTML = cards.map(card => `

        <article
            class="overflow-hidden rounded-3xl border border-[var(--border)] bg-[var(--surface)] transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">

            <div class="p-6">

                <div class="flex items-start justify-between">

                    <div>

                        <p
                            class="text-xs font-semibold uppercase tracking-[0.16em] text-soft">

                            ${card.title}

                        </p>

                        <h3
                            class="mt-5 text-4xl font-black tracking-tight">

                            ${card.value}

                        </h3>

                    </div>

                    <div
                        class="flex h-14 w-14 items-center justify-center rounded-2xl bg-${card.color}-500/10">

                        <span class="text-2xl">

                            ${card.icon}

                        </span>

                    </div>

                </div>

                <div
                    class="mt-8 flex items-center justify-between">

                    <span
                        class="rounded-full bg-${card.color}-500/10 px-3 py-1 text-xs font-semibold text-${card.color}-500">

                        ${card.subtitle}

                    </span>

                </div>

            </div>

        </article>

    `).join("");

}

/*
|--------------------------------------------------------------------------
| Gráfico - Tickets por Estado
|--------------------------------------------------------------------------
*/

function renderTicketChart(data) {

    if (!ticketChartCanvas) return;

    if (ticketChart) {

        ticketChart.destroy();

    }

    const labels = [
        "Abertos",
        "Em Curso",
        "Aguarda Orçamento",
        "Resolvidos"
    ];

    const values = [
        data.open_tickets ?? 0,
        data.in_progress_tickets ?? 0,
        data.waiting_budget_tickets ?? 0,
        data.closed_tickets ?? 0
    ];

    ticketChart = new Chart(ticketChartCanvas, {

        type: "bar",

        data: {

            labels,

            datasets: [

                {

                    label: "Tickets",

                    data: values,

                    backgroundColor: [

                        "#3B82F6",
                        "#F59E0B",
                        "#EF4444",
                        "#22C55E"

                    ],

                    borderRadius: 14,

                    borderSkipped: false,

                    maxBarThickness: 70

                }

            ]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            animation: {

                duration: 900,

                easing: "easeOutQuart"

            },

            plugins: {

                legend: {

                    display: false

                },

                tooltip: {

                    backgroundColor: "#111827",

                    padding: 14,

                    cornerRadius: 12,

                    displayColors: true,

                    callbacks: {

                        label(context) {

                            return `${context.raw} tickets`;

                        }

                    }

                }

            },

            scales: {

                x: {

                    grid: {

                        display: false

                    },

                    ticks: {

                        color: "#94A3B8",

                        font: {

                            weight: 600,

                            size: 13

                        }

                    }

                },

                y: {

                    beginAtZero: true,

                    ticks: {

                        precision: 0,

                        color: "#94A3B8"

                    },

                    grid: {

                        color: "rgba(148,163,184,.15)",

                        drawBorder: false

                    }

                }

            }

        }

    });

}

/*
|--------------------------------------------------------------------------
| Gráfico - Distribuição de Equipamentos
|--------------------------------------------------------------------------
*/

function renderEquipmentChart(data) {

    if (!equipmentChartCanvas) return;

    if (equipmentChart) {

        equipmentChart.destroy();

    }

    const labels = [
        "Operacionais",
        "Em Manutenção",
        "Avariados",
        "Inativos"
    ];

    const values = [
        data.operational_equipment ?? 0,
        data.maintenance_equipment ?? 0,
        data.broken_equipment ?? 0,
        data.inactive_equipment ?? 0
    ];

    const colors = [

        "#22C55E", // Verde
        "#3B82F6", // Azul
        "#F59E0B", // Âmbar
        "#EF4444"  // Vermelho

    ];

    equipmentChart = new Chart(equipmentChartCanvas, {

        type: "doughnut",

        data: {

            labels,

            datasets: [

                {

                    data: values,

                    backgroundColor: colors,

                    borderWidth: 0,

                    hoverOffset: 12,

                    spacing: 4

                }

            ]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            cutout: "72%",

            plugins: {

                legend: {

                    display: false

                },

                tooltip: {

                    backgroundColor: "#111827",

                    cornerRadius: 12,

                    padding: 14,

                    callbacks: {

                        label(context) {

                            return `${context.label}: ${context.raw}`;

                        }

                    }

                }

            }

        }

    });

    /*
    |--------------------------------------------------------------------------
    | Total de Equipamentos
    |--------------------------------------------------------------------------
    */

    if (equipmentTotal) {

        const total = values.reduce((sum, value) => sum + value, 0);

        equipmentTotal.textContent = total;

    }

    /*
    |--------------------------------------------------------------------------
    | Legenda Personalizada
    |--------------------------------------------------------------------------
    */

    if (equipmentLegend) {

        equipmentLegend.innerHTML = labels.map((label, index) => `

            <div class="flex items-center justify-between rounded-xl border border-[var(--border)] bg-[var(--surface-2)] px-4 py-3">

                <div class="flex items-center gap-3">

                    <span
                        class="h-3 w-3 rounded-full"
                        style="background:${colors[index]}">
                    </span>

                    <span class="text-sm font-medium">

                        ${label}

                    </span>

                </div>

                <span class="text-sm font-bold">

                    ${values[index]}

                </span>

            </div>

        `).join("");

    }

}

/*
|--------------------------------------------------------------------------
| Indicadores Operacionais
|--------------------------------------------------------------------------
*/

function renderOperationalMetrics(data) {

    const setValue = (id, value) => {

        const element = document.getElementById(id);

        if (element) {

            element.textContent = value;

        }

    };

    setValue(
        "metricMttr",
        `${Math.round(data.average_resolution_minutes ?? 0)} min`
    );

    setValue(
        "metricWaiting",
        `${Math.round(data.average_waiting_minutes ?? 0)} min`
    );

    setValue(
        "metricAvailability",
        `${data.system_availability ?? 99.9}%`
    );

    setValue(
        "metricSla",
        `${data.sla_success ?? 0}%`
    );

}

/*
|--------------------------------------------------------------------------
| Atividade Recente
|--------------------------------------------------------------------------
*/

function renderActivity(data) {

    if (!activityTimeline) return;

    const activities = data.recent_activity ?? [];

    if (!activities.length) {

        activityTimeline.innerHTML = `

            <div class="p-10 text-center text-soft">

                Nenhuma atividade recente.

            </div>

        `;

        return;

    }

    activityTimeline.innerHTML = activities.map(item => `

        <div class="flex items-start gap-5 p-6">

            <div
                class="mt-1 flex h-11 w-11 items-center justify-center rounded-xl bg-blue-500/10">

                <div
                    class="h-3 w-3 rounded-full bg-blue-500">
                </div>

            </div>

            <div class="flex-1">

                <div class="flex items-center justify-between gap-4">

                    <h4 class="font-semibold">

                        ${item.title}

                    </h4>

                    <span class="text-xs text-soft">

                        ${item.time}

                    </span>

                </div>

                <p class="mt-2 text-sm text-soft">

                    ${item.description}

                </p>

            </div>

        </div>

    `).join("");

}

/*
|--------------------------------------------------------------------------
| Resumo Operacional
|--------------------------------------------------------------------------
*/

function renderRanking(container, list) {

    if (!container) return;

    if (!list || !list.length) {

        container.innerHTML = `

            <div class="p-6 text-center text-soft">

                Sem informação.

            </div>

        `;

        return;

    }

    container.innerHTML = list.map((item, index) => `

        <div
            class="flex items-center justify-between p-5">

            <div class="flex items-center gap-4">

                <div
                    class="flex h-10 w-10 items-center justify-center rounded-xl bg-[var(--surface-2)] font-bold">

                    ${index + 1}

                </div>

                <div>

                    <div class="font-semibold">

                        ${item.name}

                    </div>

                    <div class="mt-1 text-sm text-soft">

                        ${item.subtitle ?? ""}

                    </div>

                </div>

            </div>

            <span
                class="rounded-full bg-blue-500/10 px-3 py-1 text-sm font-semibold text-blue-500">

                ${item.total}

            </span>

        </div>

    `).join("");

}

function renderSummary(data) {

    renderRanking(

        topEquipments,

        data.top_equipments

    );

    renderRanking(

        topRooms,

        data.top_rooms

    );

    renderRanking(

        topTechnicians,

        data.top_technicians

    );

}

/*
|--------------------------------------------------------------------------
| Atualização Automática
|--------------------------------------------------------------------------
*/

let refreshTimer = null;

async function refreshDashboard() {

    const analytics = await fetchAnalytics();

    if (!analytics) {

        return;

    }

    renderKPIs(analytics);

    renderTicketChart(analytics);

    renderEquipmentChart(analytics);

    renderOperationalMetrics(analytics);

    renderActivity(analytics);

    renderSummary(analytics);

    updateLastRefresh();

}

/*
|--------------------------------------------------------------------------
| Última Atualização
|--------------------------------------------------------------------------
*/

function updateLastRefresh() {

    const now = new Date();

    const hours = String(now.getHours()).padStart(2, "0");

    const minutes = String(now.getMinutes()).padStart(2, "0");

    console.info(
        `Dashboard atualizado às ${hours}:${minutes}`
    );

}

/*
|--------------------------------------------------------------------------
| Atualização Periódica
|--------------------------------------------------------------------------
*/

function startAutoRefresh() {

    if (refreshTimer) {

        clearInterval(refreshTimer);

    }

    refreshTimer = setInterval(() => {

        refreshDashboard();

    }, 60000);

}

/*
|--------------------------------------------------------------------------
| Atualizar quando o utilizador regressa ao separador
|--------------------------------------------------------------------------
*/

document.addEventListener("visibilitychange", () => {

    if (!document.hidden) {

        refreshDashboard();

    }

});

/*
|--------------------------------------------------------------------------
| Tratamento Global de Erros
|--------------------------------------------------------------------------
*/

window.addEventListener("error", (event) => {

    console.error(event.error);

});

window.addEventListener("unhandledrejection", (event) => {

    console.error(event.reason);

});

async function initDashboard() {

    const analytics = await fetchAnalytics();

    if (!analytics) {

        return;

    }

    renderKPIs(analytics);

    renderTicketChart(analytics);

    renderEquipmentChart(analytics);

    renderOperationalMetrics(analytics);

    renderActivity(analytics);

    renderSummary(analytics);

    updateLastRefresh();

    startAutoRefresh();

}

initDashboard();

});


