/**
 * Analytics Dashboard Manager
 * Main orchestrator for the analytics dashboard
 */

import { fetchAnalytics, getThemeColors, showMessage, clearMessage } from './helpers.js';
import { renderStatusChart, renderTrendChart, renderCostChart, renderEquipmentChart, destroyChart } from './charts.js';
import { renderKPIs, renderOperationalMetrics } from './kpi.js';
import { renderActivity, renderSummary } from './activity.js';

class AnalyticsDashboard {
    constructor() {
        this.charts = { status: null, trend: null, cost: null, equipment: null };
        this.refreshTimer = null;
        this.lastData = null;
        this.elements = this.getElements();

        // Expor para a janela global apenas o necessário para triggers externos
        window.refreshAnalyticsDashboard = () => this.refresh();

        this.init();
    }

    getElements() {
        return {
            kpiPanel: document.getElementById("kpiPanel"),
            analyticsMessage: document.getElementById("analyticsMessage"),
            statusChart: document.getElementById("statusChart"),
            trendChart: document.getElementById("trendChart"),
            costChart: document.getElementById("costChart"),
            equipmentChart: document.getElementById("equipmentChart"),
            equipmentLegend: document.getElementById("equipmentLegend"),
            equipmentTotal: document.getElementById("equipmentTotal"),
            activityTimeline: document.getElementById("activityTimeline"),
            topEquipments: document.getElementById("topEquipments"),
            topRooms: document.getElementById("topRooms"),
            topTechnicians: document.getElementById("topTechnicians"),
            metricMttr: document.getElementById("metricMttr"),
            metricWaiting: document.getElementById("metricWaiting"),
            metricSla: document.getElementById("metricSla"),
            metricAvailability: document.getElementById("metricAvailability")
        };
    }

    async init() {
        if (!this.elements.kpiPanel) return;

        await this.refresh();
        this.startAutoRefresh();

        document.addEventListener("visibilitychange", () => {
            document.hidden ? this.stopAutoRefresh() : this.refresh();
        });

        window.addEventListener("beforeunload", () => this.cleanup());
        window.addEventListener("theme-changed", () => this.handleThemeChange());
    }

    async refresh() {
        this.setLoading(true);
        try {
            const data = await fetchAnalytics();
            if (data) {
                this.lastData = data;
                this.updateUI(data);
            } else {
                showMessage(this.elements.analyticsMessage, "Erro ao carregar dados analíticos.", "error");
            }
        } finally {
            this.setLoading(false);
        }
    }

    handleThemeChange() {
        if (this.lastData) {
            this.updateUI(this.lastData);
        }
    }

    setLoading(isLoading) {
        if (isLoading) clearMessage(this.elements.analyticsMessage);
    }

    updateUI(data) {
        renderKPIs(this.elements.kpiPanel, data);
        this.charts.status = renderStatusChart(this.elements.statusChart, data, this.charts.status);
        this.charts.trend = renderTrendChart(this.elements.trendChart, data, this.charts.trend);
        this.charts.cost = renderCostChart(this.elements.costChart, data, this.charts.cost);
        this.charts.equipment = renderEquipmentChart(
            this.elements.equipmentChart, 
            data, 
            this.charts.equipment,
            this.elements.equipmentTotal,
            this.elements.equipmentLegend
        );
        renderOperationalMetrics(this.elements, data);
        renderActivity(this.elements.activityTimeline, data);
        renderSummary(this.elements, data);
    }

    cleanup() {
        this.stopAutoRefresh();
        Object.keys(this.charts).forEach(key => {
            this.charts[key] = destroyChart(this.charts[key]);
        });
    }

    startAutoRefresh() {
        this.stopAutoRefresh();
        this.refreshTimer = setInterval(() => this.refresh(), 60000);
    }

    stopAutoRefresh() {
        if (this.refreshTimer) clearInterval(this.refreshTimer);
    }
}

// Inicialização
export function init() {
    if (document.getElementById("kpiPanel")) {
        new AnalyticsDashboard();
    }
}
